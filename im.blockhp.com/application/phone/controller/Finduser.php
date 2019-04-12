<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;

class Finduser extends Base
{
    //查询好友
    public function index()
    {
        if(request()->isAjax()){

            $param = input('post.');

            $uid = cookie('phone_user_id');

            $tempSelect = db('chatuser')->field('id,user_name,avatar')->where('id', '<>', $uid);

            if(!empty($param['user_name'])){
                $tempSelect = $tempSelect->where('user_name', 'like', '%' . $param['user_name'] . '%');
            }

            //排除已经是好友的人
            $friends = db('friends')->field('friend_id')->where('user_id', $uid)->select();
            if(!empty($friends)){
                foreach($friends as $vo){
                    $fArr[] = $vo['friend_id'];
                }

                unset($friends);
                $tempSelect = $tempSelect->where('id', 'not in',implode(',', $fArr));
            }

            //考虑到性能问题，目前暂时最多展示8个人，而且是按照id倒叙排列，有需求再更改
            $userList = $tempSelect->order('id desc')->limit(8)->select();
            if(count($userList) > 0)
            {
                return json(['code' => 1, 'data' => $userList, 'msg' => 'success']);
            }

            return json(['code' => -1, 'data' => $userList, 'msg' => 'fail']);
        }

        $this->error('非法访问');
    }

    // 搜索查询群组
    public function search()
    {
        $groupName = input('param.user_name');
        $find = db('chatgroup')
            ->where('group_name', 'like', "%{$groupName}%")
            ->where('status', 1)
            ->select();

        if( empty($find) ){
            return json( ['code' => -1, 'data' => '', 'msg' => '您搜的群不存在' ] );
        }

        return json( ['code' => 1, 'data' => $find, 'msg' => 'success' ] );
    }
}