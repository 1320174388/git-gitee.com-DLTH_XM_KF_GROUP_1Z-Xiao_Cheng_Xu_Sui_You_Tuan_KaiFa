<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalorderController.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/10 19:29
 *  文件描述 :  个人订单控制器
 *  历史记录 :  -----------------------
 */
namespace app\personalorder_module\working_version\v1\controller;
use think\Controller;
use app\personalorder_module\working_version\v1\service\PersonalorderService;

class PersonalorderController extends Controller
{
    /**
     * 名  称 : Personalorder()
     * 功  能 : 查询个人订单表页面信息
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":trun}
     * 创  建 : 2018/10/09 22:22
     */
    public function Personalorder(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $UserOrderService = new PersonalorderService();

        // 获取传入参数
        $post = $request->get();

        // 执行Service逻辑
        $res = $UserOrderService->PersonalorderService($post);
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}