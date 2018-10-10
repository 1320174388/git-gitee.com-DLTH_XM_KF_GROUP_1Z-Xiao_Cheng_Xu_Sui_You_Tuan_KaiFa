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
use app\user_module\working_version\v1\model\GroupMemberModel;
use app\user_module\working_version\v1\model\ScenicModel;
use app\user_module\working_version\v1\model\ScenicCommentModel;
use app\user_module\working_version\v1\model\ScenicImagesModel;
use app\user_module\working_version\v1\model\ScenicServiceModel;

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
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicLinkmanSelect()
     * 功  能 : 获取景区客服人员信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicLinkmanSelect($get)
    {
        //创建模型
        $opject = new ScenicServiceModel();
        //执行查询
        $res = $opject->where('scenic_id',$get['scenic_id'])
                ->select()
                ->toArray();
        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCommentSelect()
     * 功  能 : 获取景区评论列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  入 : '$get['page_num']  => '分页数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCommentSelect($get)
    {
        //联查用户表
        $res = ScenicCommentModel::field(
            config('v1_tableName.scenicComment').'.comment_service,
                                comment_health,
                                comment_view,
                                comment_cosy,
                                comment_content,
                                comment_time,'.
            config('v1_tableName.usersList').'.user_nickName,
                                user_gender,
                                user_avatarUrl,
                                user_gender'
            )
            ->leftJoin(
            config('v1_tableName.usersList'),
            config('v1_tableName.scenicComment').'.user_token = '.
            config('v1_tableName.usersList').'.user_token')
            ->where(config('v1_tableName.scenicComment').'.scenic_id',$get['scenic_id'])
            ->order('comment_id','asc')
            ->limit($get['page_num'],12)
            ->select()
            ->toArray();

        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCommentDao()
     * 功  能 : 景区评论接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['group_number']  => '订单号';'
     * 输  入 : '$post['comment_service']  => '服务星级';'
     * 输  入 : '$post['comment_health']  => '卫生星级';'
     * 输  入 : '$post['comment_view']  => '景观星级';'
     * 输  入 : '$post['comment_cosy']  => '舒适度星级';'
     * 输  入 : '$post['comment_content']  => '评论内容';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCommentDao($post)
    {
        //开启事务
        \think\Db::startTrans();
        // 创建评论模型
        $comment = new ScenicCommentModel($post);
        // 插入评论表
        $comment->allowField(true)->save();

            // 更改评论状态
            $order = new GroupMemberModel();
            $res = $order->save([
                'comment_status' => 1
            ],[
                'user_token'    => $post['user_token'],
                'group_number'  => $post['group_number']
            ]);
        if ($res){
            //提交事务
            \think\Db::commit();
            return returnData('success','评论成功');
        }else{
            //事务回滚
            \think\Db::rollback();
            return returnData('error','评论失败');
        }

    }
}