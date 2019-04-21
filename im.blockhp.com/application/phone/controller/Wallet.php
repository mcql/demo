<?php
// +----------------------------------------------------------------------
// | ichat-tp.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\phone\controller;

use think\Request;
use \app\phone\controller\Bitcoin;

class Wallet extends Base
{

    //个人信息
    public function index()
    {
        $allCoinLst = db('chatuser')->where(['id'=>cookie('phone_user_id')])->field('eth_lst,bhp_lst,usdt_lst,btc_lst,eth_public_key,bhp_public_key,usdt_public_key,btc_public_key,btc_public_key')->find();

        //获取交易转入记录
        $this->getEth();
        $this->getBtc();
        $this->getBhp();
        $this->getUsdt();

        //判断是否已经生成钱包地址
        if(!$allCoinLst['eth_public_key'])
        {
            return $this->redirect('selfPackage');
        }

        //btc生成地址
        $btcConfig = config('btcConfig');
        //require_once('Bitcoin.php');
        $bitcoin = new Bitcoin($btcConfig['username'],$btcConfig['password'],$btcConfig['ip'],$btcConfig['port']);

        //判断是否已经生成钱包地址
        if(!$allCoinLst['btc_public_key'])
        {
            $btcAddress = $bitcoin->getnewaddress(session('registerUsername'));
            //导出钱包私钥
            $btcPrivateKey = $bitcoin->dumpprivkey($btcAddress);

            //保存
            $walletData['btc_public_key'] = $btcAddress; //btc
            $walletData['btc_private_key'] = $btcPrivateKey;

            db('chatuser')->where(['id'=>cookie('phone_user_id')])->update($walletData);
            $allCoinLst = db('chatuser')->where(['id'=>cookie('phone_user_id')])->field('eth_lst,bhp_lst,usdt_lst,btc_lst,eth_public_key,bhp_public_key,usdt_public_key,btc_public_key,btc_public_key')->find();
        }

        //获取btc地址余额
        $url='https://chain.api.btc.com/v3/address/' . $allCoinLst['btc_public_key'];
        $html = file_get_contents($url);
        $result = json_decode($html);
        if($result->data == null)
        {
            $allCoinLst['btc_lst'] = 0;
        } else {
            $allCoinLst['btc_lst'] = $result->data->balance / 100000000;
        }

        //聊天用户
        $userInfo = [
            'id' => cookie('phone_user_id'),
            'username' => cookie('phone_user_name'),
            'avatar' => cookie('phone_user_avatar'),
            'usdtLst' => $allCoinLst['usdt_lst'],
            'bhpLst' => $allCoinLst['bhp_lst'],
            'ethLst' => $allCoinLst['eth_lst'],
            'btcLst' => $allCoinLst['btc_lst'],
            'usdtAddress' => $allCoinLst['usdt_public_key'],
            'bhpAddress' => $allCoinLst['bhp_public_key'],
            'ethAddress' => $allCoinLst['eth_public_key'],
            'btcAddress' => $allCoinLst['btc_public_key'],
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
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField($coin . '_public_key');

        $userId = cookie('phone_user_id');
        $wh['out_u_id'] = $userId;
        $wh['coin_type'] = $coin;

        //获取btc地址余额
        if($coin == 'btc')
        {
            $url='https://chain.api.btc.com/v3/address/' . $coinAddress;
            $html = file_get_contents($url);
            $result = json_decode($html);
            if($result->data == null)
            {
                $btcLst = 0;
            } else {
                $btcLst = $result->data->balance / 100000000;
            }
            $this->assign('btcLst',$btcLst);
        }

        //历史转账记录
        //分页
        $list = db('turn_out_log')->where($wh)->order('create_time desc')->paginate(6, false, [
            'query' => Request::instance()->param()]);

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

    //转商城
    public function toShop()
    {
        if(Request::instance()->isPost()) {
            $sellInfo = Request::instance()->post();
            //验证
            if($sellInfo['paypwd'] == '')
            {
                return $result = ['status'=>100,'msg'=>'参数异常，请重新提交！'];
            }

            //密码
            $paypwd = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('wallet_password');
            if($paypwd != md5($sellInfo['paypwd']))
            {
                return $result = ['status'=>100,'msg'=>'支付密码错误，请重新输入！'];
            }

            return $result = ['status'=>200,'msg'=>'支付密码正确！'];
        }

        //判定是否已经生成该币种账户
        $coinInfo = db('chatuser')->where(['id'=>cookie('phone_user_id')])->field('bhp_public_key,bhp_private_key')->find();

        //平台bhp地址
        $adminBhpAddress = db('config')->where(['name'=>'shop_address'])->value('value');

        $this->assign([
            'coiName' => 'bhp',
            'coinAddress' => $coinInfo['bhp_public_key'], //地址
            'coinPrivatekey' => $coinInfo['bhp_private_key'], //私钥
            'adminBhpAddress' => $adminBhpAddress,
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
            $paypwd = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('wallet_password');
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

    //冲商城
    public function toShopHash()
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
            $withdrawData['type'] = 2; //转商城
            $withdrawData['coin_type'] = $withdrawInfo['coin_type']; //币种类型

            //转账记录
            $res = db('turn_out_log')->insert($withdrawData);

            //增加余额
            $res2 = db('users')->where(['user_id'=>cookie('phone_user_id')])->setInc('user_money',$withdrawInfo['swx']);

            //添加商城记录
            $accountLog = array();
            $accountLog['user_id'] = cookie('phone_user_id');
            $accountLog['user_money'] = '+'.$withdrawInfo['swx'];
            $accountLog['change_time'] = time();
            $accountLog['desc'] = '钱包转商城';
            $accountLog['order_sn'] = '';
            $accountLog['order_id'] = '';
            $res3 = db('account_log')->insert($accountLog);

            if($res && $res2 && $res3)
            {
                return $result = ['status'=>200,'msg'=>'转商城成功！'];
            }
            return $result = ['status'=>100,'msg'=>'转商城失败！'];
        }
    }

    //btc提币
    public function withdrawBtc()
    {
        if(Request::instance()->isPost())
        {
            $withdrawInfo = Request::instance()->post();
            if($withdrawInfo['from'] == '' || (float)$withdrawInfo['swx'] <= 0 || $withdrawInfo['to'] == '')
            {
                return $result = ['status'=>100,'msg'=>'参数异常，请重新操作！'];
            }

            //验证地址是否是比特币
            //btc生成地址
            $btcConfig = config('btcConfig');
            $bitcoin = new Bitcoin($btcConfig['username'],$btcConfig['password'],$btcConfig['ip'],$btcConfig['port']);
            $validateRes = $bitcoin->validateaddress($withdrawInfo['to']);
            if($validateRes['isvalid'] == true)
            {
                //查看平台账户余额是否充足
                $adminLst = $bitcoin->getbalance();

                $url='https://chain.api.btc.com/v3/address/' . $withdrawInfo['from'];
                $html = file_get_contents($url);
                $result = json_decode($html);
                if($result->data == null)
                {
                    $btcLst = 0;
                } else {
                    $btcLst = $result->data->balance / 100000000;
                }

                //防止交易时加手续费不够,加0.1做判断
                if($adminLst - 0.0001 >= $withdrawInfo['swx'] && $btcLst - 0.0001 >= $withdrawInfo['swx'])
                {
                    $txid = $bitcoin->sendtoaddress($withdrawInfo['to'],(float)$withdrawInfo['swx']); //进行转账****

                    //交易失败
                    if(!$txid || $txid == '' || $txid == null || $txid == false)
                    {
                        return $result = ['status'=>100,'msg'=>'提币失败，请联系管理员!'];
                    } else { //转账成功

                        $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                        $withdrawData['out_u_ads'] = $withdrawInfo['to']; //对方地址
                        $withdrawData['self_address'] = $withdrawInfo['from']; //我方地址
                        $withdrawData['num'] = $withdrawInfo['swx']; //提币数量
                        $withdrawData['tx_hash'] = $txid; //交易hash
                        $withdrawData['create_time'] = time(); //提币时间
                        $withdrawData['status'] = 2; //成功
                        $withdrawData['type'] = 1; //转出
                        $withdrawData['coin_type'] = 'btc'; //币种类型
                        //插入记录
                        if(db('turn_out_log')->insert($withdrawData))
                        {
                            //提币成功
                            return $result = ['status'=>200,'msg'=>'提币成功，区块链在正确中，请稍后查看提币状态!'];
                        }
                        //提币失败
                        return $result = ['status'=>100,'msg'=>'提币失败，请联系管理员!'];
                    }
                }
                return $result = ['status'=>100,'msg'=>'用户btc钱包余额不足'];
            } else {
                return $result = ['status'=>100,'msg'=>'btc钱包地址不正确，请重新输入!'];
            }
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

            //btc生成地址
            $btcConfig = config('btcConfig');
            //require_once('Bitcoin.php');
            $bitcoin = new Bitcoin($btcConfig['username'],$btcConfig['password'],$btcConfig['ip'],$btcConfig['port']);
            $btcAddress = $bitcoin->getnewaddress(session('registerUsername'));
            //导出钱包私钥
            $btcPrivateKey = $bitcoin->dumpprivkey($btcAddress);

            //保存
            $walletData['wallet_name'] = $walletInfo['package'];
            $walletData['wallet_password'] = md5($walletInfo['surepaypassword']);
            $walletData['bhp_public_key'] = $walletInfo['address']; //bhp
            $walletData['bhp_private_key'] = $walletInfo['private'];
            $walletData['eth_public_key'] = $walletInfo['address']; //eth
            $walletData['eth_private_key'] = $walletInfo['private'];
            $walletData['usdt_public_key'] = $walletInfo['address']; //usdt
            $walletData['usdt_private_key'] = $walletInfo['private'];
            $walletData['btc_public_key'] = $btcAddress; //btc
            $walletData['btc_private_key'] = $btcPrivateKey;

            $res = db('chatuser')->where(['id'=>cookie('phone_user_id')])->update($walletData);
            if($res)
            {
                return $result = ['status'=>200,'msg'=>'创建钱包成功！'];
            }else
            {
                return $result = ['status'=>100,'msg'=>'创建钱包失败！'];
            }

        }

        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('eth_public_key');

        $openStatus = 1; //默认已生成
        if(!$coinAddress)
        {
            $openStatus = 0; //未生成
        }

        $nowCoinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField($coin . '_public_key');

        $this->assign([
            'nowCoinAddress' => $nowCoinAddress,
            'openStatus' => $openStatus,
        ]);

        return $this->fetch();
    }

    //eth记录
    public function getEth()
    {
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('eth_public_key');

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
                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = $v['from']; //对方地址
                    $withdrawData['self_address'] = $v['to']; //我方地址
                    $withdrawData['num'] = $v['value'] / 1000000000000000000; //提币数量
                    $withdrawData['tx_hash'] = $v['hash']; //交易hash
                    $withdrawData['create_time'] = $v['timeStamp']; //提币时间
                    $withdrawData['status'] = 2; //成功
                    $withdrawData['type'] = 0; //转入
                    $withdrawData['coin_type'] = 'eth'; //币种类型

                   db('turn_out_log')->insert($withdrawData);

                }
            }
        }
    }

