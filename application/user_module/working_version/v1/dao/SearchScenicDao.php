<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SearchScenicDao.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  用户端景区数据层
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\dao;
use app\user_module\working_version\v1\model\ScenicModel;
use app\user_module\working_version\v1\model\ScenicCommentModel;
use app\user_module\working_version\v1\model\ScenicImagesModel;

class SearchScenicDao
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : searchScenicSelect()
     * 功  能 : 模糊搜索景区数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function searchScenicSelect($get)
    {
        // SearchScenicModel 模型
        $scenic = new ScenicModel();
        //模糊查询
        $res = $scenic->where('scenic_name','like',$get['scenic_name'].'%')
                ->field('scenic_name')
                ->select()
                ->toArray();
        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : accurateScenicSelect()
     * 功  能 : 精准搜索景区数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function accurateScenicSelect($get)
    {
        // SearchScenicModel 模型
        $scenic = new ScenicModel();
        //模糊查询
        $res = $scenic->where('scenic_name',$get['scenic_name'])
                    ->where('scenic_status',1)
                    ->find();
        if (!$res){
            return returnData('error','没有搜索到结果');
        }
        //查询热度
        $comment = new ScenicCommentModel();
        $heatSum = $comment->where('scenic_id',$res['scenic_id'])
                    ->field("avg(`comment_service`) as `service`,
                                   avg(`comment_health`) as `health`,
                                   avg(`comment_view`) as `view`,
                                   avg(`comment_cosy`) as `cosy`")
                   ->find()->toArray();
        //计算热度值
        $heat = round(array_sum($heatSum)/count($heatSum));
        $res['heat'] = $heat;
        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicInfoSelect()
     * 功  能 : 获取景区详细数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicInfoSelect($get)
    {
        //创建景区模型
        $scenic = ScenicModel::get($get['scenic_id']);
        //联查景区优惠券
        $res =  $scenic->coupon()->where(['apply_status' => 1,
                                           'coupon_status' => 1])
                                ->select()->toArray();
        $scenic['coupon'] = $res;
        return \RSD::wxReponse($scenic,'M',$scenic,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCarouselSelect()
     * 功  能 : 获取景区轮播信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCarouselSelect($get)
    {
        //创建模型
        $images = new ScenicImagesModel();
        //查询
        $res = $images->where('scenic_id',$get['scenic_id'])
                        ->order('images_sort','asc')
                        ->select()
                        ->toArray();
        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
}