<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/www/wwwroot/im.blockhp.com/application/phone/view/wallet/toshop.html";i:1555775121;s:69:"/www/wwwroot/im.blockhp.com/application/phone/view/common/header.html";i:1555468160;}*/ ?>
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
<style>
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
        background-color: #f15473;
    }
    #wallet_create {
        margin-top: .5rem;
    }
    .wallet_message{
        padding: 10px 15px;
        font-size: 12px;
        color: #ff0000;
        line-height: 24px;
    }
    #app>.vux-header, body .vux-header{
        background-color: #fff;
    }
    body .vux-header .vux-header-title{
        font-size: 1rem;
        color: #22232b;
    }
    .weui-cells{
        background-color: transparent;
    }
    .weui-cell{
        width: 95%;
        margin: 0 auto;
        background-color: #fff;
        margin-bottom: .5rem;
        border-bottom: 1px solid #e8e8e8;
    }
    .weui-cell:before{
        border: 0;
    }
    .weui-input::placeholder{
        color: #c5cbc9;
    }
    .weui-inpu{
        color: #666666;
    }
    .wallet_message{
        width: 95%;
        margin: 0 auto;
        background-color: #f4f4f4;
        color:#666;
        border-radius: .4rem;
    }
    #app>.app-body{
        background-color: #fff;
    }
    .title{
        font-size: .1rem;
        margin-left: 2.5%;
        color: #35353d;
        font-weight: 700;
    }
</style>
<div id="app">
    <div class="vux-header">
        <div class="vux-header-left">
            <span class="iconfont left-arrow">&#xe61f;</span>
        </div>
        <h1 class="vux-header-title">转商城</h1>
        <div class="vux-header-right">
            <a href="<?php echo url('Index/index'); ?>" class="exalt">
                <span class="iconfont backChat">&#xe658;</span>
            </a>
        </div>
    </div>
    <div class="app-body">
        <div data-v-2f9b2984="" id="wallet_create">
            <div>
                <div class="weui-cells vux-no-group-title">
                    <p class="title">数量</p>
                    <div data-v-2f9b2984="" class="vux-x-input weui-cell">
                        <div class="weui-cell__hd"></div>
                        <div class="weui-cell__bd weui-cell__primary">
                            <input id="swx" maxlength="42" autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" type="number" placeholder="请输入数量" class="weui-input">
                        </div>
                    </div>
                    <p class="title">支付密码</p>
                    <div data-v-2f9b2984="" class="vux-x-input weui-cell">
                        <div class="weui-cell__hd"></div>
                        <div class="weui-cell__bd weui-cell__primary">
                            <input id="paypwd" maxlength="42"autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" type="password" placeholder="请输入支付密码" class="weui-input">
                        </div>
                    </div>
                </div>
            </div>
            <div class='wallet_message'>
                <ul>
                    <li>*交易一旦发生便不可撤回</li>
                </ul>
            </div>
            <div style="margin: 20px 10px;">
                <button data-v-2f9b2984="" class="weui-btn weui-btn_primary" id="create" style="border-radius: 5px; height: 2.375rem; font-size: 0.875rem;">确认转账
                </button>
            </div>

        </div>
    </div>
