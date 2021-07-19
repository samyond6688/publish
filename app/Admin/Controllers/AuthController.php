<?php

namespace App\Admin\Controllers;

use App\Models\AdminUser;
use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\AuthController as BaseAuthController;
use Dcat\Admin\Layout\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AuthController extends BaseAuthController
{
    protected $view = 'admin.login';
    /**
     * Handle a login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {

        $credentials = $request->only([$this->username(), 'password','captcha']);//增加captcha字段
        $remember = (bool) $request->input('remember', false);
        //$credentials['captcha'] = strtolower(session('milkcaptcha'));
        /** @var \Illuminate\Validation\Validator $validator */

        $validator = Validator::make($credentials, [
            //$this->username() => ['required', 'string', 'max:120'],
            //'password' => ['required', 'string', 'min:6', 'max:20'],
            $this->username() => 'required',
            'password' => 'required',
        ], [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        $captcha = strtolower($credentials['captcha']);
        if (strtolower(session('milkcaptcha')) != $captcha) {
            return response()->json([
                'data'=>[],
                'status'=>false,
                'errors' =>['captcha'=>['请输入正确的验证码']]
            ], 422);
        }
        if ($validator->fails()) {
            return $this->validationErrorsResponse($validator);
        }

        if ($this->guard()->attempt($credentials, $remember)) {
            if($this->guard()->user()->status==0){
                return response()->json([
                'data'=>[],
                'status'=>false,
                'errors' =>['captcha'=>['账号被锁请联系管理员']]
            ], 422);
            }
            $data =  $this->sendLoginResponse($request);
            //dump($this->guard()->getSession()->all());
            return $data;
        }
        return $this->validationErrorsResponse([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

//    protected function sendLoginResponse(Request $request)
//    {
//        //删除旧的会话信息
//        $this->delSessionForRedis();
//        $request->session()->regenerate();
//        //存储新的会话信息
//        $this->setSessionForRedis();
//        return $this->response()
//            ->success(trans('admin.login_successful'))
//            ->locationToIntended($this->getRedirectPath())
//            ->send();
//    }
//
//    /**
//     * 将会话id缓存入token
//     */
//    private function setSessionForRedis()
//    {
//        Redis::set('session_id_'.auth()->id(),'_database__cache:'.session()->getId());
//    }
//
//    /**
//     * 清理旧会话
//     */
//    private function delSessionForRedis()
//    {
//        $key =  Redis::get('session_id_'.auth()->id());
//        if($key){
//            $key =  '_'.trim($key,"_database_");
//            Redis::del($key);
//        }
//    }

    public function putSetting()
    {
        $Admin = new AdminUser();
        $name = $_REQUEST['username'];
        $id = Admin::user()->getKey();
        $data = $Admin->where(['id'=>$id,'username'=>$name])->get()->toArray();
        $data = $data ? $data[0] : [];
        $form = $this->settingForm();
        if (!$data['is_first'] && ! $this->validateCredentialsWhenUpdatingPassword()) {
            $form->responseValidationMessages('old_password', trans('admin.old_password_error'));
        }
        if($data['is_first']){
            $Admin->where(['id'=>$id,'username'=>$name])->update([
                'is_first'=>$_REQUEST['is_first']
            ]);
        }

        return $form->update(Admin::user()->getKey());
    }


}
