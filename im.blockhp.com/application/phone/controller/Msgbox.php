<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;

class Msgbox extends Base
{
    // 获取通知消息
    public function getMsg()
    {
        if(request()->isAjax()){
            // TODO 只取最新 20 条
            $msg = db('message')->where('uid', cookie('phone_user_id'))->order('time desc')->limit(20)->select();
            //拼装发送人信息
            if(empty($msg)){
               return json(['code' => 0, 'pages' => 0, 'data' => '', 'msg' => '']);
            }

            foreach($msg as $key=>$vo){
                $msg[$key]['time'] = date('Y-m-d H:i');
                if(1 == $vo['type']){
                    $user = db('chatuser')->field('avatar,user_name,sign')->where('id', $vo['from'])->find();
                    $msg[$key]['user'] = [
                        'id' => $vo['from'],
                        'avatar' => $user['avatar'],
                        'username' => $user['user_name'],
                        'sign' => $user['sign']
                    ];
                }else{
                    $msg[$key]['user']['id'] = null;
                }
            }
            // 标记消息为已读
            db('message')->where('uid', cookie('phone_user_id'))->setField('read', 2);

            return json(['code' => 1, 'data' => $msg, 'msg' => '']);

        }
        $this->error('非法访问');
    }

    // 获取通知消息
    public function getGroupMsg()
    {
        if(request()->isAjax()){
            // TODO 只取最新 20 条
            $msg = db('group_apply')->where('to_id', cookie('phone_user_id'))->order('apply_time desc')->limit(20)->select();
            //拼装发送人信息
            if(empty($msg)){
                return json(['code' => 0, 'pages' => 0, 'data' => '', 'msg' => '']);
            }

            // 标记消息为已读
            db('group_apply')->where('to_id', cookie('phone_user_id'))->setField('is_read', 2);

            return json(['code' => 1, 'data' => $msg, 'msg' => '']);

        }
        $this->error('非法访问');
    }

    // 申请好友
    public function applyFriend()
    {
        if(request()->isAjax()){

            $param = input('post.');
            // 检测是否被要添加的用户加入了黑名单，若加入，则无法申请添加该好友
            $inBlack = db('blacktab')->where('put_uid', cookie('phone_user_id'))->where('user_id', $param['uid'])->find();
            if(!empty($inBlack)){
                return json(['code' => -2, 'data' => '', 'msg' => '对方已将你加入黑名单']);
            }

            // 防止重复提交添加信息
            $messsage = db('message')->where('from', cookie('phone_user_id'))->where('uid', $param['uid'])
                ->where('agree', 0)->find();
            if(!empty($messsage)){
                return json(['code' => -3, 'data' => '', 'msg' => '请耐心等待对方回复']);
            }

            //入库系统消息
            $msg = [
                'content' => '申请添加你为好友',
                'uid' => $param['uid'],
                'from' => cookie('phone_user_id'), //发起好友申请的uid
                'remark' => '',
                'from_group' => 1, // 默认添加到朋友分组
                'type' => 1,
                'read' => 1,
                'time' => time()
            ];

            $flag = db('message')->insert($msg);
            if(empty($flag)){
                return json(['code' => -1, 'data' => '', 'msg' => '系统错误']);
            }

            return json(['code' => 0, 'data' => '', 'msg' => 'success']);
        }
        $this->error('非法访问');
    }

    // 同意好友申请
    public function agreeFriend()
    {
        if(request()->isAjax()){
            $param = input('post.');

            //建立好友关系
            //1、将我与请求人建立关系
            $myFriend = [
                'user_id' => cookie('phone_user_id'),
                'friend_id' => $param['uid'],
                'group_id' => $param['group']
            ];

            $flag = db('friends')->insert($myFriend);
            if(empty($flag)){
                return json(['code' => -1, 'data' => '', 'msg' => '系统错误']);
            }
            unset($myFriend);

            //2、将请求人与我建立关系
            $yourFriend = [
                'user_id' => $param['uid'],
                'friend_id' => cookie('phone_user_id'),
                'group_id' => $param['from_group']
            ];

            $flag = db('friends')->insert($yourFriend);
            if(empty($flag)){
                return json(['code' => -2, 'data' => '', 'msg' => '系统错误']);
            }
            unset($yourFriend);

            //入库系统消息
            $msg = [
                'content' => cookie('phone_user_name') . ' 已经同意你的好友申请',
                'uid' => $param['uid'],
                'from' => 0,
                'from_group' => $param['from_group'],
                'type' => 2,
                'remark' => '同意',
                'read' => 1,
                'time' => time()
            ];

            $flag = db('message')->insert($msg);
            if(empty($flag)){
                return json(['code' => -3, 'data' => '', 'msg' => '系统错误']);
            }

            //将此消息标记为已经同意
            $flag = db('message')->where('id', $param['id'])->setField('agree', 1);
            if(empty($flag)){
                return json(['code' => -4, 'data' => '', 'msg' => '系统错误']);
            }

            return json(['code' => 0, 'data' => '', 'msg' => 'success']);
        }
        $this->error('非法访问');
    }

