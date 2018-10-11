<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrdergrouppurchaseController.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 11:06
 *  文件描述 :  通过订单号获取个人信息控制器
 *  历史记录 :  -----------------------
 */
namespace app\ordergrouppurchase_module\working_version\v1\controller;
use think\Controller;
use app\ordergrouppurchase_module\working_version\v1\service\OrdergrouppurchaseService;

class OrdergrouppurchaseController extends Controller
{
    /**
     * 名  称 : Ordergrouppurchase()
     * 功  能 :
     * 变  量 : --------------------------------------
     * 输  入 : (string) $code => '用户临时登录code凭证';
     * 输  出 : {"errNum":0,"retMsg":"登录成功","retData":{"token":"用户标识"}}
     * 输  出 : {"errNum":1,"retMsg":"请检查Code是否失效","retData":false}
     * 输  出 : {"errNum":1,"retMsg":"登录失败","retData":false}
     * 创  建 : 2018/06/12 21:50
     */
    public function Ordergrouppurchase(\think\Request $request)
    {
        //实例化Service层逻辑类
        $UserOrderService = new OrdergrouppurchaseService();

        //获取传输入数据
        $get = $request->get();

        //执行Service逻辑
        $res = $UserOrderService->OrdergrouppurchaseService($get);

        //处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');

    }
}