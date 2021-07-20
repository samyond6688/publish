<link rel="stylesheet" href="/admin_static/css/login_ercode.css">
<!--
    #fbbd08
    color: #fbbd08;
 -->
<style>
    .form-control-position{
        line-height:3.3rem!important;
    }

</style>
<div class="main">
    <div class="main_bg">
        <div class="loginBox">
            <!-- signContent -->
            <div class="signContent">
                <div class="signContainer" style="height: 400px;">
                    <form action="" class="loginForm" id="login-form" data-module="smsFrom"  method="POST" action="{{ admin_url('auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <!-- tab -->
                        <div class="tabBox">
                            <div class="tabBoxSwitch">
                                <div style="display:block;margin: auto auto;height: 100px;"><img style="margin-top: 40px;width: 80%;margin-left: 30px;" width="100%" src="/admin_static/img/logo_title.png"></div>


                                <div class="ercode_tab swicth-ercode">
                                    <img width="52" src="/admin_static/img/image2.png" />
                                </div>
                            </div>
                        </div>
                        <!-- tabContent -->
                        <div class="tabContent">
                            <!-- tabContentPhone -->
                            <!-- tabContentAccount -->
                            <div class="tabcont tabContentAccount active">
                                <div class="tabcontent">

                                    <fieldset class="form-label-group form-group position-relative has-icon-left" style="width: 98%">
                                        <input
                                                type="text"
                                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                                name="username"
                                                placeholder="{{ trans('admin.username') }}"
                                                value="{{ old('username') }}"
                                                required
                                                autofocus
                                        >

                                        <div class="form-control-position">
                                            <i class="feather"><img width="20" src="/admin_static/img/name.png"></i>
                                        </div>
                                        @if($errors->has('username'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('username') as $message)
                                                    <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span><br>
                                                @endforeach
                                        </span>
                                        @endif

                                    </fieldset>
                                </div>
                                <div class="tabcontent">
                                    <fieldset class="form-label-group form-group position-relative has-icon-left" style="width: 98%">
                                        <input
                                                minlength="10"
                                                maxlength="20"
                                                id="password"
                                                type="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                name="password"
                                                placeholder="{{ trans('admin.password') }}"
                                                required
                                                autocomplete="current-password"
                                                data-maxlength-error="密码长度10-20位"
                                        >

                                        <div class="form-control-position">
                                            <i class="feather"><img width="20" src="/admin_static/img/password.png"></i>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('password') as $message)
                                                    <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span><br>
                                                @endforeach
                                            </span>
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="tabcontent">

                                    <fieldset class="form-label-group form-group position-relative has-icon-left" style="width: 98%;position: relative;background: url('/admin_static/img/code1.png')">
                                        <input type="text" class="form-control " name="captcha" placeholder="验证码" value="" required="" autofocus="">
                                        <div class="form-control-position"  style="background: url('/admin_static/img/code1.png')">
                                            <i class="feather"><img width="20" src="/admin_static/img/code1.png"></i>
                                        </div>
                                        <img style="border-radius:8px;position:absolute;margin-top: 0px;right: 9px;top: 9px;" width="80px" src="{{url('admin/captcha')}}" alt="captcha" onclick="this.src=this.src+'?'+'id='+Math.random()">
                                    </fieldset>


                                </div>
                                <div class="form-group d-flex justify-content-between align-items-center" style="justify-content: flex-end!important;">
                                    <!--<div class="text-left"><fieldset class="checkbox" ><div><a href="/admin/forgetPassword"> {{ trans('admin.forget_password') }}</a></div></fieldset></div>-->
                                    <div class="text-right" style="">

                                        @if(config('admin.auth.remember'))
                                            <fieldset class="checkbox">

                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input id="remember" name="remember"  value="1" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                          <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>


                                                    <span> {{ trans('admin.remember_name') }}</span>
                                                </div>
                                            </fieldset>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button style="margin-top:-10px;font-size: 18px;font-weight: 900;" id="submit" type="submit" class="button fromSubmit"
                                data-type="smsSubmit">
                            {{ __('admin.login') }}
                            &nbsp;
                        </button>
                        <!-- tips -->
                    </form>
                    <!-- ercodeSgin -->
                    <div class="ercodeSignBox">
                        <div class="ercode_tab switch-input">
                            <img width="52" src="/admin_static/img/close.png"/>
                        </div>
                        <!-- ercodeConent -->
                        <div class="ercodeContent">
                            <div class="Qrcode-title">扫码登录</div>
                            <div class="ercodeBox">
                                <div class="Qrcode-img" id="qrcode">
                                    <img width="150" height="150" src="/admin_static/img/close.png" alt="二维码"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--  -->
            <div class="css-1hmxk26"></div>
        </div>
    </div>
</div>
</div>
<script src="/admin_static/js/login.js"></script>
<script src="/admin_static/js/qrcode.js"></script>
<script>
    Dcat.ready(function () {

        // ajax表单提交
        $('#login-form').form({
            validate: true,
            error: function (responses) {
                var response= responses.responseJSON;
                if (! response.status) {
                    for(var key in response.errors){
                        console.log(key);
                        if(key=='captcha'){
                            console.log($('input[name="captcha"]').siblings('.form-control-position'));
                            $('input[name="captcha"]').siblings('img').trigger('click');
                        }
                        Dcat.error(response.errors[key]);
                    }
                    return false;
                }
            }
        });
    });
</script>

<script type="text/javascript">
    function re_captcha() {
        $url = "{{ URL('/code/captcha') }}";
        $url = $url + "/1?a=" + Math.random();
        document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
    }
</script>
//1.引入企业微信js文件
<script type="text/javascript" src="https://rescdn.qqmail.com/node/ww/wwopenmng/js/sso/wwLogin-1.0.0.js"></script>


//3. js参数配置
<script type="text/javascript">

    $(".swicth-ercode").click(function (e) {
        e.preventDefault();
        $("form#login-form").hide();
        $(".ercodeSignBox").show();
        window.WwLogin({
            "id" : "qrcode",
            "appid" : 'ww245fc7dc10e8dc26',
            "agentid" : '1000054',
            "redirect_uri" :"https://haiwai-admin.3kwan.com/admin/api/thirdLogin",     //回调页面
            "state" : "qwx_login",
            "href" : "",
        });
    });
    $(".switch-input").click(function (e) {
        e.preventDefault();
        $("form#login-form").show();
        $(".ercodeSignBox").hide();
    });


</script>
