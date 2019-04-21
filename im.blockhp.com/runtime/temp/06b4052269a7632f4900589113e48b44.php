<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"./template/mobile/new/user/ajax_account_list.html";i:1554047574;}*/ ?>
  <?php if(is_array($account_log) || $account_log instanceof \think\Collection): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $k=>$item): ?>
    <li class="Funds_li" <?php if($k == count($account_log)): ?> style="border:0"<?php endif; ?>>
    	<span class="icon <?php if($k == 0): ?>on<?php endif; ?>"></span>
        <span><?php if($item['user_money'] > 0): ?>增加{else /}减少<?php endif; ?><em><?php echo $item['user_money']; ?></em></span>
        <span><?php echo date('Y-m-d H:i:s',$item['change_time']); ?></span>
        <span><?php echo $item['desc']; ?></span>
    </li>
  <?php endforeach; endif; else: echo "" ;endif; ?>