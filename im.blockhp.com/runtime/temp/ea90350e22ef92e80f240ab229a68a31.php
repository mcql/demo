<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:97:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\wallet\selfpackage.html";i:1555471963;s:92:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\common\header.html";i:1555468160;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $sys['name']; ?></title>
    <meta name="description" content="<?php echo $sys['name']; ?>">
    <meta name="keywords" content="<?php echo $sys['name']; ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta http-equiv="X-Frame-Options" content="deny">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/public/fonts/font.css">
    <link type="text/css" href="/public/static/mobile/css/nc.css" rel="stylesheet" disabled="">
    <link href="/public/static/mobile/css/app.css" rel="stylesheet">
    <script src="/public/static/mobile/js/jquery-3.2.1.min.js"></script>
    <script src="/public/static/mobile/js/layer.js"></script>
    <style>
        @font-face {
            font-family: 'iconfont';
            src: url('/public/static/mobile/fonts/iconfont.eot');
            src: url('/public/static/mobile/fonts/iconfont.eot?#iefix') format('embedded-opentype'),
            url('/public/static/mobile/fonts/iconfont.woff2') format('woff2'),
            url('/public/static/mobile/fonts/iconfont.woff') format('woff'),
            url('/public/static/mobile/fonts/iconfont.ttf') format('truetype'),
            url('/public/static/mobile/fonts/iconfont.svg#iconfont') format('svg');
        }
        .iconfont {
            font-family: "iconfont" !important;
            font-size: 16px;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .app-body {
            margin-bottom: 70px;
        }
        #app .app-body .vux-header, #app>.vux-header, body .vux-header {
            background-color: #ed5356;
        }
    </style>
    <script>
        $(function(){
            //栏目选中
            var url = window.location.pathname;
            $('.app_nav a').each(function(){
                //选中赋予样式
                if(url.toUpperCase().toUpperCase() == $(this).attr('href').toUpperCase())
                {
                    $(this).addClass('weui-bar__item_on');
                }
            });
        })
    </script>
</head>
<body>
<script src="/public/static/mobile/js/web3.1.js"></script>
<script src="/public/static/mobile/js/jquery.qrcode.min.js"></script>
<script src="/public/static/mobile/js/clipboard.min.js"></script>
<style>
    .div-hade {
        display: none;
    }
    .mine-center .rank-box .rank-item {
        min-height: 4rem;
        word-break:break-all;
        padding: 0 3rem;
    }
    .special-div {
        text-align: center;
        font-size: 1rem;
    }
    .qrcode {
        width: 150px;
        height: 150px;
        display: block;
        border: 1px solid #f4f4f4;
        margin: 0 auto;
    }
    .spec-span {
        width: 80%;
        display: block;
        margin: 0 auto;
    }
    .special-item {
        height: 12rem !important;
    }
    .for-copy {
        margin-top: 2rem;
    }
    .for-copy .copy {
        border-radius: 5px;
        font-size: 1rem;
        width: 95%;
        margin: 0 auto;
        background-color: #f15473;
    }
    .copy {
        background: #666;
    }
    .left-arrow {
        color: #444;
        position: relative;
        top: 4px;
        line-height: 30px;
        font-size: 1.9rem;
    }
    .backChat {
        color: #444;
        position: relative;
        font-size: 1.2rem;
    }
    .user-list-box .weui-cell .iconfont {
        position: relative;
        font-size: 2rem;
        top: 3px;
    }
    #wallet_create .tip[data-v-2f9b2984] {
        background: #fb3838;
    }
    .weui-btn_primary {
        background-color: #ed5356;
    }
    #app>.app-body {
        height: auto;
        margin-bottom: 0;
    }
    #app>.vux-header, body .vux-header{
        background-color: #fff;
    }
    body .vux-header .vux-header-title{
        font-size: 1rem;
        color: #22232b;
        font-weight: 700;
    }
    #app,#app>.app-body{
        background-color: #fff;
    }
    .special-div{
        font-size: 1.2rem;
        font-weight: 700;
        color: #1d415b;
        text-align: left;
        text-indent: 1rem;
        padding-top: 1.5rem;
    }
    .mine-center .rank-box .rank-item{
        padding: 0;
        border-radius: .4rem;
        width: 95%;
        margin: 1rem auto 0;
    }
    .mine-center .rank-box .rank-item .rank-power{
        background-color: #f7f6fb;
        padding: 1rem 0;
        box-sizing: border-box;
        border-radius: .4rem;
    }
