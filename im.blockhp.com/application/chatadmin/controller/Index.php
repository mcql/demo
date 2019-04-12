<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\chatadmin\controller;

use think\Db;

class Index extends Base
{
    public function index()
    {
        return $this->fetch('/main');
    }

    public function homePage()
    {
        $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_ip'       => $_SERVER['SERVER_ADDR'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];

        $this->assign([
            'config' => $config
        ]);

        return $this->fetch('index');
    }

    /**
    *修改登录密码
     */
    public function changePassword()
    {
        if(request()->isPost()){

            $data = input('post.');
            $pw = db('chatadmin')->where('id', cookie('uid'))->getField('password');
            if($pw != md5($data['oldPassword']))
            {
                return json(['code' => -1, 'data' => '', 'msg' => '旧登录密码不正确！']);
            }
            if($data['newPassword'] != $data['surePassword'])
            {
                return json(['code' => -1, 'data' => '', 'msg' => '新密码和确认密码不一致！']);
            }

            $rs = db('chatadmin')->where('id', cookie('uid'))->save(['password'=>md5($data['newPassword'])]);

            if($rs)
            {
                return json(['code' => 1, 'data' => '', 'msg' => '登录密码成功!']);
            }

            return json(['code' => -1, 'data' => '', 'msg' => '登录密码失败!']);

        }

        return $this->fetch();
    }

    /**
     *关于Mitalk密聊
     */
    public function about()
    {
        if(request()->isPost()){

            $data = input('post.');

            $rs = db('system_config')->where(['id'=>1])->update($data);

            if($rs)
            {
                return json(['code' => 1, 'data' => '', 'msg' => '修改成功!']);
            }

            return json(['code' => -1, 'data' => '', 'msg' => '修改失败!']);

        }

        $info = db('system_config')->where(['id'=>1])->find();
        $this->assign([
            'info' => $info
        ]);
        return $this->fetch();
    }
}
