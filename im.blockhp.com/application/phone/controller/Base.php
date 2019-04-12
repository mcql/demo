<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;

use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        if(empty(cookie('phone_user_name'))){

            $this->redirect(url('login/index'));
        }
		
		// 统一渲染socket服务器地址
        $this->assign('socket_server', config('socket_server') . ':' . config('socket_port'));
    }
}
