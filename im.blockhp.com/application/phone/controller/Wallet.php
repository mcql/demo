<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;

use think\Request;
/*use \app\phone\controller\Bitcoin;*/

class Wallet extends Base
{

    //个人信息
    public function index()
    {
        $allCoinLst = db('chatuser')->where(['id'=>cookie('phone_user_id')])->field('eth_lst,bhp_lst,usdt_lst,eth_public_key,bhp_public_key,usdt_public_key')->find();


        //获取交易转入记录
        $this->getEth();
        $this->getBhp();
        $this->getUsdt();

        //判断是否已经生成钱包地址
        if(!$allCoinLst['eth_public_key'])
        {
            return $this->redirect('selfPackage');
        }
        //聊天用户
        $userInfo = [
            'id' => cookie('phone_user_id'),
            'username' => cookie('phone_user_name'),
            'avatar' => cookie('phone_user_avatar'),
            'usdtLst' => $allCoinLst['usdt_lst'],
            'bhpLst' => $allCoinLst['bhp_lst'],
            'ethLst' => $allCoinLst['eth_lst'],
            'usdtAddress' => $allCoinLst['usdt_public_key'],
            'bhpAddress' => $allCoinLst['bhp_public_key'],
            'ethAddress' => $allCoinLst['eth_public_key'],
        ];

        $this->assign([
            'userInfo' => $userInfo
        ]);

        return $this->fetch();
    }

    //具体币种
    public function CoinShow($coin='eth')
    {

        //判定是否已经生成该币种账户
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value($coin . '_public_key');

        $userId = cookie('phone_user_id');
        $wh['out_u_id'] = $userId;
        $wh['coin_type'] = $coin;
        //历史转账记录
        //分页
        $list = db('turn_out_log')->where($wh)->order('create_time desc')->paginate(6);
        // 获取分页显示
        $page = $list->render();

        $this->assign([
            'coiName' => $coin,
            'coinAddress' =>$coinAddress,
            'list'=> $list,
            'page'=> $page,
        ]);

        return $this->fetch();
    }

    //转账
    public function trade($coin='eth')
    {
        if(Request::instance()->isPost()) {
            $sellInfo = Request::instance()->post();
            //验证
            if($sellInfo['paypwd'] == '')
            {
                return $result = ['status'=>100,'msg'=>'参数异常，请重新提交！'];
            }

            //密码
            $paypwd = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value('wallet_password');
            if($paypwd != md5($sellInfo['paypwd']))
            {
                return $result = ['status'=>100,'msg'=>'支付密码错误，请重新输入！'];
            }

            return $result = ['status'=>200,'msg'=>'支付密码正确！'];
        }

        //判定是否已经生成该币种账户
        $coinInfo = db('chatuser')->where(['id'=>cookie('phone_user_id')])->field($coin . '_public_key,'.$coin .'_private_key')->find();

        $this->assign([
            'coiName' => $coin,
            'coinAddress' => $coinInfo[$coin . '_public_key'], //地址
            'coinPrivatekey' => $coinInfo[$coin . '_private_key'], //私钥
        ]);
        return $this->fetch();
    }

    //提币
    public function withdrawHash()
    {
        if(Request::instance()->isPost())
        {
            $withdrawInfo = Request::instance()->post();
            $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
            $withdrawData['out_u_ads'] = $withdrawInfo['address']; //对方地址
            $withdrawData['self_address'] = $withdrawInfo['from']; //我方地址
            $withdrawData['num'] = $withdrawInfo['swx']; //提币数量
            $withdrawData['tx_hash'] = $withdrawInfo['txhash']; //交易hash
            $withdrawData['create_time'] = time(); //提币时间
            $withdrawData['status'] = 2; //成功
            $withdrawData['type'] = 1; //转出
            $withdrawData['coin_type'] = $withdrawInfo['coin_type']; //币种类型

            $res = db('turn_out_log')->insert($withdrawData);
            if($res)
            {
                return $result = ['status'=>200,'msg'=>'转币成功！'];
            }
            return $result = ['status'=>100,'msg'=>'转币失败！'];
        }
    }

    //我的地址
    public function selfPackage($coin='eth')
    {

        if(request()->isAjax()) {
            $walletInfo = Request::instance()->post();

            if($walletInfo['package'] == '' || $walletInfo['paypassword'] == '' || $walletInfo['surepaypassword'] == '' || $walletInfo['private'] == '' || $walletInfo['address'] == '')
            {
                return $result = ['status'=>100,'msg'=>'请填写钱包信息完整！'];
            }

            if($walletInfo['paypassword'] != $walletInfo['surepaypassword'])
            {
                return $result = ['status'=>100,'msg'=>'两次密码不一致!'];
            }

            //保存
            $walletData['wallet_name'] = $walletInfo['package'];
            $walletData['wallet_password'] = md5($walletInfo['surepaypassword']);
            $walletData['bhp_public_key'] = $walletInfo['address']; //bhp
            $walletData['bhp_private_key'] = $walletInfo['private'];
            $walletData['eth_public_key'] = $walletInfo['address']; //eth
            $walletData['eth_private_key'] = $walletInfo['private'];
            $walletData['usdt_public_key'] = $walletInfo['address']; //usdt
            $walletData['usdt_private_key'] = $walletInfo['private'];

            $res = db('chatuser')->where(['id'=>cookie('phone_user_id')])->update($walletData);
            if($res)
            {
                return $result = ['status'=>200,'msg'=>'创建钱包成功！'];
            }else
            {
                return $result = ['status'=>100,'msg'=>'创建钱包失败！'];
            }

        }

        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value('eth_public_key');

        $openStatus = 1; //默认已生成
        if(!$coinAddress)
        {
            $openStatus = 0; //未生成
        }

        $nowCoinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value($coin . '_public_key');

        $this->assign([
            'nowCoinAddress' => $nowCoinAddress,
            'openStatus' => $openStatus,
        ]);

        return $this->fetch();
    }

