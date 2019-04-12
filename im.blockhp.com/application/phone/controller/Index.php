<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;

use think\Controller;

class Index extends Base
{

    //个人信息
    public function selfSetting()
    {
        if(request()->isAjax()) {
            $userSomeInfo = db('chatuser')->where(['id'=>cookie('phone_user_id')])->field('sex,truename')->find();
            //聊天用户
            $userInfo = [
                'id' => cookie('phone_user_id'),
                'username' => cookie('phone_user_name'),
                'avatar' => cookie('phone_user_avatar'),
                'sign' => cookie('phone_user_sign'),
                'sex' => $userSomeInfo['sex'],
                'email' => $userSomeInfo['truename'],
            ];

            return $userInfo;
        }
    }

    //删除好友
    public function delFriend()
    {
        if(request()->isAjax()) {
            $uid = input('param.uid');
            $selfUid = cookie('phone_user_id');
            db('friends')->where(['user_id'=>cookie('phone_user_id'),'friend_id'=>$uid])->delete();
            db('friends')->where(['user_id'=>$uid,'friend_id'=>cookie('phone_user_id')])->delete();
            return json(['code' => 100, 'msg' => '该好友删除成功！']);
        }
    }

    //关于
    public function about()
    {
        $info = db('system_config')->where(['id'=>1])->find();
        return $info;
    }

    //修改个人信息
    public function changeUserInfo()
    {
        if(request()->isAjax()) {
            $sex = input('param.sex');
            $user_name = input('param.user_name');
            $pwd = input('param.pwd');
            $truename = input('param.truename');
            $userId = cookie('phone_user_id');

            //判定昵称是否可用
            $where['user_name'] = $user_name;
            $where['id'] = array('neq',$userId);
            if(db('chatuser')->where($where)->find())
            {
                return json(['code' => 200, 'msg' => '该昵称已使用，请重新输入！']);
            }

            //性别
            if($sex == 1)
            {
                $shopSex = 1;
            }
            if($sex == -1)
            {
                $shopSex = 2;
            }

            $saveData['sex'] = $sex;
            $saveData['user_name'] = $user_name;
            $saveShopData['sex'] = $shopSex;
            $saveShopData['nickname'] = $user_name;

            //密码修改
            $userPwd = db('chatuser')->where(['id'=>$userId])->value('pwd');
            if($pwd != '')
            {
                if(md5($pwd) == $userPwd)
                {
                    return json(['code' => 200, 'msg' => '不可重置原来的登录密码！']);
                }
                $saveData['pwd'] = md5($pwd);
            }

            //登陆邮箱修改
            if($truename != '')
            {
                $awhere['truename'] = $truename;
                $awhere['id'] = array('neq',$userId);
                if(db('chatuser')->where($awhere)->find())
                {
                    return json(['code' => 200, 'msg' => '该邮箱已使用，请重新输入！']);
                }
                $saveData['truename'] = $truename;
                $saveShopData['email'] = $truename;
            }

            if(db('chatuser')->where(['id'=>$userId])->update($saveData))
            {
                db('users')->where(['user_id' => $userId])->update($saveShopData);
                //重置cookie
                cookie('phone_user_name', $user_name);
                setcookie('uname', $user_name, null, '/');
                return json(['code' => 200, 'msg' => '个人信息修改成功！']);
            }
            return json(['code' => 100, 'msg' => '个人信息修改失败！']);
        }
    }

