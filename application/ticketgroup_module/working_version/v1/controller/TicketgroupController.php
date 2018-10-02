<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketgroupController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购控制器
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\controller;
use think\Controller;
use app\ticketgroup_module\working_version\v1\service\TicketgroupService;

class TicketgroupController extends Controller
{
    /**
     * 名  称 : ticketgroupGet()
     * 功  能 : 获取门票信息接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区ID';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/27 20:31
     */
    public function ticketgroupGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ticketgroupService = new TicketgroupService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $ticketgroupService->ticketgroupShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : ticketgroupPut()
     * 功  能 : 修改门票金额接口
     * 变  量 : --------------------------------------
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  入 : $put['ticket_money'] => '门票价格';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/28 10:23
     */
    public function ticketgroupPut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ticketgroupService = new TicketgroupService();
        
        // 获取传入参数
        $put = $request->put();
        
        // 执行Service逻辑
        $res = $ticketgroupService->ticketgroupEdit($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}