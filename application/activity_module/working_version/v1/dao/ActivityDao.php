<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\dao;
use app\activity_module\working_version\v1\model\ActivityModel;

class ActivityDao implements ActivityInterface
{
    /**
     * 名  称 : activityCreate()
     * 功  能 : 添加活动数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( File ) $post['ActivityFile']   => '活动图片';
     * 输  入 : (String) $post['ActivityTitle']  => '活动标题';
     * 输  入 : (String) $post['ActivityDes']    => '活动介绍';
     * 输  入 : (String) $post['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $post['ActivityStatus'] => '活动状态';
     * 输  入 : ( Int )  $post['ActivityClass']  => '活动分组';
     * 输  入 : (String) $post['ActivityStart']  => '开始时间';
     * 输  入 : (String) $post['ActivityEnd']    => '结束时间';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/03 15:09
     */
    public function activityCreate($post)
    {
        // TODO :  验证数据是否已经存在
        $a = ActivityModel::where(
            'activity_title',$post['ActivityTitle']
        )->where(
            'activity_type',$post['ActivityType']
        )->where(
            'activity_class',$post['ActivityClass']
        )->find();
        // TODO :  验证数据
        if($a) return returnData('error','标题已存在');
        // TODO :  ActivityModel 模型
        $activity = new ActivityModel();
        // TODO :  处理数据
        $activity->activity_img    = $post['ActivityFile'];
        $activity->activity_title  = $post['ActivityTitle'];
        $activity->activity_des    = $post['ActivityDes'];
        $activity->activity_type   = $post['ActivityType'];
        $activity->activity_status = $post['ActivityStatus'];
        $activity->activity_class  = $post['ActivityClass'];
        $activity->start_time      = $post['ActivityStart'];
        $activity->end_time        = $post['ActivityEnd'];
        // TODO :  将数据写入数据库
        $res = $activity->save();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M','添加成功','添加失败');
    }
}