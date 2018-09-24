<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 10:11
 *  文件描述 :  权限管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\RightService;

class RightController extends Controller
{
    /**
     * 名  称 : rightGet()
     * 功  能 : 获取所有权限信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理员UserToken标识';
     * 输  入 : $get['admin_class'] => '管理员分组,1/2/3,分级获取';
     * 输  入 : $get['role_class']  => '角色分组,1/2/3,分级获取';
     * 输  入 : $get['right_class'] => '权限分组,1/2/3,分级获取';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/19 11:30
     */
    public function rightGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $rightService = new RightService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $rightService->rightShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}
