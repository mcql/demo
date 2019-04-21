<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./template/pc/rainbow/public/dispatch_jump.html";i:1491382656;s:40:"./template/pc/rainbow/public/header.html";i:1554001614;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>系统提示-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css"/>
    <script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
</head>
<style>
.box-ts{width:500px; padding:60px 0; background-color:rgba(105, 95, 95, 0.06); text-align:center; margin:0 auto; overflow:hidden; margin-top:100px; margin-bottom:100px; font-family:simsun,tahoma,arial,sans-serif; color:#555555}
.box-ts i{ display:inline-block; vertical-align:middle;}
.box-ts ul{display:inline-block; text-align:left; vertical-align:middle}
.box-ts ul li{line-height:2.4}
.box-ts ul li h3{font-size:18px; font-weight:bold}
.box-ts:after{content:''; clear:both}
</style>
<body class="detailfont">
<!--header-s-->
<style>
	.nav-middan-z {
		margin-bottom: 30px;
	}
	.header .ecsc-logo {
		float: right;
	}
</style>
<div class="tpshop-tm-hander p">
    <div class="top-hander p">
        <div class="w1224 pr">
            <link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
			<div class="fl">
			    <div class="ls-dlzc fl nologin">
			        <a href="<?php echo U('Home/user/login'); ?>">Hi,请登录</a>
			        <a class="red" href="<?php echo U('Home/user/reg'); ?>">免费注册</a>
			    </div>
			    <div class="ls-dlzc fl islogin">
			        <a class="red userinfo" href="<?php echo U('Home/user/index'); ?>"></a>
			        <a href="<?php echo U('Home/user/logout'); ?>">退出</a>
			    </div>
			    <div class="fl spc" style="margin-top:10px"></div>
			    <!--<div class="sendaddress pr fl">
			    <?php if(strtolower(ACTION_NAME) != 'goodsinfo'): ?>
			        &lt;!&ndash; 收货地址，物流运费 -start&ndash;&gt;
			        <ul class="list1" >
			            <li class="jaj"><span>配&nbsp;&nbsp;送：</span></li>
			            <li class="summary-stock though-line" style="margin-top:-1px">
			                <div class="dd" style="border-right:0px;">
			                    <div class="store-selector add_cj_p">
			                        <div class="text" style="margin-top:3px;border-left: 0 !important;"><div></div><b></b></div>
			                        <div onclick="$(this).parent().removeClass('hover')" class="close"></div>
			                    </div>
			                </div>
			            </li>
			        </ul>
			        &lt;!&ndash;<i class="jt-x"></i>&ndash;&gt;
			        &lt;!&ndash; 收货地址，物流运费 -end&ndash;&gt;
			        <?php endif; ?>
			    </div>-->
			</div>
			<!--<div class="top-ri-header fr">
			    <ul>
			        <li><a target="_blank" href="<?php echo U('/Home/Order/order_list'); ?>">我的订单</a></li>
			        <li class="spacer"></li>
			        <li><a target="_blank" href="<?php echo U('/Home/User/account'); ?>">我的积分</a></li>
			        <li class="spacer"></li>
			        <li><a target="_blank" href="<?php echo U('/Home/User/coupon'); ?>">我的优惠券</a></li>
			        <li class="spacer"></li>
			        <li><a target="_blank" href="<?php echo U('/Home/User/goods_collect'); ?>">我的收藏</a></li>
			        <li class="spacer"></li>
			        <li class="hover-ba-navdh">
			            <div class="nav-dh">
			                <span>网站导航</span>
			                <i class="jt-x"></i>
			                <div class="conta-hv-nav">
			                    <ul>
			                        <li>
			                            <a href="<?php echo U('/Home/Activity/group_list'); ?>">团购</a>
			                        </li>
			                        <li>
			                            <a href="<?php echo U('Home/Activity/flash_sale_list'); ?>">抢购</a>
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </li>
			        <li class="spacer"></li>
			        <li class="navoxth">
			            <div class="nav-dh">
			                <i class="fl ico"></i>
			                <span>手机TPshop网</span>
			                <i class="jt-x"></i>
			            </div>
			            <div class="sub-panel m-lst">
			              <p>扫一扫，下载TPshop客户端</p>
			              <dl>
			                <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>
			                <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
			                <dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>
			              </dl>
			            </div>
			        </li>
			        <li class="spacer"></li>
			        <li class="wxbox-hover">
			            <a target="_blank" href="">关注我们：</a>
			            <img class="wechat-top" src="__STATIC__/images/wechat.png" alt="">
			            <div class="sub-panel wx-box">
			              <span class="arrow-b">◆</span>
			              <span class="arrow-a">◆</span>
			              <p class="n"> 扫描二维码 <br>  关注TPshop网官方微信 </p>
			              <img src="__STATIC__/images/qrcode_vmall_app01.png">
			            </div>
			        </li>
			    </ul>
			</div>-->
        </div>
    </div>
    <div class="nav-middan-z p">
        <div class="header w1224">
            <div class="ecsc-logo">
			    <a href="/" class="logo"> <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>"></a>
			</div>
			<!--<div class="ecsc-join">
			    <?php $pid =2;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1555768800 and end_time > 1555768800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
			        <a href="<?php echo $v['ad_link']; ?>" target="_blank"> &lt;!&ndash;<img src="<?php echo $v[ad_code]; ?>" style="width: 113px;height: 57px;">&ndash;&gt;</a>
			    <?php endforeach; ?>
			</div>-->
			<!--<div class="ecsc-search">
			    <form id="sourch_form" name="sourch_form" method="post" action="<?php echo U('Home/Goods/search'); ?>" class="ecsc-search-form">
			        <div class="ecsc-search-tabs">
			            <i class="sc-icon-right"></i>
			            <ul class="shop_search" id="shop_search">
			                <li rev="0"><span id="sp">商品</span></li>
			                <li rev="1" class="curr"><span id="dp">店铺</span></li>
			            </ul>
			        </div>
			        <input autocomplete="off" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>" placeholder="搜索关键字" class="ecsc-search-input">
			        <button type="submit" class="ecsc-search-button" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();"><i></i></button>
			    </form>
			    <div class="keyword">
			        <ul>
			            <?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
			                <li>
			                    <a href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>" target="_blank"><?php echo $wd; ?></a>
			                </li>
			            <?php endforeach; endif; else: echo "" ;endif; ?>
			        </ul>
			    </div>
			</div>-->
			<!--<div class="shopingcar-index fr">
			    <div class="u-g-cart fr fixed" id="hd-my-cart">
			        <a href="<?php echo U('Home/Cart/cart'); ?>">
			            <p class="c-n fl">我的购物车</p>
			            <p class="c-num fl">(<span class="count cart_quantity" id="cart_quantity"></span>)
			                <i class="i-c oh"></i>
			            </p>
			        </a>
			        <div class="u-fn-cart u-mn-cart" id="show_minicart">
			            <div class="minicartContent" id="minicart">
			            </div>
			        </div>
			    </div>
			</div>-->
        </div>
    </div>
    <!--<div class="nav p">
        <div class="w1224 p">
            <div class="categorys home_categorys">
			    <div class="dt">
			        <a href="<?php echo U('Home/Goods/goodsList'); ?>">全部商品分类</a>
			    </div>
			    &lt;!&ndash;全部商品分类-s&ndash;&gt;
			    <div class="dd">
			        <div class="cata-nav">
			            <?php if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection): if( count($goods_category_tree)==0 ) : echo "" ;else: foreach($goods_category_tree as $k=>$vo): ?>
			                <div class="item fore1">
			                    <div class="item-left">
			                        <div class="cata-nav-name">
			                            <h3><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$vo[id])); ?>" title="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></a></h3>
			                        </div>
			                        <b>&gt;</b>
			                    </div>
			                    <div class="cata-nav-layer">
			                        <div class="cata-nav-left">
			                            <div class="item-channels">
			                                <div class="channels">
			                                    <a href="" target="_blank">品牌日<i>&gt;</i></a>
			                                    <a href="" target="_blank">家电城<i>&gt;</i></a>
			                                    <a href="" target="_blank">智能生活馆<i>&gt;</i></a>
			                                    <a href="" target="_blank">京东净化馆<i>&gt;</i></a>
			                                    <a href="" target="_blank">京东帮服务店<i>&gt;</i></a>
			                                    <a href="" target="_blank">值得买精选<i>&gt;</i></a>
			                                </div>
			                            </div>
			                            <div class="subitems">
			                                <dl>
			                                    <?php if(is_array($vo['tmenu']) || $vo['tmenu'] instanceof \think\Collection): if( count($vo['tmenu'])==0 ) : echo "" ;else: foreach($vo['tmenu'] as $k2=>$v2): ?>
			                                        <dt><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id])); ?>" target="_blank"><?php echo $v2['name']; ?><i>&gt;</i></a></dt>
			                                        <dd>
			                                            <?php if(is_array($v2['sub_menu']) || $v2['sub_menu'] instanceof \think\Collection): if( count($v2['sub_menu'])==0 ) : echo "" ;else: foreach($v2['sub_menu'] as $key=>$v3): ?>
			                                                <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id])); ?>" target="_blank"><?php echo $v3['name']; ?></a>
			                                            <?php endforeach; endif; else: echo "" ;endif; ?>
			                                        </dd>
			                                    <?php endforeach; endif; else: echo "" ;endif; ?>
			                                </dl>
			                                <div class="item-brands">
			                                    <ul>
			                                    </ul>
			                                </div>
			                                <div class="item-promotions">
			                                </div>
			                            </div>
			                        </div>
			                        <div class="cata-nav-rigth">
			                            <div class="item-brands">
			                                <ul>
			                                    <?php if(is_array($brand_list) || $brand_list instanceof \think\Collection): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;if(($v2[cat_id1] == $vo[id]) AND ($v2[is_hot] == 1)): ?>
			                                            <li>
			                                                <a href="<?php echo U('Home/Goods/goodsList',array('brand_id'=>$v2[id])); ?>" target="_blank" title="<?php echo $v2['name']; ?>"> 
			                                                <img src="<?php echo $v2['logo']; ?>" width="91" height="40"></a>
			                                            </li>
			                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
			                                </ul>
			                            </div>
			                            <div class="item-promotions">
			                                <?php
                                   
                                $md5_key = md5("select * from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < UNIX_TIMESTAMP(NOW()) and end_time > UNIX_TIMESTAMP(NOW()) and status = 1 and cat_id1 = $vo[id] limit 2");
                                $result_name = $sql_result_promote = S("sql_".$md5_key);
                                if(empty($sql_result_promote))
                                {                            
                                    $result_name = $sql_result_promote = \think\Db::query("select * from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < UNIX_TIMESTAMP(NOW()) and end_time > UNIX_TIMESTAMP(NOW()) and status = 1 and cat_id1 = $vo[id] limit 2"); 
                                    S("sql_".$md5_key,$sql_result_promote,31104000);
                                }    
                              foreach($sql_result_promote as $promote_key=>$promote): ?>
			                                    <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$promote[goods_id])); ?>" target="_blank">
			                                        <img width="181" height="120" src="<?php echo goods_thum_images($promote['goods_id'],181,120); ?>">
			                                    </a>
			                                <?php endforeach; ?>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            <?php endforeach; endif; else: echo "" ;endif; ?>
			        </div>
			    </div>
			&lt;!&ndash;全部商品分类-e&ndash;&gt;
			</div>
			<div class="navitems" id="nav">
			    <ul>
			    	<li><a  href="/">首页</a></li>
			        <?php
                                   
                                $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
			            <li><a href="<?php echo $v[url]; ?>" <?php  if($_SERVER['REQUEST_URI']==str_replace('&amp;','&',$v[url])){ echo "class='selected'";} ?> ><?php echo $v[name]; ?></a></li>
			        <?php endforeach; ?>
			    </ul>
			    <div class="wrap-line" style="width: 72px; left: 20px;">
			        <span style="left:15px;"></span>
			    </div>
			</div>
        </div>
    </div>-->
