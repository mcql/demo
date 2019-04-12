<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\chatadmin\controller;

use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        if(empty(cookie('username'))){

            $this->redirect(url('login/index'));
        }

        $this->assign([
            'username' => cookie('username')
        ]);
    }
}