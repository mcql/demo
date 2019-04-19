<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"./template/mobile/new/cart\cart4.html";i:1554046744;s:40:"./template/mobile/new/public\footer.html";i:1491382656;s:44:"./template/mobile/new/public\footer_nav.html";i:1491382656;s:42:"./template/mobile/new/public\wx_share.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="tpshop" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>购物流程-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" href="__STATIC__/css/public.css">
<link rel="stylesheet" href="__STATIC__/css/flow.css">
<link rel="stylesheet" href="__STATIC__/css/style_jm.css">
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
</head>
<body style="background: rgb(235, 236, 237);position:relative;">
<div class="tab_nav">
    <div class="header">
      <div class="h-left">
        <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
      </div>
      <div class="h-mid"> 提交订单      </div>
    </div>
</div>

<div class="screen-wrap fullscreen login">
<form action="<?php echo U('Mobile/Payment/getCode'); ?>" method="post" name="cart4_form" id="cart4_form">
<div class="content_success " >
    <div class="con-ct   fo-con">
        <h4 class="successtijiao">订单已经提交成功！</h4>
      <ul class="ct-list">
        <li>请您在<span><?php echo $pay_date; ?></span>前完成支付，否则订单将自动取消！：</li>
        <li >订单号：
            <em>
                    <?php if($master_order_sn != ''): ?>                        
                        &nbsp;&nbsp;<?php echo $master_order_sn; else: ?>
                        &nbsp;&nbsp;<?php echo $order['order_sn']; endif; ?>
            </em>
        </li>
        <li>支付金额：
            <em>
                <?php if($master_order_sn != ''): ?>
                    <?php echo $sum_order_amount; ?> BHP
                <?php else: ?>
                    <?php echo $order['order_amount']; ?> BHP
                <?php endif; ?>
            </em>
        </li>
          <li>账户余额：
              <em>
                  <?php echo $userLst; ?> BHP
              </em>
          </li>
      </ul>
    </div>
    
   <section class="order-info">
          <div class="order-list">
            <div class="content ptop0">
              <div class="panel panel-default info-box">
                <!--<div class="panel-body" id="pay_div"  >
                  <div class="title" id="zhifutitle" style="border-bottom:1px solid #eeeeee;"> <span class="i-icon-arrow-down i-icon-arrow-up" id="zhifuip"></span> <span class="text">支付方式</span> <a href="javascript:void(0)" title="修改商品列表" class="link">必选</a> <em class="qxz" id="emzhifu">请选择支付方式</em> </div>
                  <ul class="nav nav-list-sidenav" id="zhifu68" style="display:block; border-bottom:none;">
                  <?php if(is_array($paymentList) || $paymentList instanceof \think\Collection): if( count($paymentList)==0 ) : echo "" ;else: foreach($paymentList as $k=>$v): ?> 
                    <li class="clearfix" name="payment_name">
                      <label>
                          <input type="radio"   value="pay_code=<?php echo $v['code']; ?>" class="c_checkbox_t" name="pay_radio" />
                          <div class="fl shipping_title">
	                          <img src="/plugins/<?php echo $v['type']; ?>/<?php echo $v['code']; ?>/<?php echo $v['icon']; ?>" onClick="change_pay(this);" width="110" height="40" />
                          </div>
                      </label>
                    </li>
                   <?php endforeach; endif; else: echo "" ;endif; ?> 
                  </ul>
                </div>-->
              </div>
            </div>
          </div>
        </section>
  <div class="pay-btn">
	<input type="hidden" id="master_order_sn" name="master_order_sn" value="<?php echo $master_order_sn; ?>" />
	<input type="hidden" id="order_id" name="order_id" value="<?php echo $order['order_id']; ?>" />
    <a href="javascript:void(0);" onClick="pay()" class="sub-btn btnRadius">确认支付</a>
  </div>
</div>
</form>
<script>
    $(document).ready(function(){
        $("input[name='pay_radio']").first().trigger('click');
    });
    // 切换支付方式
    function change_pay(obj)
    {
        $(obj).parent().siblings('input[name="pay_radio"]').trigger('click');
    }

    function pay(){
        $.ajax({
            type : "POST",
            url:'/index.php/Mobile/Cart/cart5',
            data : {
                'order_id': $('#order_id').val()
            },
            dataType: "json",
            success: function(data){
                alert(data.msg);
                if(data.status == 1)
                {
                    window.location.href="<?php echo U('Mobile/user/order_list'); ?>";
                }
            }
        });
    }
