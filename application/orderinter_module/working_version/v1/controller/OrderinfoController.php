<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinfoController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单控制器
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\controller;
use think\Controller;
use app\orderinter_module\working_version\v1\service\OrderinfoService;

class OrderinfoController extends Controller
{
    /**
     * 名  称 : orderinfoGet()
     * 功  能 : 获取订单详情接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['groupNumber'] => '订单编号';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/09 16:31
     */
    public function orderinfoGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $orderinfoService = new OrderinfoService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $orderinfoService->orderinfoShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}