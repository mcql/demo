<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:94:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\wallet\coinshow.html";i:1555471926;s:92:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\common\header.html";i:1555468160;s:92:"C:\Users\Administrator\Desktop\demo\im.blockhp.com/application/phone\view\common\footer.html";i:1554651692;}*/ ?>
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
    .pagination {
        text-align: center;
        margin: 0 auto;
        position: relative;
    }
    .pagination li {
        display: inline-block;
        font-size: 1rem;
        margin: 0 2px;
        padding: 0 .4rem;
        line-height: 1.5rem;
        height: 1.5rem;
        border: 1px solid #1d96e3;
    }
    .deals-index .deals-head .head-text .assets-numb {
        padding-left: 0;
    }
    .deals-index .deals-head .weui-btn {
        font-size: .85rem;
        width: 5.5rem;
    }
    .deals-index .deals-head {
        padding: 2rem 0;
        background-color: #fff;
    }
    .assets-text {
        line-height: 4rem;
        font-size: 1.3rem;
    }
    .assets-numb {
        line-height: 2rem;
        font-size: 2rem;
    }
    #myChart {
        background-color: #f15473;
        box-shadow: 0 0 3px rgba(0,0,0,.4);
        width: 95%;
        margin: 1rem auto;
        padding: 1rem;
        border-radius: .3rem;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        color: #fff;
    }
    .deals-index {
        padding-bottom: 1rem;
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
    .nodata {
        padding-top: 5rem;
    }
    #app>.app-body {
        height: auto;
        margin-bottom: 0;
        background-color: #fff;
    }
    .deals-index .item-item {
        overflow: visible;
    }
    .deals-index .price .item-price {
        color: #4c4c51;
    }
    .deals-index a.item-btn {
        background-color: #fc8c92;
        border-radius: 5px;
    }
    .weui-btn_primary {
        background-color: #fc8c92;
    }
    #app>.vux-header, body .vux-header{
        background-color: #fff;
    }
    body .vux-header .vux-header-title{
        font-size: 1rem;
        color: #22232b;
        font-weight: 700;
    }
    .zzcc {
        width: 100%;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .zzcc li {
        box-shadow: 0 0 .5rem #ff9db0;
        background-color: #fff;
        padding: .5rem 3rem;
        border-radius: .4rem;
    }
    .zzcc li a {
        color: #22232b;
    }
    .deals-index .item-head{
        background-color: #f4f4f4;
    }
    .deals-index .item-head{
        color: #666666;
    }
</style>
<div id="app"><!---->
    <div class="vux-header">
        <div class="vux-header-left">
            <span class="iconfont left-arrow">&#xe61f;</span>
        </div>
        <h1 class="vux-header-title"><?php echo strtoupper($coiName); ?></h1>
        <div class="vux-header-right">
            <a href="<?php echo url('Index/index'); ?>" class="exalt">
                <span class="iconfont backChat">&#xe658;</span>
            </a>
        </div>
    </div>
    <div class="app-body">
        <div id="myChart" _echarts_instance_="ec_1531556588143">
            <div class="head-text flex-1">
                <div class="assets-text">剩余<?php echo strtoupper($coiName); ?>：</div>
                <div class="assets-numb">0</div>
            </div>
        </div>
        <div class="deals-index">
            <div class="deals-head flex-box">
                <ul class="zzcc">
                    <li>
                        <a href="<?php echo url('trade'); ?>?coin=<?php echo $coiName; ?>">转账</a>
                    </li>
                    <li>
                        <a href="<?php echo url('selfPackage'); ?>?coin=<?php echo $coiName; ?>">充值</a>
                    </li>
                </ul>
            </div>
            <div class="deals-content">
                <div class="deals-title"><?php echo strtoupper($coiName); ?>历史转账记录
                </div>
                <div class="deals-block">
                    <div class="item item-head flex-box">
                        <div class="item-item numb">
                            数量
                        </div>
                        <div class="item-item price flex-1">
                            币种
                        </div>
                        <div class="item-item price flex-1">
                            时间
                        </div>
                        <div class="item-item item-btn">类型</div>
                    </div>
                    <?php if(count($list) != 0): if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['coin_type'] == 'eth'): ?>
                    <div class="block-box">
                        <div class="item flex-box">
                            <div class="item-item numb"><?php echo $vo['num']; ?></div>
                            <div class="item-item price flex-1">
                                <div class="item-price"><?php echo $vo['coin_type']; ?>
                                </div>
                            </div>
                            <div class="item-item price flex-1">
                                <div class="item-price"><?php echo date("Y-m-d ",$vo['create_time']) ?>
                                </div>
                            </div>
                            <a href="https://etherscan.io/tx/<?php echo $vo['tx_hash']; ?>" class="item-item item-btn">
                                <?php if($vo['type'] == 0): ?>
                                转入
                                <?php else: ?>
                                转出
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <div>
                        <?php echo $page; ?>
                    </div>
                    <?php else: ?>
                    <div class="nodata">
                        <img src="/public/static/mobile/images/download.png" alt="">
                        <h4>暂无数据</h4>
                    </div>
                    <?php endif; ?>
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

        if('<?php echo $coiName; ?>' == 'eth')
        {
            //查询eth余额
            var ethAddress = "<?php echo $coinAddress; ?>";
            web3.eth.getBalance(ethAddress, function(err, resp){
                if(!err){
                    var eth = web3.utils.fromWei(resp, 'ether');
                    $(".assets-numb").html(eth);
                }else{
                    console.log(err);
                }
            });
        }

        if('<?php echo $coiName; ?>' == 'usdt')
        {
            //查询usdt余额
            getUsdtLst();
            function getUsdtLst()
            {
                // 定义合约
                // 定义合约abi
                var contractAbi = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_upgradedAddress","type":"address"}],"name":"deprecate","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"deprecated","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_evilUser","type":"address"}],"name":"addBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"upgradedAddress","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"balances","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"maximumFee","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_maker","type":"address"}],"name":"getBlackListStatus","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"},{"name":"","type":"address"}],"name":"allowed","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"who","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newBasisPoints","type":"uint256"},{"name":"newMaxFee","type":"uint256"}],"name":"setParams","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"issue","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"redeem","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"basisPointsRate","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"isBlackListed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_clearedUser","type":"address"}],"name":"removeBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_blackListedUser","type":"address"}],"name":"destroyBlackFunds","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_initialSupply","type":"uint256"},{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Issue","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Redeem","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"newAddress","type":"address"}],"name":"Deprecate","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"feeBasisPoints","type":"uint256"},{"indexed":false,"name":"maxFee","type":"uint256"}],"name":"Params","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_blackListedUser","type":"address"},{"indexed":false,"name":"_balance","type":"uint256"}],"name":"DestroyedBlackFunds","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"AddedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"RemovedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[],"name":"Pause","type":"event"},{"anonymous":false,"inputs":[],"name":"Unpause","type":"event"}];
                var usdtContractAddress = '0xdac17f958d2ee523a2206206994597c13d831ec7';
                var usdtAddress = "<?php echo $coinAddress; ?>";
                var myContract = new web3.eth.Contract(contractAbi, usdtContractAddress, {
                    from: usdtAddress, // default from address
                    gasPrice: '10000000000' // default gas price in wei, 10 gwei in this case
                });
                myContract.methods.balanceOf(usdtContractAddress).call({from: usdtAddress}, function(error, result){
                    if(!error) {
                        $(".assets-numb").html(result);
                        //console.log(result);
                    } else {
                        //循环查询
                        getUsdtLst();
                    }
                });
            }

        }

        if('<?php echo $coiName; ?>' == 'bhp')
        {
            //查询bhp余额
            getBhpLst();
            function getBhpLst()
            {
                // 定义合约
                // 定义合约abi
                var contractAbi = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_upgradedAddress","type":"address"}],"name":"deprecate","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"deprecated","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_evilUser","type":"address"}],"name":"addBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"upgradedAddress","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"balances","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"maximumFee","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_maker","type":"address"}],"name":"getBlackListStatus","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"},{"name":"","type":"address"}],"name":"allowed","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"who","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newBasisPoints","type":"uint256"},{"name":"newMaxFee","type":"uint256"}],"name":"setParams","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"issue","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"redeem","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"basisPointsRate","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"isBlackListed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_clearedUser","type":"address"}],"name":"removeBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_blackListedUser","type":"address"}],"name":"destroyBlackFunds","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_initialSupply","type":"uint256"},{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Issue","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Redeem","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"newAddress","type":"address"}],"name":"Deprecate","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"feeBasisPoints","type":"uint256"},{"indexed":false,"name":"maxFee","type":"uint256"}],"name":"Params","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_blackListedUser","type":"address"},{"indexed":false,"name":"_balance","type":"uint256"}],"name":"DestroyedBlackFunds","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"AddedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"RemovedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[],"name":"Pause","type":"event"},{"anonymous":false,"inputs":[],"name":"Unpause","type":"event"}];
                var bhpContractAddress = '0xdac17f958d2ee523a2206206994597c13d831ec7';
                var bhpAddress = "<?php echo $coinAddress; ?>";
                var myContract = new web3.eth.Contract(contractAbi, bhpContractAddress, {
                    from: bhpAddress, // default from address
                    gasPrice: '10000000000' // default gas price in wei, 10 gwei in this case
                });
                myContract.methods.balanceOf(bhpContractAddress).call({from: bhpAddress}, function(error, result){
                    if(!error) {
                        $(".assets-numb").html(result);
                        //console.log(result);
                    } else {
                        //循环查询
                        getBhpLst();
                    }
                });
            }
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
