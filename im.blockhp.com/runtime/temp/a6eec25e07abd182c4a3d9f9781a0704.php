<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"./template/mobile/new/activity\ajaxgrouplistgetmore.html";i:1491382656;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
 <li> 
	 <a class="url" href="<?php echo U('Activity/group',array('id'=>$v[goods_id])); ?>"> 
	 <img src="<?php echo goods_thum_images($v['goods_id'],200,200); ?>">   </a>
	 <a href="<?php echo U('Activity/group',array('id'=>$v[goods_id])); ?>"  class="info_wrap">
		 <div class="fn good"><?php echo $v['title']; ?></div>
		 <div class="price_wrap"> 
		 	<i class="discount"  style="display:;"><?php echo $v[rebate]; ?>折</i> <span class="price" style="display:;">￥<?php echo $v[price]; ?>元</span> <del class="old_price"  style="display:;">￥<?php echo $v[goods_price]; ?>元</del> 
		 </div> 
		 <div class="bottom_info">
		 	<span class="remain_num" style="display:;">已售<?php echo $v[buy_num] + $v[virtual_num]; ?>件</span>
		    <span class="sg_g_time last_g_time" id="jstimerBox<?php echo $v[goods_id]; ?>"></span>
		 </div> 
	 </a>
</li>
 
<script>
Tday['<?php echo $v[goods_id]; ?>'] = new Date('<?php echo date("Y/m/d H:i:s",$v['end_time']); ?>');  
window.setInterval(function()    
{clock11('<?php echo $v[goods_id]; ?>');}, 1000);  
</script> 
<?php endforeach; endif; else: echo "" ;endif; ?>