<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: JY
 * Date: 2015-09-23
 */

namespace app\home\controller;

use app\home\logic\UsersLogic;

use think\Session;
use think\Controller;
use think\Verify;
use think\Db;

class Api extends Controller
{

    public $send_scene;

    public function _initialize()
    {
        Session::start();
    }

    /*
     * 获取地区
     */
    public function getRegion()
    {
        $parent_id = I('get.parent_id/d');
        $selected = I('get.selected', 0);
        $data = M('region')->where("parent_id", $parent_id)->select();
        $html = '';
        if ($data) {
            foreach ($data as $h) {
                if ($h['id'] == $selected) {
                    $html .= "<option value='{$h['id']}' selected>{$h['name']}</option>";
                }
                $html .= "<option value='{$h['id']}'>{$h['name']}</option>";
            }
        }
        echo $html;
    }


    public function getTwon()
    {
        $parent_id = I('get.parent_id/d');
        $data = M('region')->where("parent_id", $parent_id)->select();
        $html = '';
        if ($data) {
            foreach ($data as $h) {
                $html .= "<option value='{$h['id']}'>{$h['name']}</option>";
            }
        }
        if (empty($html)) {
            echo '0';
        } else {
            echo $html;
        }
    }

    public function getProvince()
    {
        $province = M('region')->field('id,name')->where(array('level' => 1))->select();
        foreach ($province as $key => $val) {
            $province[$key]['city'] = M('region')->field('id,name')->where(array('parent_id' => $province[$key]['id']))->cache(true)->select();
        }
        $res = array('status' => 1, 'msg' => '获取成功', 'result' => $province);
        exit(json_encode($res));
    }

    public function getArea()
    {
        $id = I('id/d');
        if ($id) {
            $area = M('region')->field('id,name,parent_id as pid')->where(array('parent_id' => $id))->cache(true)->select();
            $res = array('status' => 1, 'msg' => '获取成功', 'result' => $area);
        } else {
            $res = array('status' => 0, 'msg' => '获取失败,参数有误', 'result' => '');
        }
        exit(json_encode($res));
    }

    /*
     * 获取商品分类
     */
    public function get_category()
    {
        $parent_id = I('get.parent_id/d', '0'); // 商品分类 父id
        empty($parent_id) && exit('');
        $list = M('goods_category')->where(array('parent_id' => $parent_id))->select();
        foreach ($list as $k => $v) {
            $html .= "<option value='{$v['id']}' rel='{$v['commission']}'>{$v['name']}</option>";
        }
        exit($html);
    }

    public function get_cates()
    {
        $parent_id = I('get.parent_id/d', '0'); // 商品分类 父id
        empty($parent_id) && exit('');
        $list = M('goods_category')->where(array('parent_id' => $parent_id))->select();
        foreach ($list as $k => $v) {
            $html .= "<input type='checkbox' name='subcate[]' rel='{$v['commission']}' data-name='{$v['name']}' value='{$v['id']}'>" . $v['name'];
        }
        exit($html);
    }

    /*
     * 获取店铺内分类
     */
    public function get_store_category()
    {
        // 店铺id
        $store_id = session('store_id');
        $store_id = $store_id ? $store_id : 0;
        $parent_id = I('get.parent_id/d', 0); // 商品分类 父id

        ($parent_id == 0) && exit('');

        $list = M('store_goods_class')->where(['parent_id' => $parent_id, 'store_id' => $store_id])->select();
        foreach ($list as $k => $v)
            $html .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>";
        exit($html);
    }


