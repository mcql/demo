<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\chatadmin\controller;

class Report extends Base
{
    //举报信息
    public function index()
    {
        $tempSelect = db('report')
            ->field('id,report_uid,report_user,reported_uid,reported_user,report_type,report_detail');

        $userName = input('param.user_name');
        if(!empty($userName)){
            $tempSelect = $tempSelect->where('report_user', $userName);
        }

        $list = $tempSelect->order('addtime desc')->paginate(10);
        $this->assign([
            'list' => $list,
            'uname' => empty($userName) ? '' : $userName,
            'total' => $list->total()
        ]);

        return $this->fetch();
    }

    //查看证据
    public function seeDetail()
    {
        $id = input('id');
        $detail = db('report')->field('content')->where('id', $id)->find();
        if(!empty($detail)){
            $detail = unserialize($detail['content']);
        }

        $this->assign([
            'detail' => $detail
        ]);

        return $this->fetch();
    }
}