    //btc记录
    public function getBtc()
    {
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('btc_public_key');
        $btcConfig = config('btcConfig');
        $bitcoin = new Bitcoin($btcConfig['username'],$btcConfig['password'],$btcConfig['ip'],$btcConfig['port']);

        $txData = $bitcoin->listtransactions(); //近期所有交易记录

        for($b = 0;$b < count($txData);$b++) //循环记录
        {
            //充币记录
            if($txData[$b]['address'] == $coinAddress && $txData[$b]['category'] == 'receive' && $txData[$b]['blockhash'] != '') //判断是当前用户接受的
            {
                if(!db('turn_out_log')->where(['tx_hash'=>$txData[$b]['txid'],'type'=>0])->find())
                {
                    //交易数据入库
                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = ''; //对方地址
                    $withdrawData['self_address'] = $txData[$b]['address']; //我方地址
                    $withdrawData['num'] = $txData[$b]['amount']; //提币数量
                    $withdrawData['tx_hash'] = $txData[$b]['txid']; //交易hash
                    $withdrawData['create_time'] = time(); //提币时间
                    $withdrawData['status'] = 2; //成功
                    $withdrawData['type'] = 0; //转入
                    $withdrawData['coin_type'] = 'btc'; //币种类型

                    db('turn_out_log')->insert($withdrawData);
                }
            }
        }

    }

