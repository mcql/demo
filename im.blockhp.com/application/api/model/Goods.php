<?php
/**
 * tpshop
 * 商品模型
 * @auther：dyr
 */
namespace app\api\model;

use think\Model;
use think\Db;

class Goods extends Model
{
    private $model;
    private $db_prefix;
    public function _initialize()
    {
        $this->db_prefix = C('database.prefix');
        parent::_initialize();
    }

    /**
     * 获取促销商品数据
     * @return mixed
     */
    public function getPromotionGoods()
    {
        $goods_where = array('g.goods_state' => 1, 'g.is_on_sale' => 1 );
        $goods_where['g.goods_name'] = array("exp", " NOT REGEXP '华为|荣耀|小米|合约机|三星|魅族' ");//临时屏蔽,苹果APP审核过了之后注释
        $promotion_goods = Db::name('goods')->alias('g')
            ->field('g.goods_id,g.goods_name,f.price AS shop_price,f.end_time')
            ->join($this->db_prefix . 'flash_sale f ','g.goods_id = f.goods_id')
            ->where($goods_where)
            ->limit(3)
            ->select();
        return $promotion_goods;
    }

    /**
     * 获取精品商品数据
     * @return mixed
     */
    public function getHighQualityGoods()
    {
        $goods_where = array('is_recommend' => 1, 'goods_state' => 1, 'is_on_sale' => 1);
        $goods_where['goods_name'] = array("exp", " NOT REGEXP '华为|荣耀|小米|合约机|三星|魅族' ");//临时屏蔽,苹果APP审核过了之后注释
        $orderBy = array('sort' => 'desc');
        $promotion_goods = M('goods')
            ->field('goods_id,goods_name,shop_price')
            ->where($goods_where)
            ->order($orderBy)
            ->limit(9)
            ->select();
        return $promotion_goods;
    }

    /**
     * 获取新品商品数据
     * @return mixed
     */
    public function getNewGoods()
    {
        $goods_where = array('is_new' => 1, 'goods_state' => 1, 'is_on_sale' => 1);
        $goods_where['goods_name'] = array("exp", " NOT REGEXP '华为|荣耀|小米|合约机|三星|魅族' ");//临时屏蔽,苹果APP审核过了之后注释
        $orderBy = array('sort' => 'desc');
        $new_goods = M('goods')
            ->field('goods_id,goods_name,shop_price')
            ->where($goods_where)
            ->order($orderBy)
            ->limit(9)
            ->select();
        return $new_goods;
    }

    /**
     * 获取热销商品数据
     * @return mixed
     */
    public function getHotGood()
    {
        $goods_where = array('is_hot' => 1, 'goods_state' => 1, 'is_on_sale' => 1, 'cat_id1'=>4);
        $goods_where['goods_name'] = array("exp", " NOT REGEXP '华为|荣耀|小米|合约机|三星' ");//临时屏蔽,苹果APP审核过了之后注释
        $orderBy = array('sort' => 'desc');
        $new_goods = M('goods')
            ->field('goods_id,goods_name,shop_price')
            ->where($goods_where)
            ->order($orderBy)
            ->limit(9)
            ->select();
        return $new_goods;
    }

    /**
     * 获取首页轮播图片
     * @return mixed
     */
    public function getHomeAdv()
    {
        $adv = M('ad')->where('pid = 2')->field(array('ad_link','ad_name','ad_code'))->cache(true,TPSHOP_CACHE_TIME)->select();
        //广告地址转换
        foreach($adv as $k=>$v){
            if(!strstr($v['ad_link'],'http')){
                $adv[$k]['ad_link'] = SITE_URL.$v['ad_link'];
            }
            $adv[$k]['ad_code'] = SITE_URL.$v['ad_code'];
        }
        return $adv;
    }
}