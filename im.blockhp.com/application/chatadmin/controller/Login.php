<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\chatadmin\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function doLogin()
    {
        if(request()->isAjax()){

            $uname = input('post.uname');
            $pwd = input('post.pwd');
			
            $admin = db('chatadmin')->where('login_name', $uname)->find();
            if(empty($admin)){
                return json(['code' => -1, 'data' => '', 'msg' => '管理员不存在']);
            }

            if( md5($pwd) != $admin['password'] ){
                return json(['code' => -2, 'data' => '', 'msg' => '密码错误']);
            }

            //设置cookie
            $time = config('cookie_save_time');
            cookie('username', $uname, $time);
            cookie('uid', $admin['id'], $time);

            return json(['code' => 1, 'data' => url('index/index'), 'msg' => '登录成功']);
        }

        $this->error('非法访问');
    }

    public function loginOut()
    {
        cookie('username', null);
        cookie('uid', null);

        $this->redirect(url('login/index'));
    }
}