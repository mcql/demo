<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"/www/wwwroot/im.blockhp.com/application/phone/view/wallet/index.html";i:1555684878;s:69:"/www/wwwroot/im.blockhp.com/application/phone/view/common/header.html";i:1555468160;s:69:"/www/wwwroot/im.blockhp.com/application/phone/view/common/footer.html";i:1554651692;}*/ ?>
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
<style>
    #app>.vux-header, body .vux-header{
        background-color: #fff;
    }
    body .vux-header .vux-header-title{
        font-size: 1rem;
        color: #22232b;
    }
    .app-body {
        margin-bottom: 70px;
    }
    .div-hade {
        display: none;
    }
    .name-change {
        border: 1px solid #ccc;
        padding-left: .4rem;
        border-radius: .3rem;
        height: 2rem;
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
    .coin {
        float: right;
    }
    .icon_bi {
        width: 24px;
        margin-right: .5rem;
    }
    .icon_bi a {
        color:#4d557a;
    }
    .user-portrait{
        width: 5rem;
        height: 5rem;
        box-sizing: border-box;
        padding: 4px;
        background: #fff;
        border-radius: 2.5rem;
        box-shadow: 0 2px 15px 0 rgba(33,93,247,.2);
    }
    .user-portrait img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: block;
    }
    #change_pic{
        display: none;
    }
    .usercenter{
        background-color: #f15473;
        box-shadow:0 0 3px rgba(0,0,0,.4);
        width: 95%;
        margin: 1rem auto;
        padding: 1rem;
        border-radius: .3rem;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .user-name{
        margin-top: .5rem;
    }
    .name{
        color: #fff;
        font-size: 16px;
        margin-left: 1rem;
        line-height: 32px;
    }
    .userinfo{
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .coiName{
        width: 95%;
        margin: .5rem auto;
        background-color: #f4f4f4;
        border-radius: .4rem;
    }
    .weui-cells{
        background-color: transparent;
    }
    #app,#app>.app-body{
        background-color: #fff;
    }
    .weui-cell:before{
        border: 0;
    }
</style>
<div id="app"><!---->
    <div class="vux-header">
        <div class="vux-header-left">
            <span class="iconfont left-arrow">&#xe61f;</span>
        </div>
        <h1 class="vux-header-title">我的钱包</h1>
        <div class="vux-header-right">
            <a href="<?php echo url('Index/index'); ?>" class="exalt">
                <span class="iconfont backChat">&#xe658;</span>
            </a>
        </div>
    </div>
    <div class="app-body">
        <div class="page-user-center">
            <!-- <div class="center-banner">
                <div class="vux-flexbox user-info vux-flex-col" style="justify-content: center;">
                    <div class="user-portrait">
                        <img src="<?php echo $userInfo['avatar']; ?>" alt="">
                        <div class="upload-btn">
                            <div class="g-core-image-upload-btn btn btn-primary">
                                <form method="post" enctype="multipart/form-data" action="" class="g-core-image-upload-form">
                                    <input name="file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="user-name">
                        <div class="name"><?php echo $userInfo['username']; ?></div>
                    </div>
                </div>
            </div> -->
            <div class="usercenter">
                <label for="change_pic">
                    <input name="file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id='change_pic'>
                    <div class="userinfo">
                        <div class="user-portrait">
                            <img src="<?php echo $userInfo['avatar']; ?>" alt="">
                        </div>
                    </div>
                </label>
                <div class="user-name">
                    <div class="name"><?php echo $userInfo['username']; ?></div>
                    <!--<div class="name">总资产：12345.00</div>-->
                </div>
            </div>
            <div class="user-list-box">
                <div><!---->
                    <div class="weui-cells vux-no-group-title">
                        <div class="weui-cell vux-tap-active weui-cell_access coiName" data-coin-type="bhp">
                            <div class="weui-cell__hd">
                                <img src="/public/static/images/bi_ioc/bhp.png" class="icon_bi" alt="">
                                <!-- <span class="iconfont logo">&#xe6cb;</span> -->
                            </div>
                            <div class="vux-cell-bd vux-cell-primary">
                                <a href="<?php echo url('CoinShow'); ?>?coin=btc">
                                    <p>
                                        <label class="vux-label">
                                            BTC
                                            <span class="coin btcLst"><?php echo $userInfo['btcLst']; ?></span>
                                        </label>
                                    </p>
                                    <span class="vux-label-desc"></span>
                                </a>
                            </div>
                        </div>
                    <div class="weui-cells vux-no-group-title">
                        <div class="weui-cell vux-tap-active weui-cell_access coiName" data-coin-type="bhp">
                            <div class="weui-cell__hd">
                                <img src="/public/static/images/bi_ioc/bhp.png" class="icon_bi" alt="">
                                <!-- <span class="iconfont logo">&#xe6cb;</span> -->
                            </div>
                            <div class="vux-cell-bd vux-cell-primary">
                                <a href="<?php echo url('CoinShow'); ?>?coin=bhp">
                                    <p>
                                        <label class="vux-label">
                                            BHP
                                            <span class="coin bhpLst"><?php echo $userInfo['bhpLst']; ?></span>
                                        </label>
                                    </p>
                                    <span class="vux-label-desc"></span>
                                </a>
                            </div>
                        </div>
                        <div class="weui-cell vux-tap-active weui-cell_access coiName" data-coin-type="eth">
                            <div class="weui-cell__hd">
                                <!-- <span class="iconfont logo">&#xe6cb;</span> -->
                                <img src="/public/static/images/bi_ioc/eth.png" class="icon_bi" alt="">
                            </div>
                            <div class="vux-cell-bd vux-cell-primary">
                                <a href="<?php echo url('CoinShow'); ?>?coin=eth">
                                    <p>
                                        <label class="vux-label">
                                            ETH
                                            <span class="coin ethLst"><?php echo $userInfo['ethLst']; ?></span>
                                        </label>
                                    </p>
                                    <span class="vux-label-desc"></span>
                                </a>
                            </div>
                        </div>
                        <div class="weui-cell vux-tap-active weui-cell_access coiName" data-coin-type="usdt">
                            <div class="weui-cell__hd">
                                <img src="/public/static/images/bi_ioc/usdt.png" class="icon_bi" alt="">
                                <!-- <span class="iconfont logo">&#xe6cb;</span> -->
                            </div>
                            <div class="vux-cell-bd vux-cell-primary">
                                <a href="<?php echo url('CoinShow'); ?>?coin=usdt">
                                    <p>
                                        <label class="vux-label">
                                            USDT
                                            <span class="coin usdtLst"><?php echo $userInfo['usdtLst']; ?></span>
                                        </label>
                                    </p>
                                    <span class="vux-label-desc"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
    } else {
        // set the provider you want from Web3.providers
        web3 = new Web3('http://47.74.33.78:8545');
    }

    $(function(){
        //查询eth余额
        var ethAddress = "<?php echo $userInfo['ethAddress']; ?>";
        web3.eth.getBalance(ethAddress, function(err, resp){
            if(!err){
                var eth = web3.utils.fromWei(resp, 'ether');
                $(".ethLst").html(eth);
            }else{
                console.log(err);
            }
        });

        //查询usdt余额
        getUsdtLst();
        //查询bhp余额
        getBhpLst();


        function getUsdtLst()
        {
            // 定义合约
            var usdtContractAddress = '0xdac17f958d2ee523a2206206994597c13d831ec7';
            var usdtAddress = "<?php echo $userInfo['usdtAddress']; ?>";
            var myContract = new web3.eth.Contract([
                {
                    "constant": true,
                    "inputs": [],
                    "name": "name",
                    "outputs": [
                        {
                            "name": "",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_spender",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "approve",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "totalSupply",
                    "outputs": [
                        {
                            "name": "",
                            "type": "uint256"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_from",
                            "type": "address"
                        },
                        {
                            "name": "_to",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "transferFrom",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "decimals",
                    "outputs": [
                        {
                            "name": "",
                            "type": "uint8"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "version",
                    "outputs": [
                        {
                            "name": "",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [
                        {
                            "name": "_owner",
                            "type": "address"
                        }
                    ],
                    "name": "balanceOf",
                    "outputs": [
                        {
                            "name": "balance",
                            "type": "uint256"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "symbol",
                    "outputs": [
                        {
                            "name": "",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_to",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "transfer",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_spender",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        },
                        {
                            "name": "_extraData",
                            "type": "bytes"
                        }
                    ],
                    "name": "approveAndCall",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [
                        {
                            "name": "_owner",
                            "type": "address"
                        },
                        {
                            "name": "_spender",
                            "type": "address"
                        }
                    ],
                    "name": "allowance",
                    "outputs": [
                        {
                            "name": "remaining",
                            "type": "uint256"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "inputs": [
                        {
                            "name": "_initialAmount",
                            "type": "uint256"
                        },
                        {
                            "name": "_tokenName",
                            "type": "string"
                        },
                        {
                            "name": "_decimalUnits",
                            "type": "uint8"
                        },
                        {
                            "name": "_tokenSymbol",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "constructor"
                },
                {
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "fallback"
                },
                {
                    "anonymous": false,
                    "inputs": [
                        {
                            "indexed": true,
                            "name": "_from",
                            "type": "address"
                        },
                        {
                            "indexed": true,
                            "name": "_to",
                            "type": "address"
                        },
                        {
                            "indexed": false,
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "Transfer",
                    "type": "event"
                },
                {
                    "anonymous": false,
                    "inputs": [
                        {
                            "indexed": true,
                            "name": "_owner",
                            "type": "address"
                        },
                        {
                            "indexed": true,
                            "name": "_spender",
                            "type": "address"
                        },
                        {
                            "indexed": false,
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "Approval",
                    "type": "event"
                }
            ], usdtContractAddress, {
                from: usdtAddress, // default from address
                gasPrice: '10000000000' // default gas price in wei, 10 gwei in this case
            });
            myContract.methods.balanceOf(usdtAddress).call(function(err, tkns){
                if (!err) {
                    var result = web3.utils.fromWei(tkns, 'mwei');
                    $(".usdtLst").html(result);
                }else{
                    //循环查询
                    getUsdtLst();
                }
            });
        }

        //查询bhp余额
        function getBhpLst()
        {

            // 定义合约
            var bhpContractAddress = '0xf2cc0b71caaa4338d842729cf1639eb6dc787e89';
            var bhpAddress = "<?php echo $userInfo['bhpAddress']; ?>";
            var myContract = new web3.eth.Contract([
                {
                    "constant": true,
                    "inputs": [],
                    "name": "name",
                    "outputs": [
                        {
                            "name": "",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_spender",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "approve",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "totalSupply",
                    "outputs": [
                        {
                            "name": "",
                            "type": "uint256"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_from",
                            "type": "address"
                        },
                        {
                            "name": "_to",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "transferFrom",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "decimals",
                    "outputs": [
                        {
                            "name": "",
                            "type": "uint8"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "version",
                    "outputs": [
                        {
                            "name": "",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [
                        {
                            "name": "_owner",
                            "type": "address"
                        }
                    ],
                    "name": "balanceOf",
                    "outputs": [
                        {
                            "name": "balance",
                            "type": "uint256"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [],
                    "name": "symbol",
                    "outputs": [
                        {
                            "name": "",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_to",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "transfer",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": false,
                    "inputs": [
                        {
                            "name": "_spender",
                            "type": "address"
                        },
                        {
                            "name": "_value",
                            "type": "uint256"
                        },
                        {
                            "name": "_extraData",
                            "type": "bytes"
                        }
                    ],
                    "name": "approveAndCall",
                    "outputs": [
                        {
                            "name": "success",
                            "type": "bool"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "function"
                },
                {
                    "constant": true,
                    "inputs": [
                        {
                            "name": "_owner",
                            "type": "address"
                        },
                        {
                            "name": "_spender",
                            "type": "address"
                        }
                    ],
                    "name": "allowance",
                    "outputs": [
                        {
                            "name": "remaining",
                            "type": "uint256"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "view",
                    "type": "function"
                },
                {
                    "inputs": [
                        {
                            "name": "_initialAmount",
                            "type": "uint256"
                        },
                        {
                            "name": "_tokenName",
                            "type": "string"
                        },
                        {
                            "name": "_decimalUnits",
                            "type": "uint8"
                        },
                        {
                            "name": "_tokenSymbol",
                            "type": "string"
                        }
                    ],
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "constructor"
                },
                {
                    "payable": false,
                    "stateMutability": "nonpayable",
                    "type": "fallback"
                },
                {
                    "anonymous": false,
                    "inputs": [
                        {
                            "indexed": true,
                            "name": "_from",
                            "type": "address"
                        },
                        {
                            "indexed": true,
                            "name": "_to",
                            "type": "address"
                        },
                        {
                            "indexed": false,
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "Transfer",
                    "type": "event"
                },
                {
                    "anonymous": false,
                    "inputs": [
                        {
                            "indexed": true,
                            "name": "_owner",
                            "type": "address"
                        },
                        {
                            "indexed": true,
                            "name": "_spender",
                            "type": "address"
                        },
                        {
                            "indexed": false,
                            "name": "_value",
                            "type": "uint256"
                        }
                    ],
                    "name": "Approval",
                    "type": "event"
                }
            ], bhpContractAddress, {
                from: bhpAddress, // default from address
                gasPrice: '10000000000' // default gas price in wei, 10 gwei in this case
            });
            myContract.methods.balanceOf(bhpAddress).call(function(err, tkns){
                if (!err) {
                    result = tkns / 100000000;
                    $(".bhpLst").html(result);
                    console.log(result);
                }else{
                    //循环查询
                    getBhpLst();
                }
            });
        }
    });
</script>
<script>
    $(function(){
        //返回上一页
        $('.left-arrow').click(function(){
            history.go(-1);
        });
    });
</script>
</body>
</html>