    //usdt记录
    public function getUsdt()
    {
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('usdt_public_key');
        $url = "http://api.etherscan.io/api?module=account&action=tokentx&address=".$coinAddress."&startblock=0&endblock=99999999&sort=asc&apikey=H4R65KDWH86I2T8CD8R4ZU5TCXBAX8M7PR";

        $resUrl = requestGet($url);

        $res = json_decode($resUrl,true);

        if($res['status'] == 1 && !empty($res['result']))
        {

            foreach ($res['result'] as $k => $v)
            {

                if($v['value'] / 1000000 > 0 && $v['to'] == strtolower($coinAddress) && !db('turn_out_log')->where(['tx_hash'=>$v['hash'],'type'=>0])->find() && $v['contractAddress'] == strtolower('0xdac17f958d2ee523a2206206994597c13d831ec7'))
                {

                    //交易数据入库
                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = $v['from']; //对方地址
                    $withdrawData['self_address'] = $v['to']; //我方地址
                    $withdrawData['num'] = $v['value'] / 1000000; //提币数量
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
        $coinAddress = db('chatuser')->where(['id'=>cookie('phone_user_id')])->getField('bhp_public_key');
        $url = "http://api.etherscan.io/api?module=account&action=tokentx&address=".$coinAddress."&startblock=0&endblock=99999999&sort=asc&apikey=H4R65KDWH86I2T8CD8R4ZU5TCXBAX8M7PR";

        $resUrl = requestGet($url);

        $res = json_decode($resUrl,true);

        if($res['status'] == 1 && !empty($res['result']))
        {

            foreach ($res['result'] as $k => $v)
            {
                if($v['value'] / 100000000 > 0 && $v['to'] == strtolower($coinAddress) && !db('turn_out_log')->where(['tx_hash'=>$v['hash'],'type'=>0])->find() && $v['contractAddress'] == strtolower('0xf2cc0b71caaa4338d842729cf1639eb6dc787e89'))
                {
                    //交易数据入库
                    $withdrawData['out_u_id'] = cookie('phone_user_id'); //用户id
                    $withdrawData['out_u_ads'] = $v['from']; //对方地址
                    $withdrawData['self_address'] = $v['to']; //我方地址
                    $withdrawData['num'] = $v['value'] / 100000000; //提币数量
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

