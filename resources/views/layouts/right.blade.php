<ul class="nav navbar-nav">
    <li class="dropdown dropdown-language nav-item">

    </li>
</ul>
<script>
    function first(data){
        layer.prompt({title: '第一次登陆，请先修改密码！！', formType: 1,placeholder:'新密码',btn2:function(){
                first(data);
            }}, function(pass, index){
            layer.close(index);
            var password_confirmation = $('#password_confirmation').val();
            //->rules('required|regex:/^[^\s\/"\"]+$/')
            if(pass.length<10 || pass.length>20){
                layer.msg('长度大于10小于20');return;
            }
            var reg = new RegExp('/^[^\\s\\/"\\"]+$/');
            if(reg.test(pass)){
                layer.msg('不能空格或反斜杠');
            }
            $('.layui-layer-shade').css('display','none');
            $.ajax({
                type: "POST",
                url: '/admin/auth/setting',
                data: {
                    username:data.username,
                    name:data.name,
                    password:pass,
                    password_confirmation:password_confirmation,
                    is_first:0,
                },
                dataType: "json",
                success: function(data){
                    layer.msg(data.data.message);
                }
            });
        });
        console.log('.layui-layer-content');
        var zindex = $('#layui-layer1').css('z-index');
        $('.layui-layer-move').after('<div class="layui-layer-shade" id="layui-layer-shade100005" times="100005" style="z-index: 1000; background-color: rgb(0, 0, 0); opacity: 0.3;"></div>')
        $(".layui-layer-content").append("<br/><input type=\"text\" id= \"password_confirmation\" class=\"layui-layer-input\" placeholder=\"确认密码\"/>")
    }
    Dcat.ready(function () {
        var data = JSON.parse('<?=json_encode(Dcat\Admin\Models\Administrator::find(Illuminate\Support\Facades\Auth::guard('admin')->id())) ?>');
        var is_first = parseInt(data.is_first);
        if(is_first){
            //prompt层
            first(data);
        }
    });
</script>