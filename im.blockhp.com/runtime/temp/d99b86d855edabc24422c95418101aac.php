<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"./application/admin/view2/finance/userecharge.html";i:1555778155;s:44:"./application/admin/view2/public/layout.html";i:1491382650;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/flexigrid.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
<script src="__PUBLIC__/js/myFormValidate.js"></script>
<script src="__PUBLIC__/js/myAjax2.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript">
function delfunc(obj){
	layer.confirm('确认删除？', {
		  btn: ['确定','取消'] //按钮
		}, function(){
			$.ajax({
				type : 'post',
				url : $(obj).attr('data-url'),
				data : {act:'del',del_id:$(obj).attr('data-id')},
				dataType : 'json',
				success : function(data){
					if(data==1){
						layer.msg('操作成功', {icon: 1});
						$(obj).parent().parent().parent().remove();
					}else{
						layer.msg(data, {icon: 2,time: 2000});
					}
				}
			})
		}, function(index){
			layer.close(index);
			return false;// 取消
		}
	);
}

function delAll(obj,name){
	var a = [];
	$('input[name*='+name+']').each(function(i,o){
		if($(o).is(':checked')){
			a.push($(o).val());
		}
	})
	if(a.length == 0){
		layer.alert('请选择删除项', {icon: 2});
		return;
	}
	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
			$.ajax({
				type : 'get',
				url : $(obj).attr('data-url'),
				data : {act:'del',del_id:a},
				dataType : 'json',
				success : function(data){
					if(data == 1){
						layer.msg('操作成功', {icon: 1});
						$('input[name*='+name+']').each(function(i,o){
							if($(o).is(':checked')){
								$(o).parent().parent().remove();
							}
						})
					}else{
						layer.msg(data, {icon: 2,time: 2000});
					}
					layer.closeAll();
				}
			})
		}, function(index){
			layer.close(index);
			return false;// 取消
		}
	);	
}

//表格列表全选反选
$(document).ready(function(){
	$('.hDivBox .sign').click(function(){
	    var sign = $('#flexigrid > table>tbody>tr');
	   if($(this).parent().hasClass('trSelected')){
	       sign.each(function(){
	           $(this).removeClass('trSelected');
	       });
	       $(this).parent().removeClass('trSelected');
	   }else{
	       sign.each(function(){
	           $(this).addClass('trSelected');
	       });
	       $(this).parent().addClass('trSelected');
	   }
	})
});

//获取选中项
function getSelected(){
	var selectobj = $('.trSelected');
	var selectval = [];
    if(selectobj.length > 0){
        selectobj.each(function(){
        	selectval.push($(this).attr('data-id'));
        });
    }
    return selectval;
}
</script>
</head>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>会员充值列表</h3>
                <h5>会员充值结算索引与管理</h5>
            </div>
        </div>
    </div>
    <!-- 操作说明 -->
    <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom" style="display: block;"></span>
        </div>
        <ul>
			<li></li>
			<li></li>
			<li></li>
        </ul>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>会员充值列表</h3>
                <h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
            </div>
            <!--<div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>-->
            <!--<form class="navbar-form form-inline" id="search-form" method="get" action="<?php echo U('order_statis'); ?>" onsubmit="return check_form();">
                <input type="hidden" name="create_date" id="create_time" value="<?php echo $create_date; ?>">
                <div class="sDiv">
                    <div class="sDiv2" style="margin-right: 10px;">
                        <input type="text" size="30" id="start_time" value="<?php echo $start_time; ?>" placeholder="起始时间" class="qsbox">
                        <input type="button" class="btn" value="起始时间">
                    </div>
                    <div class="sDiv2" style="margin-right: 10px;">
                        <input type="text" size="30" id="end_time" value="<?php echo $end_time; ?>" placeholder="截止时间" class="qsbox">
                        <input type="button" class="btn" value="截止时间">
                    </div>
                    <div class="sDiv2">
                        &lt;!&ndash;<input size="30" placeholder="店铺id" value="<?php echo \think\Request::instance()->request('store_id'); ?>" name="store_id" class="qsbox" type="text">&ndash;&gt;
                        <input class="btn" value="搜索" type="submit">
                    </div>
                </div>
            </form>-->
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table  style="width: 100%;" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr style="width: 100%;">
                        <th style="width: 20%" class="sign">
                            <div><i class="ico-check"></i></div>
                        </th>
                        <th style="width: 20%" align="center" abbr="article_title" class="">
                            <div class="">记录ID</div>
                        </th>
                        <th style="width: 20%" align="center" abbr="ac_id" class="">
                            <div class="">用户名</div>
                        </th>
                        <th style="width: 20%" align="center" abbr="article_show" class="">
                            <div class="">金额/BHP</div>
                        </th>
                        <th style="width: 20%" align="center" abbr="article_show" class="">
                            <div class="">创建时间</div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table>
                    <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td style="width: 20%;" class="sign">
                                <div><i class="ico-check"></i></div>
                            </td>
                            <td style="width: 20%;" align="center" class="">
                                <div><?php echo $v['log_id']; ?></div>
                            </td>
                            <td style="width: 20%;" align="center" class="">
                                <div><?php echo $v['email']; ?></div>
                            </td>
                            <td style="width: 20%;" align="center" class="">
                                <div><?php echo $v['user_money']; ?></div>
                            </td>
                            <td style="width: 20%;" align="center" class="">
                                <div><?php echo date("Y-m-d H:i",$v['change_time']); ?></div>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="iDiv" style="display: none;"></div>
        </div>
        <!--分页位置-->
        <?php echo $show; ?> </div>
</div>
<script>
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        $('#start_time').layDate();
        $('#end_time').layDate();
    });

    function check_form(){
        var start_time = $.trim($('#start_time').val());
        var end_time =  $.trim($('#end_time').val());
        if(start_time == '' ^ end_time == ''){
            layer.alert('请选择完整的时间间隔', {icon: 2});
            return false;
        }
        if(start_time !== '' && end_time !== ''){
            $('#create_time').val(start_time+" - "+end_time);
        }
        return true;
    }
</script>
</body>
</html>