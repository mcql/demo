<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\index\index.html";i:1555566150;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Mitalk密聊</title>
    <link href="__COMMON__/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/static/phone/layui/css/layui.css">
    <link rel="stylesheet" href="/public/static/phone/layui/css/layui.mobile.css">
    <link rel="stylesheet" href="/public/static/phone/mine/iconfont.css">
    <style>
        .ad {
            display:none!important;display:none
        }
        .choose {
            margin-top: 10px;
        }
        .chooseOne {
            margin: 0px 15px 0 3px;
            position: relative;
            top: 7px;
        }
        .layui-input-block input,.layui-input-block span {
            margin-top: 13px;
        }
        .sex {
            text-align: left;
            width: auto;
        }
        .sex-left {
            width: 70%;
            margin-left: 0;
        }
        .inputfile {
            position: absolute;
            top: 0;
            height: 100%;
            opacity: 0;
            width: 100%;
        }
        a:active {
            text-decoration: none;
        }
        a:hover {
            text-decoration: none;
        }
        a:visited {
            text-decoration: none;
        }
    </style>
</head>
<body>

<script src="/public/static/phone/layui/layui.js"></script>
<script>
    var userlist = <?php echo $userlist; ?>;
    var m_uid = "<?php echo $uinfo['id']; ?>";
    var m_uname = "<?php echo $uinfo['username']; ?>";
    var m_avatar = "<?php echo $uinfo['avatar']; ?>";
    var m_sign = "<?php echo $uinfo['sign']; ?>";
    var socket = '';
    var socket_server = "ws://<?php echo $socket_server; ?>";
</script>
<script src="/public/static/phone/phone.js"></script>
<script>
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
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        $("body").on("touchstart",'.showOnline,.layim-list-gray', function(e) {
            // 判断默认行为是否可以被禁用
            if (e.cancelable) {
                // 判断默认行为是否已经被禁用
                if (!e.defaultPrevented) {
                    e.preventDefault();
                }
            }
            startX = e.originalEvent.changedTouches[0].pageX,
                startY = e.originalEvent.changedTouches[0].pageY;
        });
        $("body").on("touchend",'.showOnline,.layim-list-gray', function(e) {
            var that = $(this);
            // 判断默认行为是否可以被禁用
            if (e.cancelable) {
                // 判断默认行为是否已经被禁用
                if (!e.defaultPrevented) {
                    e.preventDefault();
                }
            }
            moveEndX = e.originalEvent.changedTouches[0].pageX,
                moveEndY = e.originalEvent.changedTouches[0].pageY,
                X = moveEndX - startX,
                Y = moveEndY - startY;
            //左滑
            if ( X > 0 ) {
                //询问框
                layer.open({
                    content: '您确定要删除该好友吗？'
                    ,btn: ['是', '否']
                    ,yes: function(index){
                        $.post("/Phone/Index/delFriend", {
                            uid: that.attr('data-uid'),
                        }, function (data) {
                            showSuccess(data);
                            that.remove();
                            $('.layim-count').html($('.layim-count').html() - 1);
                        }, 'json');
                        layer.close(index);
                    }
                });
            }
            //右滑
            else if ( X < 0 ) {
                //询问框
                layer.open({
                    content: '您确定要删除该好友吗？'
                    ,btn: ['是', '否']
                    ,yes: function(index){
                        $.post("/Phone/Index/delFriend", {
                            uid: that.attr('data-uid'),
                        }, function (data) {
                            showSuccess(data);
                            that.remove();
                            $('.layim-count').html($('.layim-count').html() - 1);
                        }, 'json');
                        layer.close(index);
                    }
                });
                return;
            }
            //下滑
            /*else if ( Y > 0) {
                alert('下滑');
            }
            //上滑
            else if ( Y < 0 ) {
                alert('上滑');
            }*/
            //单击
            /*else{
                alert('单击');
            }*/
        });

    });
</script>
<style>
    .layim-list-top li .layui-icon,.layim-list-top li[layim-event="about"] .layui-icon{
        font-size: 18px;
    }
    .layim-list-top{
        font-size: 14px;
    }
    .layim-tab-content li h5 *{
        font-size: 14px;
    }
    .showOnline > span {
        color: #22232b;
        font-size: 16px;
        font-weight: 700;
    }
    .layui-layim-list li{
        height: 60px;
    }
    .layui-layim-list li img{
        top: 20px;
        border-radius: 50%;
        box-sizing: border-box;
        box-shadow: 1px 1px 5px #c5c5c5;
    }
    .layui-layim-list li span{
        margin-top: 15px;
    }
    .layim-title{
        height: 40px;
        line-height: 40px;
    }
    .layim-content,.layui-layim{
        top: 40px;
    }
    .search_m {
        position: relative;
    }
    .search_m input{
        width: 100%;
        height: 32px;
        border-radius: 20px;
        border: 1px solid #e9e9e9;
        padding-left: 20px;
        box-sizing: border-box;
    }
    .search_m span {
        line-height: 32px;
        position: absolute;
        right: 20px;
        top: 0;
    }
    .layui-elem-quote{
        font-size: 14px;
        font-weight: 700;
        color: #22232b;
    }
    .layui-elem-quote{
        padding: 9px;
        background-color: #fff;
    }
    .flex-m{
        display: flex!important;
        justify-content: space-between;
        align-items: center;
        margin-top: -3px;
    }
    .flex-m .layui-btn{
        font-size: 14px;
        line-height: 28px;
        height: 28px;
    }
    .create_qun{
        width: 100%;
        line-height: 32px;
        background-color: #fb3838b0;
        color: #fff;
        border-radius: 8rem;
        text-align: center;
        margin: 20px auto 0;
    }
    .layui-layim-tab li span{
        margin-top: 3px;
    }
</style>
</body>
</html>