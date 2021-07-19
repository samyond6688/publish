<?php

namespace App\Admin\Controllers;

use App\Admin\Api\Qweixin;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Auth\Permission;
//use Dcat\Admin\Http\Repositories\Administrator;
use App\Models\AdminUser as Administrator;
use App\Models\AdminUser as AdministratorModel;
use Dcat\Admin\Http\Controllers\UserController as BaseUserController;
use Dcat\Admin\Show;
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Widgets\Tree;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class AdminUserController extends BaseUserController
{
    public function title()
    {
        return trans('admin.administrator');
    }

    protected function grid()
    {
        return Grid::make(Administrator::with(['roles']), function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('username');
            $grid->column('name');
            if (config('admin.permission.enable')) {
                $grid->column('roles')->pluck('name')->label('primary', 3);

                $permissionModel = config('admin.database.permissions_model');
                $roleModel = config('admin.database.roles_model');
                $nodes = (new $permissionModel())->allNodes();
                $grid->column('permissions')
                    ->if(function () {
                        return !$this->roles->isEmpty();
                    })
                    ->showTreeInDialog(function (Grid\Displayers\DialogTree $tree) use (&$nodes, $roleModel) {
                        $tree->nodes($nodes);

                        foreach (array_column($this->roles->toArray(), 'slug') as $slug) {
                            if ($roleModel::isAdministrator($slug)) {
                                $tree->checkAll();
                            }
                        }
                    })
                    ->else()
                    ->display('');
            }
            $grid->column('status', admin_trans('admin.status'))->switch();
            //$grid->column('status',)
            $grid->column('created_at');
            //$grid->column('updated_at')->sortable();

            $grid->quickSearch(['id', 'name', 'username','status']);

            $grid->showQuickEditButton();
            $grid->enableDialogCreate();
            $grid->showColumnSelector();
            $grid->disableEditButton();

            $grid->actions(function (Grid\Displayers\Actions $actions) use ($grid){
                if ($actions->getKey() == AdministratorModel::DEFAULT_ID) {
                    $actions->disableDelete();
                } else {
                    $actions->append('<a class="reset_password" admin_id="' . $this->id . '" admin_name="'.$this->username.'" href="javascript:void(0)">重置密码</a>');
                }
                $grid->column('status', admin_trans('admin.status'))->switch();
            });
            Admin::script($this->script($this->form()));

        });
    }

    public function form()
    {
        return Form::make(Administrator::with(['roles']), function (Form $form) {
            $userTable = config('admin.database.users_table');

            $connection = config('admin.database.connection');

            $id = $form->getKey();

            $form->display('id', 'ID');
            $form->hidden('is_first')->default(0);
            $form->hidden('status')->default(1);
            $form->hidden('email')->default('');
            $form->text('username', trans('admin.username'))
                ->required()
                ->creationRules(['required', "unique:{$connection}.{$userTable}"])
                ->updateRules(['required', "unique:{$connection}.{$userTable},username,$id"]);
            $form->text('name', trans('admin.name'))->required();
            $form->image('avatar', trans('admin.avatar'))->autoUpload();

            if ($id) {
                $form->password('password', trans('admin.password'))
                    //->rules('required|regex:/^[\w]+$/')

                    ->rules('regex:/^[^\s\/"\"]+$/')
                    ->minLength(10)
                    ->maxLength(20)
                    ->customFormat(function () {
                        return '';
                    });
            } else {
                $form->password('password', trans('admin.password'))
                    ->rules('regex:/^[^\s\/"\"]+$/')
                    ->minLength(10)
                    ->maxLength(20);
            }

            $form->password('password_confirmation', trans('admin.password_confirmation'))->same('password');

            $form->ignore(['password_confirmation']);

            if (config('admin.permission.enable')) {
                $form->multipleSelect('roles', trans('admin.roles'))
                    ->options(function () {
                        $roleModel = config('admin.database.roles_model');

                        return $roleModel::all()->pluck('name', 'id');
                    })
                    ->customFormat(function ($v) {
                        return array_column($v, 'id');
                    });
            }

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));

            if ($id == AdministratorModel::DEFAULT_ID) {
                $form->disableDeleteButton();
            }
        })->saving(function (Form $form) {
            if ($form->password && $form->model()->get('password') != $form->password) {
                $form->password = bcrypt($form->password);
            }

            if (! $form->password) {
                $form->deleteInput('password');
            }
            //dd($form->is_first);
        })->saved(function (Form $form) {


        });
    }
    public function resetPassword(Request $request)
    {
        $name = $request->post('name');
        $id = $request->post('id');
        $Administrator = new Administrator();
        $data = DB::table('admin_users')->where(['id'=>$id,'username'=>$name])->get()->toArray();

        $data = $data ? $data[0] : [];

        if(empty($data)) ['status'=>false];
        $password = Str::random(10);
        $title = 'Tapplus业务中心密码重置通知！';
        $content = '您的Tapplus业务中心密码已重置，请登录后修改密码！'."\r\n".'密码：'.$password;
        if($data->email){
            $to = $data->email;
            Mail::raw($content, function ($message) use ($title,$to){
                $message ->to($to)->subject($title);
            });
            if(empty(Mail::failures())){
                DB::table('admin_users')->where(['id'=>$id,'username'=>$data->username])->update([
                    'password' => bcrypt($password)
                ]);
                return ['status'=>true];
            }else{
                return ['status'=>false,'data'=>Mail::failures()];
            }
        }else{
            $Qweixin = new Qweixin();
            DB::table('admin_users')->where(['id'=>$id,'username'=>$data->username])->update([
                'password' => bcrypt($password)
            ]);
            return $Qweixin->setmessage($data->username, $content);
        }
    }

    protected function script($data)
    {
        $url = route('dcat.admin.resetPassword');
        return <<<JS
        $('.reset_password').on('click',function(){
            var id = $(this).attr('admin_id');
            var name = $(this).attr('admin_name');
            $.ajax({
                        url: "$url",
                        data: {name:name,id:id},
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            if(data.hasOwnProperty('status')){
                                if(!data.status){
                                     Dcat.warning(data.errmsg);return;
                                }
                                Dcat.success('重置成功');
                            }else{
                                if(data.errcode){
                                    Dcat.warning(data.errmsg);return;
                                }
                                Dcat.success('重置成功');
                            }
                        }
                    });
        });
JS;
    }
}