</style>
<div id="app">
    <div class="vux-header">
        <div class="vux-header-left">
            <span class="iconfont left-arrow">&#xe61f;</span>
        </div>
        <h1 class="vux-header-title">钱包地址</h1>
        <div class="vux-header-right">
            <a href="<?php echo url('Index/index'); ?>" class="exalt">
                <span class="iconfont backChat">&#xe658;</span>
            </a>
        </div>
    </div>
    <div class="app-body">
        <div data-v-2f9b2984="" id="wallet_create">
            <?php if($openStatus == 0): ?>
            <div data-v-2f9b2984="" class="tip">
                <ul data-v-2f9b2984="" class="tip_ul">
                    <li data-v-2f9b2984="">密码用于保护私钥和交易授权，强度非常重要</li>
                    <li data-v-2f9b2984="">钱包不存储密码，也无法帮您找回，请务必牢记</li>
                </ul>
            </div>
            <div>
                <div class="weui-cells vux-no-group-title">
                    <div data-v-2f9b2984="" class="vux-x-input weui-cell">
                        <div class="weui-cell__hd"></div>
                        <div class="weui-cell__bd weui-cell__primary">
                            <input id="package" maxlength="16" autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" type="text" placeholder="请输入钱包名称" class="weui-input">
                        </div>
                    </div>
                    <div data-v-2f9b2984="" class="vux-x-input weui-cell">
                        <div class="weui-cell__hd"></div>
                        <div class="weui-cell__bd weui-cell__primary">
                            <input id="paypassword" maxlength="16" autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" type="password" placeholder="请输入钱包密码" class="weui-input">
                        </div>
                    </div>
                    <div data-v-2f9b2984="" class="vux-x-input weui-cell">
                        <div class="weui-cell__hd"></div>
                        <div class="weui-cell__bd weui-cell__primary">
                            <input id="surepaypassword" maxlength="16" autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" type="password" placeholder="再次输入钱包密码" class="weui-input">
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin: 20px 10px;">
                <button data-v-2f9b2984="" class="weui-btn weui-btn_primary" id="create" style="border-radius: 5px; height: 2.375rem; font-size: 0.875rem;">立即创建
                </button>
            </div>
            <?php else: ?>
            <div data-v-2f9b2984="" class="tip1">
                <div class="tip_ul special-div">
                    收款码
                </div>
            </div>
            <div class="mine-center">
                <div class="rank-box">
                    <div class="rank-block">
                        <div class="rank-item flex-box">
                            <div class="rank-power flex-1">
                                <span class="spec-span"><?php echo $nowCoinAddress; ?></span>
                            </div>
                        </div>
                        <div class="rank-item flex-box special-item">
                            <div class="rank-power flex-1" >
                                <!-- <img  src="/static/mobile/images/wx.jpg" /> -->
                                <div class="qrcode" id="qrcode"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="for-copy">
                <button class="weui-btn found-btn weui-btn_primary copy">
                    复制地址
                </button>
            </div>
            <?php endif; ?> 
            <!--<div data-v-2f9b2984="" style="margin: 20px 10px; text-align: center;">
                <a data-v-2f9b2984="" href="<?php echo url('leadingin'); ?>" class="">
                    导入钱包
                </a>
            </div>-->
        </div>
    </div>
</div>
<script>
    //复制
    var clipboard = new ClipboardJS('.copy', {
        // 通过target指定要复印的节点
        target: function() {
            return document.querySelector('.spec-span');
        }
    });

    clipboard.on('success', function(e) {
        layer.open({
            content: '复制成功!'
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
    });

    clipboard.on('error', function(e) {
        layer.open({
            content: '复制失败!'
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
    });

    $(function(){
        //返回上一页
        $('.left-arrow').click(function(){
            history.go(-1);
        });
    });
</script>

<!-- 钱包 -->
<script type="text/javascript">

    if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
    } else {
        // set the provider you want from Web3.providers
        web3 = new Web3('http://47.74.33.78:8545');
    }

    $(function(){
        $('#create').click(function(){
            var package = $('#package').val();
            var paypassword = $('#paypassword').val();
            var surepaypassword = $('#surepaypassword').val();

            if(package == '' || paypassword == '' || surepaypassword == '')
            {
                //提示
                layer.open({
                    content: '请填写钱包信息完整!'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            }

            if(paypassword != surepaypassword)
            {
                //提示
                layer.open({
                    content: '两次密码不一致!'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            }

            var account = web3.eth.accounts.create(surepaypassword);
            private = account.privateKey;
            address = account.address;

            //传送数据
            $.ajax({
                type: 'POST',
                url: '<?php echo url("selfpackage"); ?>',
                data: {
                    'package': package,
                    'paypassword': paypassword,
                    'surepaypassword': surepaypassword,
                    'private' : private,
                    'address' : address
                },
                dataType: 'json',
                success: function(data){

                    //提示
                    layer.open({
                        content: data.msg
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });

                    if(data.status == 200)
                    {
                        setTimeout(function(){
                            location.href = "<?php echo url('/Phone/Wallet/index'); ?>";
                        },1000);
                    }
                }
            });

        });
    });
</script>

<!-- 二维码 -->
<script type="text/javascript">
    $("#qrcode").qrcode({
        render: "table", //table方式
        width: 150, //宽度
        height: 150, //高度
        text: "<?php echo $userInfo['etcads']; ?>" //任意内容
    });
</script>

</body>
</html>