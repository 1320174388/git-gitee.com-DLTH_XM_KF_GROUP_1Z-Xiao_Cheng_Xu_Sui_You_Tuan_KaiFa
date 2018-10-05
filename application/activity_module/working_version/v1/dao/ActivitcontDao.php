<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivitcontDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\dao;
use app\activity_module\working_version\v1\model\ActivitcontModel;

class ActivitcontDao implements ActivitcontInterface
{
    /**
     * 名  称 : activitcontCreate()
     * 功  能 : 添加活动详情数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $post['ActivityId']       => '活动ID';
     * 输  入 : (String) $post['ActivityType']     => '内容类型';
     * 输  入 : (String) $post['ActivityCont']     => '活动内容';
     * 输  入 : (String) $post['ActivitySort']     => '活动排序';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 09:35
     */
    public function activitcontCreate($post)
    {
        // TODO :  ActivitcontModel 模型
    }
}