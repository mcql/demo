<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------
    'socket_server' => '47.91.17.219',
    'socket_port' => 8282,

    //群组状态
    'group_status' => [
        '1' => '通过审核',
        '-1' => '等待审核',
        '-2' => '审核未通过'
    ],

    //默认上传图片格式
    'common_img' => [
        'png',
        'jpg'
    ],

    //默认上传图片大小 100kb
    'common_size' => 100 * 1024,

    //聊天记录每页显示条数
    'log_page' => 10,

    //空间说说条数
    'blog_page' => 10,

    //举报条款
    'report_type' => [
        '1' => '发布色情/政治/违法/恐怖内容',
        '2' => '被骗钱',
        '3' => '被骚扰'
    ],

    'report_detail' => [
        '1' => [
            '色情低俗',
            '政治敏感',
            '违法暴力',
            '恐怖血腥',
            '非法售卖野生物及制品'
        ],

        '2' => [
            '冒充好友',
            '其他方式'
        ],

        '3' => [
            '垃圾广告',
            '侮辱谩骂',
            '其他'
        ]
    ],


    // 应用命名空间
    'app_namespace'          => 'app',
    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => true,
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => '',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'Phone',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => false,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否强制使用路由
    'url_route_must'         => false,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__CSS__' => '/public/static/admin/css',
        '__JS__' => '/public/static/admin/js',
        '__COMMON__' => '/public/static/common'
    ],

    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Console',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],


    //tpshop部分,start
    // 密码加密串
    'AUTH_CODE' => "TPSHOP", //安装完毕之后不要改变，否则所有密码都会出错

    'ORDER_STATUS' => array(
        0 => '待确认',
        1 => '已确认',
        2 => '已收货',
        3 => '已取消',
        4 => '已完成',//评价完
        5 => '已作废',
    ),
    'SHIPPING_STATUS' => array(
        0 => '未发货',
        1 => '已发货',
        2 => '部分发货'
    ),
    'PAY_STATUS' => array(
        0 => '未支付',
        1 => '已支付',
    ),
    'SEX' => array(
        0 => '保密',
        1 => '男',
        2 => '女'
    ),
    'COUPON_TYPE' => array(
        0 => '面额模板',
        1 => '指定发放',
        2 => '免费领取',
        3 => '线下发放',
        4 => '邀请发放'
    ),
    'PROM_TYPE' => array(
        0 => '默认',
        1 => '抢购',
        2 => '团购',
        3 => '优惠'
    ),
    // 订单用户端显示状态
    'WAITPAY'=>' AND pay_status = 0 AND order_status = 0 AND pay_code !="cod" ', //订单查询状态 待支付
    'WAITSEND'=>' AND (pay_status=1 OR pay_code="cod") AND shipping_status !=1 AND order_status in(0,1) ', //订单查询状态 待发货
    'WAITRECEIVE'=>' AND shipping_status=1 AND order_status = 1 ', //订单查询状态 待收货
    'WAITCCOMMENT'=> ' AND order_status=2 ', // 待评价 确认收货     //'FINISHED'=>'  AND order_status=1 ', //订单查询状态 已完成
    'FINISH'=> ' AND order_status = 4 ', // 已完成
    'CANCEL'=> ' AND order_status = 3 ', // 已取消
    'CANCELLED'=> 'AND order_status = 5 ',//已作废

    'ORDER_STATUS_DESC' => array(
        'WAITPAY' => '待支付',
        'WAITSEND'=>'待发货',
        'WAITRECEIVE'=>'待收货',
        'WAITCCOMMENT'=> '待评价',
        'CANCEL'=> '已取消',
        'FINISH'=> '已完成', //
        'CANCELLED'=> '已作废'
    ),
    'REFUND_STATUS'=>array(
        -2 => '服务单取消',//会员取消
        -1 => '审核失败',//不同意
        0  => '待审核',//卖家审核
        1  => '审核通过',//同意
        2  => '已发货',//买家发货
        3  => '已收货',//卖家收货
        4  => '已完成',//换货维修完成
        5  => '退款完成',//退款完成
        6  => '申请仲裁'
    ),
    /**
     *  订单用户端显示按钮
    去支付     AND pay_status=0 AND order_status=0 AND pay_code ! ="cod"
    取消按钮  AND pay_status=0 AND shipping_status=0 AND order_status=0
    确认收货  AND shipping_status=1 AND order_status=0
    评价      AND order_status=1
    查看物流  if(!empty(物流单号))
    退货按钮（联系客服）  所有退换货操作， 都需要人工介入   不支持在线退换货
     */

    'goods_state' => array(
        '0'=>'待审核',
        '1'=>'审核通过',
        '2'=>'审核失败'
    ),

    //短信使用场景
    'SEND_SCENE' => array(
        '1'=>array('用户注册','验证码${code}，您正在注册成为${product}用户，感谢您的支持!','regis_sms_enable'),
        '2'=>array('用户找回密码','验证码${code}，用于密码找回，如非本人操作，请及时检查账户安全','forget_pwd_sms_enable'),
        '3'=>array('客户下单','您有新订单，收货人：${consignee}，联系方式：${phone}，请您及时查收.','order_add_sms_enable'),
        '4'=>array('客户支付','订单:${order_sn}已经支付，请及时发货.','order_pay_sms_enable'),
        '5'=>array('商家发货','尊敬的${user_name}用户，您的订单${order_sn}已发货，收货人${consignee}，请您及时查收','order_shipping_sms_enable'),
        '6'=>array('身份验证','【${user_name}】 尊敬的用户，您的验证码为${code}, 本验证码有效时间为10分钟, 请勿告诉他人.','bind_mobile_sms_enable'),
    ),


    'STORE_PRIVILEGE' => array('goods'=>'商品管理','order'=>'订单物流','promtion'=>'促销管理','store'=>'店铺管理',
        'service'=>'售后服务','charts'=>'统计报表','mesaage'=>'客服消息','seller'=>'账号管理',
        'finance'=>'财务管理','distribut'=>'分销管理','maintenance'=>'运营'),

    'TPSHOP_PRIVILEGE' => array('system'=>'系统设置','content'=>'内容管理','goods'=>'商品中心','member'=>'会员中心',
        'order'=>'订单中心','marketing'=>'营销推广','tools'=>'插件工具','count'=>'统计报表',
        'weixin'=>'微信管理','store'=>'店铺管理','distribut'=>'分销管理','maintenance'=>'运营'
    ),

    /**假设这个访问地址是 www.tpshop.cn/home/goods/goodsInfo/id/1.html
     *就保存名字为 home_goods_goodsinfo_1.html
     *配置成这样, 指定 模块 控制器 方法名 参数名
     */
    'HTML_CACHE_ARR'=> [
//    ['mca'=>'home_Goods_goodsInfo','p'=>['id']],
//    ['mca'=>'home_Index_index'],  // 缓存首页静态页面
//    ['mca'=>'home_Goods_ajaxComment','p'=>['goods_id','commentType','p']],  // 缓存评论静态页面 http://www.tpshop2.0.com/index.php?m=Home&c=Goods&a=ajaxComment&goods_id=142&commentType=1&p=1
//    ['mca'=>'home_Goods_ajax_consult','p'=>['goods_id','consult_type','p']],  // 缓存咨询静态页面 http://www.tpshop2.0.com/index.php?m=Home&c=Goods&a=ajax_consult&goods_id=142&consult_type=0&p=2
    ],
    'PAYMENT_PLUGIN_PATH' =>  PLUGIN_PATH.'payment',
    'LOGIN_PLUGIN_PATH' =>  PLUGIN_PATH.'login',
    'SHIPPING_PLUGIN_PATH' => PLUGIN_PATH.'shipping',
    'FUNCTION_PLUGIN_PATH' => PLUGIN_PATH.'function',

    /**
     * coreseek/sphinx全文检索引擎配置
     */
    'SPHINX_HOST'         =>      '127.0.0.1',
    'SPHINX_PORT'         =>      9312,
    //tpshop部分,end
];