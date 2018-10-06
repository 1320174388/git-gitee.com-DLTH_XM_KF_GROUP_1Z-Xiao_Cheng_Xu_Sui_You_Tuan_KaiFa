<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivitcontInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\dao;

interface ActivitcontInterface
{
    /**
     * 名  称 : activitcontCreate()
     * 功  能 : 声明:添加活动详情数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $post['ActivityId']       => '活动ID';
     * 输  入 : (String) $post['ActivityType']     => '内容类型';
     * 输  入 : (String) $post['ActivityCont']     => '活动内容';
     * 输  入 : (String) $post['ActivitySort']     => '活动排序';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 09:35
     */
    public function activitcontCreate($post);

    /**
     * 名  称 : activitcontDelete()
     * 功  能 : 声明:删除活动详情数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ContentId']       => '内容ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 10:49
     */
    public function activitcontDelete($delete);

    /**
     * 名  称 : activitcontSelect()
     * 功  能 : 声明:获取活动详情列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityId']       => '活动ID';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:54
     */
    public function activitcontSelect($get);
}