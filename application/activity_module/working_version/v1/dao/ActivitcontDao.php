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
use app\activity_module\working_version\v1\model\ActivityModel;
use app\activity_module\working_version\v1\model\ActivityContModel;

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
        // TODO :  ActivityContModel 模型
        $activityCont = new ActivityContModel();
        // TODO :  处理数据
        $activityCont->activity_id     = $post['ActivityId'];
        $activityCont->content_type    = $post['ActivityType'];
        $activityCont->content_content = $post['ActivityCont'];
        $activityCont->content_sort    = $post['ActivitySort'];
        // 写入数据
        $res = $activityCont->save();
        return \RSD::wxReponse(
            $res,'M','添加成功','添加失败'
        );
    }

    /**
     * 名  称 : activitcontDelete()
     * 功  能 : 删除活动详情数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ContentId']       => '内容ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 10:49
     */
    public function activitcontDelete($delete)
    {
        // TODO :  ActivityContModel 模型
        $find = ActivityContModel::get($delete['ContentId'] );
        // 验证数据是存在
        if(!$find){
            return returnData('error','要删除信息不存在');
        }
        if(file_exists('.'.$find['activity_img'])){
            unlink('.'.$find['activity_img']);
        }
        // 执行删除代码
        $res = $find->delete();
        // 返回数据
        return \RSD::wxReponse(
            $res,'M','删除成功','删除失败'
        );
    }

    /**
     * 名  称 : activitcontSelect()
     * 功  能 : 获取活动详情列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityId']       => '活动ID';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:54
     */
    public function activitcontSelect($get)
    {
        $find = ActivityModel::get($get['ActivityId']);
        // 验证数据是存在
        if(!$find){
            return returnData('error','活动信息不存在');
        }
        // TODO :  ActivityContModel 模型
        $res = ActivityContModel::where(
            'activity_id',$get['ActivityId']
        )->order(
            'content_sort','asc'
        )->select()->toArray();
        // 返回数据
        return \RSD::wxReponse(
            true,'M',
            [
                'activity_data'=>$find,
                'activity_cont'=>$res,
            ],
            '当先还没有添加内容'
        );
    }
}