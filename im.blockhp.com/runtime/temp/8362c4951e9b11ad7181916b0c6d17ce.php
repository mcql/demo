<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/www/wwwroot/im.blockhp.com/application/phone/view/login/forgetpwd.html";i:1554529484;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitalk密聊</title>
    <link href="__COMMON__/layui/css/layui.css" rel="stylesheet">
    <link href="__COMMON__/css/bootstrap.min.css" rel="stylesheet">
    <link href="__COMMON__/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__COMMON__/css/animate.min.css" rel="stylesheet">
    <link href="__COMMON__/css/style.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <style type="text/css">
        .ad {
            display:none!important;display:none
        }
        .middle-box {
            padding-top: 130px;
        }
        .forgetPwd {
            color: #999;
        }
        .emailCode {
            text-align: left;
        }
    </style>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <h4>重置登录密码</h4>
        <form class="m-t" role="form" action="<?php echo url('login/dologin'); ?>" id="login_form" method="post">
            <div class="form-group emailCode">
                <input type="text" class="form-control email" placeholder="邮箱" name="user_name"  required="">
            </div>
            <button type="button" class="btn btn-primary block full-width m-b getCode">重 置</button>
            <a href="<?php echo url('index'); ?>" class="btn btn-primary block full-width m-b">登 录</a>
        </form>
    </div>
</div>
<script src="__COMMON__/jquery.min.js"></script>
<script src="__COMMON__/bootstrap.min.js?v=3.3.6"></script>
<script src="__COMMON__/layui/layui.js"></script>
<script src="__COMMON__/jquery.form.js"></script>
<script type="text/javascript">
    $(function(){

        //获取验证码
        $('.getCode').click(function(){
            if ($("input[name='user_name']").val() == '' || !$("input[name='user_name']").val().match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)) {
                var data = {};
                data.code = -1;
                data.msg = '邮箱不正确,请重新输入!';
                showSuccess(data);
                return false;
            }
            var email = $("input[name='user_name']").val();

            $.post("<?php echo U('Login/loginCheckEmail'); ?>", {
                email: email,
            }, function (data) {
                showSuccess(data);
            }, 'json');
        });

        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        /*$('#login_form').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });*/

        function showStart(){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                layer.ready(function(){
                    layer.load(0, {shade:false, time:100});
                });
            });
            return true;
        }

        function showSuccess(data){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                layer.ready(function(){
                    if( 1 == data.code ){
                        layer.msg(data.msg, {'time' : 2000});
                    }else{
                        layer.msg(data.msg, {'time' : 2000});
                    }
                });
            });
        }
    });
</script>
</body>
</html>