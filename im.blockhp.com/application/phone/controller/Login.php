<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;
use think\Controller;
use think\Cookie;

class Login extends Controller
{
    //展示登录页面
    public function index()
    {
        return $this->fetch();
    }

    //找回密码
    public function forgetPwd()
    {
        if(request()->isAjax()) {
            echo 11;die;
            $email = input('post.email');
            dump($email);die;
        }
        return $this->fetch();
    }

    //检测邮箱
    //检测是否已注册
    public function loginCheckEmail()
    {
        if(request()->isAjax()) {
            $email = input('post.email');

            if($email == '')
            {
                return json(['code' => -1, 'data' => '', 'msg' => '邮箱不得为空']);
            }

            if(!$mail = db('chatuser')->where(['truename'=>$email])->value('truename'))
            {
                return json(['code' => -1, 'data' => '', 'msg' => '该邮箱不存在，请重新输入!']);
            }

            $random = $this->randomkeys(30);

            if($this->checkEmail($email,$random))
            {
                db('chatuser')->where(['truename'=>$email])->update(['forget_passworld_random'=>$random]);
                return json(['code' => 1, 'data' => '', 'msg' => '邮件发送成功，请注意查收！']);
            }

            return json(['code' => -1, 'data' => '', 'msg' => '邮件发送失败!']);
        }
    }

    //邮箱验证加发送邮件
    public function checkEmail($email,$random)
    {
        $title = '【Mitalk密聊】重置密码！';
        $content = "<a href='http://im.blockhp.com/Phone/Login/reset_password?id=".$random."'>点击此链接重置您的登录密码为 '123456' !</a>";
        return send_email_back($email,$title,$content);
    }