</div>
<script src="/public/static/mobile/js/web3.1.js"></script>
<!-- 返回上一页 -->
<script>
    $(function(){
        $('.left-arrow').click(function(){
            history.go(-1);
        });

        if (typeof web3 !== 'undefined') {
            web3 = new Web3(web3.currentProvider);
        } else {
            // set the provider you want from Web3.providers
            web3 = new Web3('http://47.74.33.78:8545');
        }

        var coinLst = 0;

        if('<?php echo $coiName; ?>' == 'bhp')
        {
            //查询bhp余额
            getBhpLst();
            function getBhpLst()
            {
                // 定义合约
                var bhpContractAddress = '0xf2cc0b71caaa4338d842729cf1639eb6dc787e89';
                var bhpAddress = "<?php echo $coinAddress; ?>";
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
                        coinLst = result;
                        console.log(result);
                    }else{
                        //循环查询
                        getBhpLst();
                    }
                });
            }
        }

        //转账
        $('#create').click(function(){

            //验证
            if($('#swx').val() == '' || $('#swx').val() <= 0 || $('#paypwd').val() == '')
            {
                layer.open({
                    content: '参数不正确，请重新提交！'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            }

            //验证数量
            if(parseFloat(coinLst) < parseFloat($('#swx').val()))
            {
                layer.open({
                    content: '转出数量不得大于钱包地址剩余数量！'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            }

            //支付密码验证
            $.ajax({
                type: 'POST',
                url: '',
                data: {
                    'paypwd': $('#paypwd').val()
                },
                dataType: 'json',
                success: function(data){
                    if(data.status == 100)
                    {
                        //提示
                        layer.open({
                            content: data.msg
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                    } else {
                        //bhp转账
                        if('<?php echo $coiName; ?>' == 'bhp')
                        {
                            // 定义合约
                            var bhpContractAddress = '0xf2cc0b71caaa4338d842729cf1639eb6dc787e89';
                            var bhpAddress = "<?php echo $coinAddress; ?>";
                            var bhpContract = new web3.eth.Contract([
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

                            //用户自己账户
                            var from = '<?php echo $coinAddress; ?>';
                            var amount = parseFloat($('#swx').val());
                            var number = parseFloat($('#swx').val());
                            var to = '<?php echo $adminBhpAddress; ?>';

                            if(!web3.utils.isAddress(to)){
                                layer.open({
                                    content: '对方钱包地址不正确！'
                                    ,skin: 'msg'
                                    ,time: 2 //2秒后自动关闭
                                });
                                return false;
                            }
                            web3.eth.getTransactionCount(from, function(err, count){

                                if(!err){
                                    var tcount = count;
                                    bhpContract.methods.balanceOf(from).call( function(err, tkns){
                                        if (!err) {
                                            console.log(tkns);
                                            var balance = tkns / 100000000;
                                            var b = new web3.utils.BN(balance);
                                            if(b.toNumber() < amount){
                                                alert('当前钱包BHP余额不足！');
                                                return false;
                                            }

                                            amount = amount * 100000000;
                                            web3.eth.getGasPrice().then(function(gasPrice){

                                                var rawTransaction = {
                                                    "from": from,
                                                    "nonce": "0x" + tcount.toString(16),
                                                    "gasPrice": web3.utils.toHex(gasPrice),
                                                    "gasLimit": web3.utils.toHex(60000),
                                                    "to": bhpContractAddress,
                                                    "value": "0x0",
                                                    "data": bhpContract.methods.transfer(to, amount).encodeABI()
                                                };

                                                var privKey = '<?php echo $coinPrivatekey; ?>';

                                                web3.eth.accounts.signTransaction(rawTransaction, privKey, function(err,signed){
                                                    if(err){
                                                        return ;
                                                    }
                                                    web3.eth.sendSignedTransaction(signed.rawTransaction, function(err, result){
                                                        if(!err){
                                                            //传送数据
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '<?php echo url("toShopHash"); ?>',
                                                                data: {
                                                                    "from": from,
                                                                    'swx': $('#swx').val(),
                                                                    'txhash': result,
                                                                    'address': to,
                                                                    'coin_type': '<?php echo $coiName; ?>',
                                                                },
                                                                dataType: 'json',
                                                                success: function(data){
                                                                    layer.open({
                                                                        content: data.msg
                                                                        ,skin: 'msg'
                                                                        ,time: 2 //2秒后自动关闭
                                                                    });
                                                                    if (data.status == 200) { //成功，定时刷新
                                                                        setTimeout(function(){location.reload()},1500);
                                                                    }
                                                                }
                                                            });
                                                        }else{
                                                            console.log(err);
                                                        }
                                                    })
                                                })

                                            })

                                        }else{
                                            console.log(err)
                                        }

                                    })
                                }else{
                                    console.log(error);
                                }

                            });
                        }

                    }
                }
            });

        })
    });
</script>
</body>
</html>