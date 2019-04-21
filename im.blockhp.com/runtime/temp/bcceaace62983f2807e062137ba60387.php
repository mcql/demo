<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"./template/mobile/new/user/account.html";i:1555671705;s:40:"./template/mobile/new/public/header.html";i:1555520524;s:38:"./template/mobile/new/public/menu.html";i:1555520524;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPSHOP v1.1" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="applicable-device" content="mobile">
<title><?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<meta name="Keywords" content="TPshop触屏版  TPshop 手机版" />
<meta name="Description" content="TPshop触屏版   TPshop商城 "/>
<link rel="stylesheet" href="__STATIC__/css/public.css">
<link rel="stylesheet" href="__STATIC__/css/user.css">
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script src="__PUBLIC__/js/mobile_common.js"></script>
<script type="text/javascript" src="__STATIC__/js/modernizr.js"></script>
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
</head>

<style>
    .user_login_title h2 span {
        font-size: 27px;
    }
    .font12{
      font-size: 14px;
    }
</style>
<body>
<header>
<div class="tab_nav">
  <div class="header">
    <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
    <div class="h-mid">资金管理</div>
    <div class="h-right">
      <aside class="top_bar">
        <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a> </div>
      </aside>
    </div>
  </div>
</div>
</header>
<script type="text/javascript" src="__STATIC__/js/mobile.js" ></script>
<div class="goods_nav hid" id="menu">
      <div class="Triangle">
        <h2></h2>
      </div>
      <ul>
        <li><a href="<?php echo U('Index/index'); ?>"><span class="menu1"></span><i>首页</i></a></li>
        <li><a href="<?php echo U('Goods/categoryList'); ?>"><span class="menu2"></span><i>分类</i></a></li>
        <li><a href="<?php echo U('Cart/cart'); ?>"><span class="menu3"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="<?php echo U('User/index'); ?>"><span class="menu4"></span><i>我的</i></a></li>
   </ul>
 </div> 
<div id="tbh5v0">			
<div style="background:#fff;">
<div class="user_login_title"><h2><em>账户余额 </em><span><?php echo $user['user_money']; ?> BHP</span></h2></div>
<?php if(empty($account_log) || ($account_log instanceof \think\Collection && $account_log->isEmpty())): ?>
<p class="font12">您没有任何资金的变动哦！</p>
<?php else: ?>
<div class="Funds">
  <ul>
  <?php if(is_array($account_log) || $account_log instanceof \think\Collection): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $k=>$item): ?>
    <li class="Funds_li" <?php if($k == count($account_log)): ?> style="border:0"<?php endif; ?>>
    	<span class="icon <?php if($k == 0): ?>on<?php endif; ?>"></span>
      <span><?php if($item['user_money'] > 0): ?>增加{else /}减少<?php endif; ?><em><?php echo $item['user_money']; ?></em></span>
        <span><?php echo date('Y-m-d H:i:s',$item['change_time']); ?></span>
        <span><?php echo $item['desc']; ?></span>
    </li>
  <?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
</div>
<?php if(!(empty($account_log) || ($account_log instanceof \think\Collection && $account_log->isEmpty()))): ?>
   <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div>
<?php endif; endif; ?>
</div>
<a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a> 
</div>
<script>
var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	 	 
        page += 1;
		$.ajax({
			type : "GET",
			url:"<?php echo U('Mobile/User/account',null,''); ?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('#getmore').hide();
				else
				    $(".Funds > ul").append(data);
			}
		}); 
 } 
</script>

<script type="text/javascript">
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}
</script>
</body>
</html>