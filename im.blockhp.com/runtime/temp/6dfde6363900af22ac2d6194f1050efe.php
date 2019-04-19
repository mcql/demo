<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\login\index.html";i:1555658311;}*/ ?>
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
        .bgImg {
            width: 40%;
            margin-bottom: 20px;
        }
        .titleH {
            margin-bottom: 20px;
        }
        .gray-bg{
            background: url(/public/static/phone/images/login_bg.jpg) no-repeat center center;
            background-size: cover;
        }
    </style>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <img class="bgImg" src="/public/static/common/images/bc_logo.png" />
        </div>
        <h4 class="titleH">欢迎登录 Mitalk密聊</h4>
        <form class="m-t" role="form" action="<?php echo url('login/dologin'); ?>" id="login_form" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="邮箱" name="user_name"  required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="密码" name="pwd" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            <a href="<?php echo url('register'); ?>" class="btn btn-primary block full-width m-b">注 册</a>
            <a href="<?php echo url('forgetPwd'); ?>" style="margin-top:20px;display:block;" class="forgetPwd">忘记密码？</a>
        </form>
    </div>
</div>
<style>
    .loginscreen.middle-box{
        width:calc(100% - 30px);
    }
    .m-b{
        width:100%;
        line-height: 32px;
        padding:0;
        background-color: #fb3838b0;
        color: #fff;
        border-radius: 8rem;
        text-align: center;
        margin: 20px auto 0;
    }
</style>
<script src="__COMMON__/jquery.min.js"></script>
<script src="__COMMON__/bootstrap.min.js?v=3.3.6"></script>
<script src="__COMMON__/layui/layui.js"></script>
<script src="__COMMON__/jquery.form.js"></script>
<script type="text/javascript">
    $(function(){
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        $('#login_form').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });

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
                        window.location.href = data.data;
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