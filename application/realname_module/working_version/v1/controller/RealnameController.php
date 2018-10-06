<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RealnameController.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/09/15 00:00
 *  文件描述 :  实名认证模块控制器
 *  历史记录 :  -----------------------
 */
namespace app\realname_module\working_version\v1\controller;
use think\Controller;
use app\realname_module\working_version\v1\service\RealnameService;

class RealnameController extends Controller
{
    /**
     * 名  称 : realnamePost()
     * 功  能 : 用户实名认证接口
     * 变  量 : --------------------------------------
     * 输  入 : (string)    $user_phone        =>  用户手机号  【必填】
     * 输  入 : (string)    $user_identity     =>  身份证号  【必填】
     * 输  入 : (string)    $user_name       =>  真实姓名  【必填】
     * 输  入 : (string)    $user_token       =>  用户token  【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/15 00:06
     */
    public function realnamePost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $realnameService = new RealnameService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $realnameService->realnameAdd($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 名  称 : realnameGet()
     * 功  能 : 查询实名制状态
     * 变  量 : --------------------------------------
     * 输  入 : (string)    $user_token       =>  用户token  【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/15 00:06
     */
    public function realnameGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $realnameService = new RealnameService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $realnameService->realnameShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}
