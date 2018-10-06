<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\dao;

interface ActivityInterface
{
    /**
     * 名  称 : activityCreate()
     * 功  能 : 声明:添加活动数据处理
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
    public function activityCreate($post);

    /**
     * 名  称 : activitySelect()
     * 功  能 : 声明:获取活动广告列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 11:09
     */
    public function activitySelect($get);

    /**
     * 名  称 : activityUpdate()
     * 功  能 : 声明:修改活动广告信息数据处理
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
    public function activityUpdate($put);

    /**
     * 名  称 : activityDelete()
     * 功  能 : 声明:删除活动广告信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ActivityId']     => '活动主键';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 14:41
     */
    public function activityDelete($delete);
}