    //eth记录
    public function getEth()
    {
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value('eth_public_key');
        $url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$coinAddress."&startblock=0&endblock=99999999&sort=asc&apikey=H4R65KDWH86I2T8CD8R4ZU5TCXBAX8M7PR";

        $resUrl = requestGet($url);

        $res = json_decode($resUrl,true);

        if($res['status'] == 1 && !empty($res['result']))
        {

            foreach ($res['result'] as $k => $v)
            {

                if($v['value'] / 1000000000000000000 > 0 && $v['to'] == strtolower($coinAddress) && !db('turn_out_log')->where(['tx_hash'=>$v['hash']])->find())
                {

                    //交易数据入库
                    $info['userid'] = userid();
                    $info['coinname'] = 'eth';
                    $info['address'] = $v['to'];
                    $info['txid'] = $v['hash'];
                    $info['hash'] = $v['hash'];
                    $info['amount'] = $v['value'] / 1000000000000000000;
                    $info['fee'] = 0;
                    $info['type'] = 0;
                    $info['confirmations'] = 0;
                    $info['create_time'] = $v['timeStamp'];
                    $info['over_time'] = time();
                    $info['status'] = 1;

                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = $v['from']; //对方地址
                    $withdrawData['self_address'] = $v['to']; //我方地址
                    $withdrawData['num'] = $v['value'] / 1000000000000000000; //提币数量
                    $withdrawData['tx_hash'] = $v['hash']; //交易hash
                    $withdrawData['create_time'] = $v['timeStamp']; //提币时间
                    $withdrawData['status'] = 2; //成功
                    $withdrawData['type'] = 0; //转出
                    $withdrawData['coin_type'] = 'eth'; //币种类型

                   db('turn_out_log')->insert($withdrawData);

                }
            }
        }
    }

    //usdt记录
    public function getUsdt()
    {
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value('usdt_public_key');
        $url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$coinAddress."&startblock=0&endblock=99999999&sort=asc&apikey=H4R65KDWH86I2T8CD8R4ZU5TCXBAX8M7PR";

        $resUrl = requestGet($url);

        $res = json_decode($resUrl,true);

        if($res['status'] == 1 && !empty($res['result']))
        {

            foreach ($res['result'] as $k => $v)
            {

                if($v['value'] / 1000000000000000000 > 0 && $v['to'] == strtolower($coinAddress) && !db('turn_out_log')->where(['tx_hash'=>$v['hash']])->find() && $v['contractAddress'] == '0xdac17f958d2ee523a2206206994597c13d831ec7')
                {

                    //交易数据入库
                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = $v['from']; //对方地址
                    $withdrawData['self_address'] = $v['to']; //我方地址
                    $withdrawData['num'] = $v['value'] / 1000000000000000000; //提币数量
                    $withdrawData['tx_hash'] = $v['hash']; //交易hash
                    $withdrawData['create_time'] = $v['timeStamp']; //提币时间
                    $withdrawData['status'] = 2; //成功
                    $withdrawData['type'] = 0; //转入
                    $withdrawData['coin_type'] = 'usdt'; //币种类型

                    db('turn_out_log')->insert($withdrawData);

                }
            }
        }
    }

    //bhp记录
    public function getBhp()
    {
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->value('bhp_public_key');
        $url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$coinAddress."&startblock=0&endblock=99999999&sort=asc&apikey=H4R65KDWH86I2T8CD8R4ZU5TCXBAX8M7PR";

        $resUrl = requestGet($url);

        $res = json_decode($resUrl,true);

        if($res['status'] == 1 && !empty($res['result']))
        {

            foreach ($res['result'] as $k => $v)
            {

                if($v['value'] / 1000000000000000000 > 0 && $v['to'] == strtolower($coinAddress) && !db('turn_out_log')->where(['tx_hash'=>$v['hash']])->find() && $v['contractAddress'] == '0xdac17f958d2ee523a2206206994597c13d831ec7')
                {

                    //交易数据入库
                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = $v['from']; //对方地址
                    $withdrawData['self_address'] = $v['to']; //我方地址
                    $withdrawData['num'] = $v['value'] / 1000000000000000000; //提币数量
                    $withdrawData['tx_hash'] = $v['hash']; //交易hash
                    $withdrawData['create_time'] = $v['timeStamp']; //提币时间
                    $withdrawData['status'] = 2; //成功
                    $withdrawData['type'] = 0; //转入
                    $withdrawData['coin_type'] = 'bhp'; //币种类型

                    db('turn_out_log')->insert($withdrawData);

                }
            }
        }
    }
}