    //邮箱或短信验证码
    function randomkeys($length){
        $pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i=0;$i<$length;$i++)
        {
            $key .= $pattern{mt_rand(0,35)};    //生成php随机数
        }
        return $key;
    }

    //重置密码
    public function reset_password($id)
    {

        if(!$number = db('chatuser')->where(['forget_passworld_random'=>$id])->value('id'))
        {
            $this->redirect('Public/login');
        }

        //修改密码
        $data['pwd'] = md5('123456');
        $data['forget_passworld_random'] = null;
        db('chatuser')->where(['id'=>$number])->update($data);

        return $this->fetch('reset_password');
    }

    //处理登录
    public function doLogin()
    {
        if(request()->isAjax()){

            $userName = input('post.user_name');
            if(empty($userName)){
                return json(['code' => -3, 'data' => '', 'msg' => '用户名不能为空']);
            }

            $pwd = input('post.pwd');
            if(empty($pwd)){
                return json(['code' => -4, 'data' => '', 'msg' => '密码不能为空']);
            }

            $user = db('chatuser')->field('id,user_name,pwd,sign,avatar')
                ->where('truename', $userName)->find();
            if(empty($user)){
                return json(['code' => -1, 'data' => '', 'msg' => '用户不存在']);
            }

            if( md5($pwd) != $user['pwd'] ){
                return json(['code' => -2, 'data' => '', 'msg' => '密码错误']);
            }

            //设置用户登录
            db('chatuser')->where('id', $user['id'])->setField('status', 1);

            //设置session标识状态,此处为聊天软件cookie设置
            cookie('phone_user_name', $user['user_name']);
            cookie('phone_user_id', $user['id']);
            cookie('phone_user_sign', $user['sign']);
            cookie('phone_user_avatar', $user['avatar']);

            //此处为商城cookie设置,调用商城登陆验证方法
            $userModel = new \app\mobile\controller\User();
            $userModel->do_login($userName,$pwd);

            return json(['code' => 1, 'data' => url('index/index'), 'msg' => '登录成功']);
        }

        $this->error('非法访问');
    }

    //展示注册页面
    public function register()
    {
        return $this->fetch();
    }

    //处理注册
    public function doRegister()
    {
        if(request()->isAjax()){

            if(request()->isAjax()){
                $param = input('post.');

                if(empty($param['user_name']) || empty($param['pwd']) || empty($param['age']) || empty($param['truename']))
                {
                    return json(['code' => -1, 'data' => '', 'msg' => '请输入注册信息完整!']);
                }
                $pwd = $param['pwd'];
                //TODO 理论上应该对所有的传入参数做正则校验,此处为了节省时间，暂时未做
                if($param['pwd'] != $param['repwd']){
                    return json(['code' => -1, 'data' => '', 'msg' => '两次密码输入不一致!']);
                }
                $map = array();
                $is_validated = 0 ;
                if(check_email($param['truename'])){
                    $is_validated = 1;
                    $map['email_validated'] = 1;
                    $map['email'] = $param['truename']; //邮箱注册
                    $map['nickname'] = $param['user_name'];
                }

                /*if(check_mobile($param['truename'])){
                    $is_validated = 1;
                    $map['mobile_validated'] = 1;
                    $map['mobile'] = $param['truename']; //手机注册
                    $map['nickname'] = $param['user_name'];
                }*/

                if($is_validated != 1) return json(['code' => -1, 'data' => '', 'msg' => '请用邮箱注册!']);

                $areaStr = '';
                if(!empty($area)){
                    foreach($area as $key=>$vo){
                        $areaStr .= $vo['area_name'] . '-';
                    }
                    $areaStr = rtrim($areaStr, '-');
                }else{
                    $areaStr = '北京-北京市-东城区';
                }
                unset($area);

                $insertData = [
                    'user_name' => trim($param['user_name']),
                    'truename' => trim($param['truename']),
                    'pwd' => md5($param['pwd']),
                    'sign' => '暂无',
                    'avatar' => config('avatar'),
                    'sex' => $param['sex'],
                    'age' => $param['age'],
                    'status' => 0
                ];

                //判断是否已有用户名
                if(db('chatuser')->where(['user_name'=>trim($param['user_name'])])->find())
                {
                    return json(['code' => -1, 'data' => '', 'msg' => '该昵称已注册，请重新输入用户名!']);
                }
                if(db('chatuser')->where(['truename'=>trim($param['truename'])])->find())
                {
                    return json(['code' => -1, 'data' => '', 'msg' => '该邮箱已注册，请重新输入用户名!']);
                }
                unset($param);

                $userId = db('chatuser')->insertGetId($insertData);
                //商城用户表中同样注入用户信息
                $map['user_id'] = $userId; //保证两张表用户id一致
                $map['password'] = encrypt($pwd);
                $map['reg_time'] = time();
                $map['first_leader'] = 0; // 推荐人id，默认为0
                // 如果找到他老爸还要找他爷爷他祖父等
                if($map['first_leader'])
                {
                    $first_leader = M('users')->where("user_id = {$map['first_leader']}")->find();
                    $map['second_leader'] = $first_leader['first_leader'];
                    $map['third_leader'] = $first_leader['second_leader'];
                }else
                {
                    $map['first_leader'] = 0;
                }

                // 成为分销商条件
                //$distribut_condition = tpCache('distribut.condition');
                //if($distribut_condition == 0)  // 直接成为分销商, 每个人都可以做分销
                $map['is_distribut']  = 1; // 默认每个人都可以成为分销商

                $user_id = M('users')->add($map);
                if(!$user_id)
                    return array('status'=>-1,'msg'=>'注册失败','result'=>'');

                $pay_points = tpCache('basic.reg_integral'); // 会员注册赠送积分
                if($pay_points > 0) accountLog($user_id, 0,$pay_points, '会员注册赠送积分'); // 记录日志流水
                $user = M('users')->where("user_id = {$user_id}")->find();
                // 会员注册送优惠券
                $coupon = M('coupon')->where("send_end_time > ".time()." and ((createnum - send_num) > 0 or createnum = 0) and type = 2")->select();
                if(!empty($coupon)){
                    foreach ($coupon as $key => $val)
                    {
                        M('coupon_list')->add(array('cid'=>$val['id'],'type'=>$val['type'],'uid'=>$user_id,'send_time'=>time()));
                        M('Coupon')->where("id = {$val['id']}")->setInc('send_num'); // 优惠券领取数量加一
                    }
                }

                return json(['code' => '1', 'data' => url('login/index'), 'msg' => '注册成功']);
            }

            $this->error('非法访问');
        }
    }

    //退出登录
    public function logout()
    {
        cookie(null, 'think_');
        setcookie('cn', '', time() - 3600, '/');
        setcookie('user_id', '', time() - 3600, '/');
        cookie('phone_user_name',null);
        cookie('phone_user_id', null);
        cookie('phone_user_sign', null);
        cookie('phone_user_avatar', null);
        $userModel = new \app\mobile\controller\User();
        $userModel->logout();
        return true;
    }
}