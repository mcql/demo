<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/www/wwwroot/im.blockhp.com/application/phone/view/login/register.html";i:1554520298;}*/ ?>
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
        .choose {
            margin-top: 10px;
        }
        .chooseOne {
            margin: 0 15px 0 3px;
            position: relative;
            top: -3px;
        }
        .layui-input-block input,.layui-input-block span {
            margin-top: 13px;
        }
        .sex {
            text-align: left;
        }
        .sex-left {
            width: 70%;
            margin-left: 0;
        }
    </style>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <h4>欢迎注册 Mitalk密聊</h4>
        <form class="m-t" role="form" action="<?php echo url('login/doRegister'); ?>" id="login_form" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="邮箱" name="truename"  required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="密码" name="pwd" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="确认密码" name="repwd" required="">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="昵称" name="user_name"  required="">
            </div>
            <div class="form-group">
                <label for="sex" class="layui-form-label sex">性别:</label>
                <div class="layui-input-block sex-left">
                    <input class="choose" name="sex" value="1" title="男" checked="" type="radio">
                    <span class="chooseOne">男</span>
                    <input class="choose" name="sex" value="-1" title="女" type="radio">
                    <span class="chooseOne">女</span>
                </div>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" placeholder="年龄" name="age" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">注 册</button>
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
                        setTimeout(function() {
                            window.location.href = data.data;
                        }, 2000);
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