</div>
<!--------收货地址，物流运费-开始-------------->
<script src="__STATIC__/js/location.js"></script>
<!--------收货地址，物流运费--结束-------------->
<!--中间内容-->
<div id="warpper" class="clearfix">
    <?php if($code == 1) {?>
    <!-- 处理成功 -->
    <div class="box-ts">
        <i><img src="__STATIC__/images/success_ts.png"></i>
        <ul>
            <li>
                <h3><?php echo(strip_tags($msg)); ?><h3>
            </li>
            <li><a href="javascript:void(0);">页面自动 <a id="href" href="<?php echo($url); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b></a></li>
            <li>
                <a href="/">首页</a> <a href="/index.php?m=Home&c=Cart&a=cart">购物车</a>
                <a href="/index.php?m=Home&c=User&a=index">用户中心</a>
            </li>
        </ul>
    </div>
    <?php }else{?>
    <!-- 处理失败 -->
    <div class="box-ts">
        <i><img src="__STATIC__/images/error_ts.png"></i>
        <ul>
            <li><h3><?php echo(strip_tags($msg)); ?></h3></li>
            <li><a href="javascript:void(0);">页面自动 <a id="href" href="<?php echo($url); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b></a></li>
            <li>
                <a href="/">首页</a> <a href="/index.php?m=Home&c=Cart&a=cart">购物车</a>
                <a href="/index.php?m=Home&c=User&a=index">用户中心</a>
            </li>
        </ul>
    </div>
    <?php }?>
</div>
<!--中间内容 end-->
<script type="text/javascript">
    (function () {
        var wait = document.getElementById('wait'), href = document.getElementById('href').href;
        var interval = setInterval(function () {
            var time = --wait.innerHTML;
            if (time <= 0) {
                window.location.href = href;
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();
    
    /*******用户登录变化class****/
    function user_login_or_no()
    {
    	var uname = getCookie('uname');
    	if (uname == '') {
    		$('.islogin').remove();
    		$('.nologin').show();
    	} else {
    		$('.nologin').remove();
    		$('.islogin').show();
    		$('.userinfo').html(decodeURIComponent(uname));
    	}
    }
	
    $(document).ready(function(){
    	user_login_or_no();
    })
    
</script>
</body>
</html>