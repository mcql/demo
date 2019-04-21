<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"./template/mobile/new/store/goods_list.html";i:1555520524;s:38:"./template/mobile/new/public/menu.html";i:1555520524;}*/ ?>
<!DOCTYPE html >
<html>
<head>
    <meta name="Generator" content="TPSHOP v2.1.8"/>
    <meta charset="UTF-8">
    <meta name="Keywords" content="<?php echo $store['seo_keywords']; ?>"/>
    <meta name="Description" content="<?php echo $store['seo_description']; ?>"/>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title><?php echo $store['store_name']; ?> </title>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="icon" href="animated_favicon.gif" type="image/gif"/>
    <link rel="alternate" type="application/rss+xml" title="RSS" href=""/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/dianpu.css">
    <script type="text/javascript" src="__STATIC__/js/layer.js"></script>
    <script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<body style=" background:#F5F5F5">
<header>
    <div class="tab_nav">
        <div class="header">
            <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
            <div class="h-mid">全部商品</div>
            <div class="h-right">
                <aside class="top_bar">
                    <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a></div>
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
<section class="filtrate_term" id="product_sort" style="width: 100%;">
    <ul>
        <?php if(is_array($link_arr) || $link_arr instanceof \think\Collection): if( count($link_arr)==0 ) : echo "" ;else: foreach($link_arr as $k=>$link): ?>
            <li
            <?php if($link[key] == $keys): ?>class='on'<?php endif; ?>
            ><a href="<?php echo $link['url']; ?>"><?php echo $link['name']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <li class="" style=" border-left:1px solid #ccc; margin-right:-1px;"><a href="javascript:void(0);" class="show_type show_list">&nbsp;</a></li>
    </ul>
</section>
<div class="product_list">
    <ul id="goods_list">
    </ul>
</div>

<script type="Text/Javascript" language="JavaScript">

    <!--
    function selectPage(sel) {
        sel.form.submit();
    }
    //-->
    $(function () {
        getGoodsList();
    });

    var page = 1;//页数
    var cat_id = '<?php echo $cat_id; ?>';
    var key = '<?php echo $key; ?>';
    var sort = '<?php echo $sort; ?>';
    var keywords = '<?php echo $keywords; ?>';
    var store_id = "<?php echo $_GET['store_id']; ?>";
    function getGoodsList() {
        $('.get_more').show();
        $.ajax({
            type: "POST",
            url: "/index.php?m=Mobile&c=Store&a=goods_list",
            data: {p: page, cat_id: cat_id, key: key, sort: sort, keywords: keywords ,store_id:store_id},
            dataType: 'html',
            success: function (data) {
                if (data) {
                    $("#goods_list").append(data);
                    page++;
                    $('.get_more').hide();
                } else {
                    $('.get_more').hide();
                    $('#getmore').remove();
                }
            }
        });
    }

    $('.show_type').bind("click", function () {
        if ($('#goods_list').hasClass('openList')) {
            $('#goods_list').removeClass('openList');
            $(this).removeClass('show_list');
        }
        else {
            $('#goods_list').addClass('openList');
            $(this).addClass('show_list');
        }
    });

</script>
<!--  
<form name="selectPageForm" action="" method="get">
<div class="c_pagination" id="pager">
      <a href="javascript:;" class="last">上一页</a>
      <a href="javascript:;" class="page-num">1/3</a>
      <a href="" class="next">下一页</a> 
</div>
</form>
-->
<script type="Text/Javascript" language="JavaScript">
    <!--

    function selectPage(sel) {
        sel.form.submit();
    }

    //-->
</script>

<?php if($goods_list_total_count > page_count): ?>
<div class="floor_body2">
    <div id="J_ItemList">
        <ul class="product single_item info">
        </ul>
        <a href="javascript:;" class="get_more" style="text-align:center; display:block;">
            <img src='__STATIC__/images/category/loader.gif' width="12" height="12"> </a>
    </div>
    <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem;">
        <a href="javascript:void(0)" onClick="getGoodsList()">点击加载更多</a>
    </div>
</div>
<?php endif; ?>
<div style=" height:40px;"></div>
<div class="bottm_nav">
    <ul>
        <li class="bian"><a href="<?php echo U('Store/store_goods_class',array('store_id'=>$store[store_id])); ?>">店铺分类</a></li>
        <li class="bian"><a href="<?php echo U('Store/about',array('store_id'=>$store[store_id])); ?>">店铺简介</a></li>
        <li><a href="tel:<?php echo $store['store_phone']; ?>">联系卖家</a></li>
    </ul>
</div>
</body>
</html>