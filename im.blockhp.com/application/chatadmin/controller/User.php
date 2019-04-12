<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\chatadmin\controller;

class User extends Base
{
    //用户列表
    public function index()
    {
        $tempSelect = db('chatuser');
        $userName = input('param.user_name');
        if(!empty($userName)){
            $tempSelect =  $tempSelect->where('user_name', $userName);
        }

        $list = $tempSelect->paginate(10);
        $this->assign([
            'list' => $list,
            'uname' => empty($userName) ? '' : $userName,
            'total' => $list->total(),
            'sex' => ['1' => '男', '-1' => '女']
        ]);

        return $this->fetch();
    }

}