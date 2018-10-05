<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivitcontController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\controller;
use think\Controller;
use app\activity_module\working_version\v1\service\ActivitcontService;

class ActivitcontController extends Controller
{
    /**
     * 名  称 : activitcontPost()
     * 功  能 : 添加活动详情接口
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $post['ActivityId']       => '活动ID';
     * 输  入 : (String) $post['ActivityType']     => '内容类型';
     * 输  入 : (String) $post['ActivityCont']     => '活动内容';
     * 输  入 : (String) $post['ActivitySort']     => '活动排序';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/05 09:35
     */
    public function activitcontPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activitcontService = new ActivitcontService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $activitcontService->activitcontAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : activitcontDelete()
     * 功  能 : 删除活动详情接口
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ContentId']       => '内容ID';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/05 10:49
     */
    public function activitcontDelete(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activitcontService = new ActivitcontService();
        
        // 获取传入参数
        $delete = $request->delete();
        
        // 执行Service逻辑
        $res = $activitcontService->activitcontDel($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : activitcontGet()
     * 功  能 : 获取活动详情列表接口
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityId']       => '活动ID';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:54
     */
    public function activitcontGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activitcontService = new ActivitcontService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $activitcontService->activitcontShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}