    //拒绝好友申请
    public function refuseFriend()
    {
        if(request()->isAjax()){

            $param = input('post.');

            //将此消息标记为拒绝
            $flag = db('message')->where('id', $param['id'])->setField('agree', 2);
            if(empty($flag)){
                return json(['code' => -1, 'data' => '', 'msg' => '系统错误']);
            }

            //入库系统消息
            $msg = [
                'content' => cookie('phone_user_name') . ' 拒绝了你的好友申请',
                'uid' => $param['uid'],
                'from' => 0,
                'type' => 2,
                'read' => 1,
                'remark' => '拒绝',
                'time' => time()
            ];

            $flag = db('message')->insert($msg);
            if(empty($flag)){
                return json(['code' => -2, 'data' => '', 'msg' => '系统错误']);
            }

            return json(['code' => 0, 'data' => '', 'msg' => 'success']);
        }
        $this->error('非法访问');
    }

    // 申请加组
    public function applyGroup()
    {
        if(request()->isAjax()){

            $param = input('post.');
            // 检测该用户是否已经加入了该群组
            $isJoin = db('groupdetail')->where('user_id', cookie('phone_user_id'))->where('group_id', $param['group_id'])
                ->find();
            if(!empty($isJoin)){
                return json(['code' => -1, 'data' => '', 'msg' => '您已经加入了该群组']);
            }
            unset($isJoin);

            // 检测是否有在审核的申请
            $inCheck = db('group_apply')->where('from_id', cookie('phone_user_id'))->where('join_group_id', $param['group_id'])
                ->where('status', 1)->find();
            if(!empty($inCheck)) {
                return json(['code' => -3, 'data' => '', 'msg' => '您的申请正在审核中']);
            }

            $groupOwner = db('chatgroup')->field('owner_id')->where('id', $param['group_id'])->find();
            if(empty($groupOwner)) {
                return json(['code' => -2, 'data' => '', 'msg' => '该群组不存在']);
            }

            db('group_apply')->insert([
                'from_id' => cookie('phone_user_id'),
                'from_name' => cookie('phone_user_name'),
                'from_avatar' => cookie('phone_user_avatar'),
                'from_sign' => cookie('phone_user_sign'),
                'to_id' => $groupOwner['owner_id'],
                'join_group_id' => $param['group_id'],
                'join_group_name' => $param['group_name'],
                'join_group_avatar' => $param['group_avatar'],
                'remark' => cookie('phone_user_name') . ' 申请加入 ' . $param['group_name'],
                'apply_time' => date('Y-m-d H:i:s'),
                'status' => 1,
                'is_read' => 1,
                'is_system' => 1
            ]);

            return json(['code' => 1, 'data' => '', 'msg' => '申请成功，等待管理员审核']);
        }
        $this->error('非法访问');
    }

