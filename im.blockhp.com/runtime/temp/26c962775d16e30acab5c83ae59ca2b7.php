<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"./template/mobile/new/user\ajax_order_list.html";i:1491382656;}*/ ?>
<?php if(is_array($lists) || $lists instanceof \think\Collection): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
       <div class="order_list">
          <h2>
                <img src="__STATIC__/images/dianpu.png" /><span>店铺名称:<?php echo $storeList[$list['store_id']]['store_name']; ?></span>                  
              <a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $storeList[$list['store_id']]['store_qq']; ?>&version=1&src_type=web&web_src=oicqzone.com">
                <img src="__PUBLIC__/images/qq.gif" />
              </a>  
          
              <a href="javascript:void(0);">                
                  <img src="__STATIC__/images/icojiantou1.png"></strong>
              </a>
          </h2>
         	<a href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id'])); ?>">
	          <?php if(is_array($list['goods_list']) || $list['goods_list'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['goods_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
		          <dl>  
		          <dt><img src="<?php echo goods_thum_images($good['goods_id'],200,200); ?>"></dt>
		          <dd class="name"><strong><?php echo $good['goods_name']; ?></strong>
		          <span><?php echo $good['spec_key_name']; ?> </span></dd>
		          <dd class="pice">￥<?php echo $good['member_goods_price']; ?>元<em>x<?php echo $good['goods_num']; ?></em></dd>
		          </dl>
	          <?php endforeach; endif; else: echo "" ;endif; ?>
          	</a>
          <div class="pic">共<?php echo count($list['goods_list']); ?>件商品<span>应付：</span><strong>￥<?php echo $list['order_amount']; ?>元</strong></div>
          <div class="anniu" style="width:95%">
                <?php if($list['cancel_btn'] == 1): ?><span onClick="cancel_order(<?php echo $list['order_id']; ?>)">取消订单</span><?php endif; if($list['pay_btn'] == 1): ?><a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$list['order_id'])); ?>">立即付款</a><?php endif; if($list['receive_btn'] == 1): ?><a href="<?php echo U('Mobile/User/order_confirm',array('id'=>$list['order_id'])); ?>">收货确认</a><?php endif; ?>    
                <!--<?php if($list['comment_btn'] == 1): ?><a href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id'])); ?>">评价</a><?php endif; ?>-->
                <?php if($list['comment_btn'] == 1): ?><a href="<?php echo U('Mobile/User/comment_list',array('order_id'=>$list['order_id'],'store_id'=>$list['store_id'],'goods_id'=>$vo['goods_id'])); ?>">评价</a><?php endif; if($list['shipping_btn'] == 1): ?><a href="http://www.kuaidi100.com/" target="_blank">查看物流</a><?php endif; if($list['return_btn'] == 1): ?><a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $storeList[$list['store_id']]['store_qq']; ?>&version=1&src_type=web&web_src=oicqzone.com" target="_blank">联系客服</a><?php endif; ?>                        
          </div>
       </div>
<?php endforeach; endif; else: echo "" ;endif; ?>  