    public function index()
    {

        //聊天用户
        $userInfo = [
            'id' => cookie('phone_user_id'),
            'username' => cookie('phone_user_name'),
            'avatar' => cookie('phone_user_avatar'),
            'sign' => cookie('phone_user_sign')
        ];

        // 查询自己的信息
        $uid = cookie('phone_user_id');
        $mine = db('chatuser')->where('id', $uid)->find();

        $online = 0;
        $group = [];  //记录分组信息
        $userGroup = config('user_group');
        $list = [];  //群组成员信息
        $i = 0;
        $j = 0;
        //查询该用户的好友
        $friends = db('friends')->alias('f')->field('c.user_name,c.id,c.avatar,c.sign,c.status,f.group_id')
            ->join('tp_chatuser c', 'c.id = f.friend_id')
            ->where('f.user_id', $uid)->select();

        foreach( $userGroup as $key=>$vo ){
            $group[$i] = [
                'groupname' => $vo,
                'id' => $key,
                'online' => 0,
                'list' => []
            ];
            $i++;
        }
        unset( $userGroup );

        foreach( $group as $key=>$vo ){

            foreach( $friends as $k=>$v ) {

                if ($vo['id'] == $v['group_id']) {

                    $list[$j]['username'] = $v['user_name'];
                    $list[$j]['id'] = $v['id'];
                    $list[$j]['avatar'] = $v['avatar'];
                    $list[$j]['sign'] = $v['sign'];
                    $list[$j]['status'] = empty($v['status']) ? 'offline' : 'online';

                    if (1 == $v['status']) {
                        $online++;
                    }

                    $group[$key]['online'] = $online;
                    $group[$key]['list'] = $list;

                    $j++;
                }
            }
            $j = 0;
            $online = 0;
            unset($list);
        }
        //print_r($group);die;
        unset( $friends );

        //查询当前用户的所处的群组
        $groupArr = db('groupdetail')->alias('j')->field('c.group_name groupname,c.id,c.avatar')
            ->join('tp_chatgroup c', 'j.group_id = c.id')->where('j.user_id', $uid)
            ->group('j.group_id')->select();

        $return = [
            'mine' => [
                    'username' => $mine['user_name'],
                    'id' => $mine['id'],
                    'status' => 'online',
                    'sign' => $mine['sign'],
                    'avatar' => $mine['avatar']
            ],
            'friend' => $group,
            'group' => $groupArr

        ];

        //echo json_encode($return);die;

        $this->assign([
            'userlist' => json_encode($return),
            'uinfo' => $userInfo
        ]);

        return $this->fetch();
    }

    // 获取我的群组
    public function myGroup()
    {
        $groups = db('chatgroup')->where('owner_id', cookie('phone_user_id'))->select();

        return json(['code' => 1, 'data' => $groups, 'msg' => 'group info']);
    }

    // 获取群组成详情
    public function groupDetail()
    {
        $gid = input('param.gid');

        $groups = db('chatgroup')->where('id', $gid)->where('owner_id', cookie('phone_user_id'))->find();
        if(empty($groups)) {
            return json(['code' => -2, 'data' => '', 'msg' => '无权操作']);
        }

        $info = db('groupdetail')->where('group_id', $gid)->select();

        return json(['code' => 1, 'data' => $info, 'msg' => cookie('phone_user_id')]);
    }

    // 移出成员出组
    public function removeMember()
    {
        if(request()->isAjax()){
            $uid = input('param.uid');
            $groupId = input('param.gid');

            $canNot = db('chatgroup')->field('owner_id')->where('id', $groupId)->find();
            if(empty($canNot)){
                return json(['code' => -1, 'data' => '', 'msg' => '异常操作']);
            }

            if($uid == $canNot['owner_id']){
                return json(['code' => -2, 'data' => '', 'msg' => '不可移除群主']);
            }
            //该群的管理员不是当前的操作人，则为非法操作
            if($canNot['owner_id'] != cookie('phone_user_id')){
                return json(['code' => -3, 'data' => '', 'msg' => '非法操作']);
            }

            $flag = db('groupdetail')->where('user_id', $uid)->where('group_id', $groupId)->delete();
            if(empty($flag)){
                return json(['code' => -4, 'data' => '', 'msg' => '操作失败']);
            }

            return json( ['code' => 1, 'data' => '', 'msg' => '移除成功'] );
        }

        $this->error('非法访问');
    }


    //图片上传
    public function uploadingImg()
    {
        $file = request()->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public/uploads');
            if($info){
                // 成功上传后 获取上传信息
                $route = $info->getSaveName();
                //获取路径
                $route = '/public/uploads/' . $route;
                //修改用户头像
                $userId = cookie('phone_user_id');

                if(db('chatuser')->where(['id'=>$userId])->update(['avatar' => $route]) && db('users')->where(['user_id' => $userId])->update(['head_pic' => $route]))
                {
                    //重置cookie
                    cookie('phone_user_avatar', $route);
                    return json(['code' => 200, 'msg' => $route]);
                }
                return json(['code' => 100, 'msg' => '头像修改失败']);
            }else{
                // 上传失败获取错误信息
                return json(['code' => 100, 'msg' => '头像修改失败']);
            }
        }
    }
}