    /**
     * 前端发送短信方法: APP/WAP/PC 共用发送方法
     */
    public function send_validate_code()
    { 

        $this->send_scene = C('SEND_SCENE');

        $type = I('type');
        $scene = I('scene');    //发送短信验证码使用场景
        $mobile = I('mobile');
        $sender = I('send');
        $verify_code = I('verify_code');
        $mobile = !empty($mobile) ? $mobile : $sender;
        $session_id = I('unique_id', session_id());

        //注册
        if ($scene == 1 && !empty($verify_code)) {
            $verify = new Verify();
            if (!$verify->check($verify_code, 'user_reg')) {
                $res = array('status'=>-1,'msg'=>'图像验证码错误');
                ajaxReturn($res);
            }
        }
        if ($type == 'email') {
            //发送邮件验证码
            $logic = new UsersLogic();
            $res = $logic->send_email_code($sender);
            exit(json_encode($res));
        } else {
            //发送短信验证码
            $res = checkEnableSendSms($scene);
            if ($res['status'] != 1) {
                //print_r($res);
                ajaxReturn($res);
            }

            //判断是否存在验证码
            $data = M('sms_log')->where(array('mobile' => $mobile, 'session_id' => $session_id , 'status'=>1))->order('id DESC')->find();
            //获取时间配置
            $sms_time_out = tpCache('sms.sms_time_out');
            $sms_time_out = $sms_time_out ? $sms_time_out : 120;
            //120秒以内不可重复发送
            if ($data && (time() - $data['add_time']) < $sms_time_out) {
                ajaxReturn(array('status' => -1, 'msg' => $sms_time_out . '秒内不允许重复发送'));
            }
            //随机一个验证码
            $code = rand(1000, 9999);

            $user = session('user');
            if ($scene == 6) {

                if (!$user['user_id']) {
                    //登录超时
                    ajaxReturn(array('status' => -1, 'msg' => '登录超时'));
                }
                $params = array('code' => $code);

                if ($user['nickname']) {
                    $params['user_name'] = $user['nickname'];
                }
            }
            $params['code'] = $code;

            //发送短信
            $resp = sendSms($scene, $mobile, $params);

            if ($resp['status'] == 1) {
                //发送成功, 修改发送状态位成功
                ajaxReturn(array('status' => 1, 'msg' => '发送成功,请注意查收'));
            } else {
                ajaxReturn(array('status' => -1, 'msg' => '发送失败' . $resp['msg']));
            }
        }
    }

    /**
     * 验证短信验证码: APP/WAP/PC 共用发送方法
     */
    public function check_validate_code()
    {
        $code = I('post.code');
        $mobile = I('mobile');
        $send = I('send');
        $sender = empty($mobile) ? $send : $mobile;
        $type = I('type');
        $session_id = I('unique_id', session_id());
        $scene = I('scene', -1);

        $logic = new UsersLogic();
        $res = $logic->check_validate_code($code, $sender, $type ,$session_id, $scene);
        ajaxReturn($res);
    }

    /**
     * 检测手机号是否已经存在
     */
    public function issetMobile()
    {
        $mobile = I("mobile", '0');
        $users = M('users')->where("mobile", $mobile)->find();
        if ($users)
            exit ('1');
        else
            exit ('0');
    }


    /**
     * 检测邮件是否已经存在
     */
    public function issetEmail()
    {
        $mobile = I("email", '0');
        $users = M('users')->where("email", $mobile)->find();
        if ($users)
            exit ('1');
        else
            exit ('0');
    }

    /**
     * 查询物流
     */
    public function queryExpress()
    {
        $shipping_code = I('shipping_code');
        $invoice_no = I('invoice_no');
        if (empty($shipping_code) || empty($invoice_no)) {
            exit(json_encode(array('status' => 0, 'message' => '参数有误', 'result')));
        }
        $express = queryExpress($shipping_code, $invoice_no);
        exit($express);
    }

    /**
     * 检查订单状态
     */
    public function check_order_pay_status()
    {
        $master_order_id = I('master_order_id/d');
        $order_id = I('order_id/d');

        if (empty($master_order_id) && empty($order_id)) {
            $res = array('message' => '参数错误', 'status' => -1, 'result' => '');
            exit(json_encode($res));
        }

        if (!empty($master_order_id)) {
            $order = M('order')->field('pay_status')->where(array('master_order_sn' => $master_order_id))->find();
            if ($order['pay_status'] != 0) {
                $res = array('message' => '已支付', 'status' => 1, 'result' => $order);
            } else {
                $res = array('message' => '未支付', 'status' => 0, 'result' => $order);
            }
            exit(json_encode($res));
        }
        if (!empty($order_id)) {
            $order = M('order')->field('pay_status')->where(array('order_id' => $order_id))->find();
            if ($order['pay_status'] != 0) {
                $res = array('message' => '已支付', 'status' => 1, 'result' => $order);
            } else {
                $res = array('message' => '未支付', 'status' => 0, 'result' => $order);
            }
            exit(json_encode($res));
        }
    }

    /**
     * 广告位js
     */
    public function ad_show()
    {
        $pid = I('pid/d', 1);
        $limit = I('limit/d', 1);
        $where = array(
            'pid' => $pid,
            'enabled' => 1,
            'start_time' => array('lt', strtotime(date('Y-m-d H:00:00'))),
            'end_time' => array('gt', strtotime(date('Y-m-d H:00:00'))),
        );
        $ad = Db::name("ad")->where($where)->order("orderby desc")->limit($limit)->select();
        $this->assign('ad', $ad);
        return $this->fetch();
    }
}