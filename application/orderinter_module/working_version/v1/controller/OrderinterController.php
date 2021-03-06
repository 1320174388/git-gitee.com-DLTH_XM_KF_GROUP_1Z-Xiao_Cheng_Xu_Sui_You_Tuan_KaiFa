<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinterController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单控制器
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\controller;
use think\Controller;
use app\orderinter_module\working_version\v1\service\OrderinterService;

class OrderinterController extends Controller
{
    /**
     * 名  称 : orderinterGet()
     * 功  能 : 获取订单列表接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']    => '景区ID';
     * 输  入 : $get['groupType']   => '团购类型';
     * 输  入 : $get['groupStatus'] => '完成状态';
     * 输  入 : $get['groupLimit']  => '订单数量';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/09 13:27
     */
    public function orderinterGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $orderinterService = new OrderinterService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $orderinterService->orderinterShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}