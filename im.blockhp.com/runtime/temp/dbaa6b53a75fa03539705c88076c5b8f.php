<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:44:"./template/mobile/new/user\edit_address.html";i:1491382656;s:38:"./template/mobile/new/public\menu.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>修改地址-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" href="__STATIC__/css/public.css">
<link rel="stylesheet" href="__STATIC__/css/user.css">

<script src="__PUBLIC__/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
<script src="__PUBLIC__/js/common.js"></script>
</head>
<body>
      <header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">地址管理</div>
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
						
<div class="addressmone">
  <form action="<?php echo U('Mobile/User/edit_address'); ?>" method="post" onSubmit="return checkForm()">
	<ul>
       <li>
    	<span>收货人姓名</span>  
        <input name="consignee" id="consignee" type="text" value="<?php echo $address['consignee']; ?>" maxlength="12" placeholder="收货人姓名"/>
		</li>          
       <li>
          <input name='country' value='1' type="hidden">
	             <select class="province_select"  name="province" id="province" onChange="get_city(this,0)">
                      <option value="0">请选择</option>
                        <?php if(is_array($province) || $province instanceof \think\Collection): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                            <option <?php if($address['province'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                 </select>
                <select name="city" id="city" onChange="get_area(this)">
                    <option  value="0">请选择</option>
                    <?php if(is_array($city) || $city instanceof \think\Collection): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                        <option <?php if($address['city'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select name="district" id="district" onChange="get_twon(this)">
                    <option  value="0">请选择</option>
                    <?php if(is_array($district) || $district instanceof \think\Collection): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                        <option <?php if($address['district'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>                 
                <select class="di-bl fl seauii" name="twon" id="twon" <?php if($address['twon'] > 0): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
                    <?php if(is_array($twon) || $twon instanceof \think\Collection): $i = 0; $__LIST__ = $twon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                        <option <?php if($address['twon'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>          
        	</li>
           <li>
    		 <span>详细地址</span> <input type="text"  name="address" id="address" placeholder="详细地址" maxlength="100" value="<?php echo $address['address']; ?>"/>
	       </li>
           <li>
			<span>手机</span> 
            <input type="text" name="mobile" value="<?php echo $address['mobile']; ?>" onpaste="this.value=this.value.replace(/[^\d-]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d-]/g,'')" maxlength="15" placeholder="手机号码"/>
	        </li>
            <li>
	    		<span>邮政编码</span> 
                <input type="text" name="zipcode" value="<?php echo $address['zipcode']; ?>" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" maxlength="10"  placeholder="邮政编码"/>
	        </li>
    	</ul>
            <div style=" height:50px"></div>
				<div class="dotm_btn">
                
                <?php if($_GET['source'] == 'cart2'): ?> <!--如果是下订单时提交过了的页面-->
                     <input type="submit" value="保存并使用该地址" class="dotm_btn1" />
	                 <input type="hidden" name="source" value="<?php echo $_GET[source]; ?>" />
                <?php else: ?>                
                     <a href="javascript:void(0);" onClick="if (confirm('你确认要删除该收货地址吗？'))location.href='<?php echo U('/Mobile/User/del_address',array('id'=>$address[address_id])); ?>'" class="dotm_btn2" style="color:#666;">删除</a>
                     <a href="<?php echo U('/Mobile/User/set_default',array('id'=>$address[address_id])); ?>" class="dotm_btn3" style=" color:#FFF;font-size:14px;">设置为默认地址</a>
                     <input type="submit" value="保存" class="dotm_btn1" />
                <?php endif; ?>
                 
                </div>
                <input type="hidden" name="id" value="<?php echo $address['address_id']; ?>" />
		 
    </form>
</div>        </div>
<script src="__PUBLIC__/js/validate2.js"></script>
<script>
    function checkForm(){
        var consignee = $('input[name="consignee"]').val();
        var province = $('select[name="province"]').find('option:selected').val();
        var city = $('select[name="city"]').find('option:selected').val();
        var district = $('select[name="district"]').find('option:selected').val();
        var address = $('input[name="address"]').val();
        var mobile = $('input[name="mobile"]').val();
        var error = '';
        if(consignee == ''){
            error += '收货人不能为空 <br/>';
        }
        if(province==0){
            error += '请选择省份 <br/>';
        }
        if(city==0){
            error += '请选择城市 <br/>';
        }
        if(district==0){
            error += '请选择区域 <br/>';
        }
        if(address == ''){
            error += '请填写地址 <br/>';
        }
        if(!is_mobile(mobile)){
            error += '手机号码格式有误 <br/>';
		}
        if(error){
		    layer.open({content:error,time:2});
            return false;
        }
			 
        return true;
    }
</script> 
</body>
</html>