    // 加入群组
    public function joinGroup()
    {
        $param = input('post.');

        $groupId = $param['group_id'];
        $has = db('chatgroup')->where('id', $groupId)->find();

        if(empty( $has )){
            return json( ['code' => -1, 'data' => '', 'msg' => '该群组不存在' ] );
        }

        $uid = $param['apply_id'];
        // 已经加入了
        $allReady = db('groupdetail')->field('user_id')
            ->where('group_id = :gid and user_id = :uid', ['gid' => $groupId, 'uid' => $uid])
            ->find();

        if( !empty( $allReady ) ){
            return json( ['code' => -2, 'data' => '', 'msg' => '你已经加入该群了' ] );
        }

        $detailParam = [
            'user_id' => $uid,
            'user_name' => $param['apply_name'],
            'user_avatar' => $param['apply_avatar'],
            'user_sign' => $param['apply_sign'],
            'group_id' => $groupId
        ];

        db('groupdetail')->insert( $detailParam );

        db('group_apply')->where('id', $param['id'])->setField('status', 2);
        db('group_apply')->insert([
            'from_id' => cookie('phone_user_id'),
            'from_name' => cookie('phone_user_name'),
            'from_avatar' => cookie('phone_user_avatar'),
            'from_sign' => cookie('phone_user_sign'),
            'to_id' => $uid,
            'join_group_id' => $param['group_id'],
            'join_group_name' => '',
            'join_group_avatar' => '',
            'remark' => cookie('phone_user_name') . ' 已同意你加入群组',
            'apply_time' => date('Y-m-d H:i:s'),
            'status' => 1,
            'is_read' => 1,
            'is_system' => 2
        ]);

        return json( ['code' => 0, 'data' => $param, 'msg' => '成功加入' ] );
    }

    // 拒绝加入群组
    public function refuseGroup()
    {
        $param = input('post.');

        db('group_apply')->where('id', $param['id'])->setField('status', 3);

        db('group_apply')->insert([
            'from_id' => cookie('phone_user_id'),
            'from_name' => cookie('phone_user_name'),
            'from_avatar' => cookie('phone_user_avatar'),
            'from_sign' => cookie('phone_user_sign'),
            'to_id' => $param['uid'],
            'join_group_id' => 0,
            'join_group_name' => '',
            'join_group_avatar' => '',
            'remark' => cookie('phone_user_name') . ' 拒绝你加入群组',
            'apply_time' => date('Y-m-d H:i:s'),
            'status' => 3,
            'is_read' => 1,
            'is_system' => 2
        ]);

        return json( ['code' => 0, 'data' => $param, 'msg' => '拒绝成功' ] );
    }

    // 获取当前用户有多少个未读通知
    public function getNoRead()
    {
        if(request()->isAjax()){

            $tips = db('message')->where('uid', cookie('phone_user_id'))->where('read', 1)->count();
            return json(['code' => 1, 'data' => $tips, 'msg' => 'success']);
        }
        $this->error('非法访问');
    }

    // 获取当前用户有多少个未读申请群组通知
    public function getApplyNoRead()
    {
        if(request()->isAjax()){

            $tips = db('group_apply')->where('to_id', cookie('phone_user_id'))->where('is_read', 1)->count();
            return json(['code' => 1, 'data' => $tips, 'msg' => 'success']);
        }
        $this->error('非法访问');
    }

    // 添加群组
    public function addGroup()
    {
        if (request()->isAjax()) {

            $param = input('post.');

            if (empty($param['group_name'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '群组名不能为空']);
            }

            if(db('chatgroup')->where(['group_name'=>$param['group_name']])->find())
            {
                return json(['code' => -1, 'data' => '', 'msg' => '该群名已存在，请重新输入!']);
            }

            $param['owner_name'] = cookie('phone_user_name');
            $param['owner_id'] = cookie('phone_user_id');
            $param['owner_avatar'] = cookie('phone_user_avatar');
            $param['owner_sign'] = cookie('phone_user_sign');
            $param['addtime'] = time();
            $param['status'] = 1;
            $param['avatar'] = '/public/static/phone/images/group_avatar.jpg';

            $groupId = db('chatgroup')->insertGetId($param);
            if (empty($groupId)) {
                return json(['code' => -2, 'data' => '', 'msg' => '添加群组失败']);
            }
            //unset($param);

            //将自己加入群组
            $groupDetail = [
                'user_id' => cookie('phone_user_id'),
                'user_name' => cookie('phone_user_name'),
                'user_avatar' => cookie('phone_user_avatar'),
                'user_sign' => cookie('phone_user_sign'),
                'group_id' => $groupId,
            ];
            $flag = db('groupdetail')->insert($groupDetail);
            if (empty($flag)) {
                return json(['code' => -3, 'data' => '', 'msg' => '添加群组失败']);
            }

            $return = [
                'avatar' => $param['avatar'],
                'group_name' => $param['group_name'],
                'group_id' => $groupId
            ];

            return json(['code' => 1, 'data' => $return, 'msg' => '创建群组 成功']);
        }
    }
}