</script> 
<!--
<div class="footer" >
	      <div class="links"  id="TP_MEMBERZONE"> 
	      		<?php if($user_id > 0): ?>
	      		<a href="<?php echo U('User/index'); ?>"><span><?php echo $user['nickname']; ?></span></a><a href="<?php echo U('User/logout'); ?>"><span>退出</span></a>
	      		<?php else: ?>
	      		<a href="<?php echo U('User/login'); ?>"><span>登录</span></a><a href="<?php echo U('User/reg'); ?>"><span>注册</span></a>
	      		<?php endif; ?>
	      		<a href="#"><span>反馈</span></a><a href="javascript:window.scrollTo(0,0);"><span>回顶部</span></a>
		  </div>
	      <ul class="linkss" >
		      <li>
		        <a href="#">
		        <i class="footerimg_1"></i>
		        <span>客户端</span></a></li>
		      <li>
		      <a href="javascript:;"><i class="footerimg_2"></i><span class="gl">触屏版</span></a></li>
		      <li><a href="<?php echo U('Home/Index/index'); ?>" class="goDesktop"><i class="footerimg_3"></i><span>电脑版</span></a></li>
	      </ul>
	  	 <p class="mf_o4">备案号:<?php echo $tpshop_config['shop_info_record_no']; ?><br/>&copy; 2005-2016 TPshop多商户V1.2 版权所有，并保留所有权利。</p>
</div>
-->
</div>
<div style="height:50px; line-height:50px; clear:both;"></div>
<div class="v_nav">
	<div class="vf_nav">
		<ul>
			<li> <a href="<?php echo U('Index/index'); ?>">
			    <i class="vf_1"></i>
			    <span>首页</span></a></li>
			<li><a href="tel:<?php echo $tpshop_config['shop_info_phone']; ?>">
			    <i class="vf_2"></i>
			    <span>客服</span></a></li>
			<li><a href="<?php echo U('Goods/categoryList'); ?>">
			    <i class="vf_3"></i>
			    <span>分类</span></a></li>
			<li>
			<a href="<?php echo U('Cart/cart'); ?>">
			   <em class="global-nav__nav-shop-cart-num" id="cart_quantity" style="right:9px;"></em>
			   <i class="vf_4"></i>
			   <span>购物车</span>
			   </a>
			</li>
			<li><a href="<?php echo U('User/index'); ?>">
			    <i class="vf_5"></i>
			    <span>我的</span></a>
			</li>
		</ul>
	</div>
</div> 
<script type="text/javascript">
$(document).ready(function(){
	  var cart_cn = getCookie('cn');
	  if(cart_cn == ''){
		$.ajax({
			type : "GET",
			url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
			success: function(data){								 
				cart_cn = getCookie('cn');
				$('#cart_quantity').html(cart_cn);						
			}
		});	
	  }
	  $('#cart_quantity').html(cart_cn);
});
</script>
<!-- 微信浏览器 调用微信 分享js-->
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">

<?php if(ACTION_NAME == 'goodsInfo'): ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo $goods[goods_id]; ?>"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>"; // 分享图标
<?php else: ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $tpshop_config['shop_info_store_logo']; ?>"; //分享图标
<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);
// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}	

$(function() {
	if(isWeiXin() && parseInt(user_id)>0 ||1){
		$.ajax({
			type : "POST",
			url:"/index.php?m=Mobile&c=Index&a=ajaxGetWxConfig&t="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{
				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){
		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareTimeline({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});

		   <?php if(CONTROLLER_NAME == 'User'): ?> 
				wx.hideOptionMenu();  // 用户中心 隐藏微信菜单
		   <?php endif; ?>	
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
<!--微信关注提醒 start-->
<?php if(\think\Session::get('subscribe') == 0 AND $wechat_config['qr'] != ''): ?>
<button class="guide" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:20px;height:100px;text-align: center;border-radius: 8px ;font-size:12px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 6px;bottom: 200px;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:5px;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 10px;}
</style>
<script type="text/javascript">
  // 关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo $wechat_config['qr']; ?>" width="200">',
		style: ''
	});
}
</script> 
<?php endif; ?>
<!--微信关注提醒  end-->
<!-- 微信浏览器 调用微信 分享js  end-->
</body>
</html>