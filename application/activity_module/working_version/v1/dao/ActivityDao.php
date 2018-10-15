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
use app\activity_module\working_version\v1\model\ActivityContModel;

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
        return \RSD::wxReponse($res,'M',
            ['activity_id'=>$activity['activity_id']], '添加失败'
        );
    }

    /**
     * 名  称 : activitySelect()
     * 功  能 : 获取活动广告列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 11:09
     */
    public function activitySelect($get)
    {
        // TODO :  ActivityModel 模型
        $notStarted = ActivityModel::where(
        'activity_class',$get['ActivityClass']
        )->where(
            'activity_class',$get['ActivityClass']
        )->where(
            'activity_type',$get['ActivityType']
        )->where(
            'start_time','>',time()
        )->where(
            'end_time','>',time()
        )->order(
            'start_time','asc'
        )->select()->toArray();
        // TODO :  ActivityModel 模型
        $haveInHand = ActivityModel::where(
            'activity_class',$get['ActivityClass']
        )->where(
            'activity_class',$get['ActivityClass']
        )->where(
            'activity_type',$get['ActivityType']
        )->where(
            'start_time','<',time()
        )->where(
            'end_time','>',time()
        )->order(
            'start_time','asc'
        )->select()->toArray();
        // TODO :  ActivityModel 模型
        $finished = ActivityModel::where(
            'activity_class',$get['ActivityClass']
        )->where(
            'activity_class',$get['ActivityClass']
        )->where(
            'activity_type',$get['ActivityType']
        )->where(
            'end_time','<',time()
        )->order(
            'start_time','asc'
        )->limit(0,12)->select()->toArray();
        // 返回数据
        return \RSD::wxReponse(true,'M',[
            'notStarted'=>['msg'=>'未开始','data'=>$notStarted],
            'haveInHand'=>['msg'=>'进行中','data'=>$haveInHand],
            'finished'  =>['msg'=>'已结束','data'=>$finished]
        ]);
    }

    /**
     * 名  称 : activityUpdate()
     * 功  能 : 修改活动广告信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( File ) $put['ActivityId']     => '活动主键';
     * 输  入 : ( File ) $put['ActivityFile']   => '活动图片';
     * 输  入 : (String) $put['ActivityTitle']  => '活动标题';
     * 输  入 : (String) $put['ActivityDes']    => '活动介绍';
     * 输  入 : (String) $put['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $put['ActivityStatus'] => '活动状态';
     * 输  入 : ( Int )  $put['ActivityClass']  => '活动分组';
     * 输  入 : (String) $put['ActivityStart']  => '开始时间';
     * 输  入 : (String) $put['ActivityEnd']    => '结束时间';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 12:16
     */
    public function activityUpdate($put)
    {
        // TODO :  验证数据是否已经存在
        $activity = ActivityModel::where(
            'activity_title',$put['ActivityTitle']
        )->where(
            'activity_type',$put['ActivityType']
        )->where(
            'activity_class',$put['ActivityClass']
        )->find();
        // TODO :  验证数据
        if(($activity)&&($activity['activity_id']!=$put['ActivityId'])) {
            return returnData('error','标题已存在');
        }
        // TODO :  处理数据
        if($put['ActivityFile'] != 'false'){
            if(file_exists('.'.$activity['activity_img'])){
                unlink('.'.$activity['activity_img']);
            }
            $activity->activity_img    = $put['ActivityFile'];
        }
        $activity->activity_title  = $put['ActivityTitle'];
        $activity->activity_des    = $put['ActivityDes'];
        $activity->activity_type   = $put['ActivityType'];
        $activity->activity_status = $put['ActivityStatus'];
        $activity->activity_class  = $put['ActivityClass'];
        $activity->start_time      = $put['ActivityStart'];
        $activity->end_time        = $put['ActivityEnd'];
        // TODO :  将数据写入数据库
        $res = $activity->save();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M','修改成功','修改失败');
    }

    /**
     * 名  称 : activityDelete()
     * 功  能 : 删除活动广告信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ActivityId']     => '活动主键';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 14:41
     */
    public function activityDelete($delete)
    {
        // TODO :  ActivityModel 模型
        $activity =  ActivityModel::get($delete['ActivityId']);
        // TODO :  判断数据是否存在
        if(!$activity){
            return returnData('error','要删除内容不存在');
        }
        // TODO :  ActivityContModel
        $activityCont =  ActivityContModel::where(
            'activity_id',$delete['ActivityId']
        )->where(
            'content_type','image'
        )->select()->toArray();
        // 删除图片
        foreach($activityCont as $v)
        {
            if(file_exists('.'.$v['content_content'])){
                unlink('.'.$v['content_content']);
            }
        }
        try{
            ActivityContModel::where(
                'activity_id',$delete['ActivityId']
            )->where(
                'content_type','image'
            )->delete();
            if(file_exists('.'.$activity['activity_img'])){
                unlink('.'.$activity['activity_img']);
            }
            $activity->delete();
            return returnData('success','删除成功');
        }catch  (\Exception $e){
            return returnData('error','删除失败');
        }
    }
}