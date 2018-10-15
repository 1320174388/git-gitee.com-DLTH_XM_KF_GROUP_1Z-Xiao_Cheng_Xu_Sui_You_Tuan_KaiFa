<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\controller;
use think\Controller;
use app\activity_module\working_version\v1\service\ActivityService;

class ActivityController extends Controller
{
    /**
     * 名  称 : activityPost()
     * 功  能 : 添加活动接口
     * 变  量 : --------------------------------------
     * 输  入 : ( File ) $post['ActivityFile']   => '活动图片';
     * 输  入 : (String) $post['ActivityTitle']  => '活动标题';
     * 输  入 : (String) $post['ActivityDes']    => '活动介绍';
     * 输  入 : (String) $post['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $post['ActivityStatus'] => '活动状态';
     * 输  入 : ( Int )  $post['ActivityClass']  => '活动分组';
     * 输  入 : (String) $post['ActivityStart']  => '开始时间';
     * 输  入 : (String) $post['ActivityEnd']    => '结束时间';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/03 15:09
     */
    public function activityPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activityService = new ActivityService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $activityService->activityAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : activityGet()
     * 功  能 : 获取活动广告列表接口
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 11:09
     */
    public function activityGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activityService = new ActivityService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $activityService->activityShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : activityPut()
     * 功  能 : 修改活动广告信息接口
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
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/05 12:16
     */
    public function activityPut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activityService = new ActivityService();
        
        // 获取传入参数
        $put = $request->post();
        
        // 执行Service逻辑
        $res = $activityService->activityEdit($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : activityDelete()
     * 功  能 : 删除活动广告信息接口
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ActivityId']     => '活动主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/05 14:41
     */
    public function activityDelete(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activityService = new ActivityService();
        
        // 获取传入参数
        $delete = $request->delete();
        
        // 执行Service逻辑
        $res = $activityService->activityDel($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}