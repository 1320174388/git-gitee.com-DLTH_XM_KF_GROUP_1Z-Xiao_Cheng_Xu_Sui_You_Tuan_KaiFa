<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Activit2Dao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\dao;
use app\activity_module\working_version\v1\model\ActivityModel;

class Activit2Dao implements Activit2Interface
{
    /**
     * 名  称 : activit2Select()
     * 功  能 : 二次获取活动列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  入 : ( Int )  $get['ActivityLimit']  => '活动数量';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 12:08
     */
    public function activit2Select($get)
    {
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
        )->limit($get['ActivityLimit'],12)->select()->toArray();
        // 返回数据
        return \RSD::wxReponse(true,'M',[
            'finished'  =>['msg'=>'已结束','data'=>$finished]
        ]);
    }
}