<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxloginaddController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户控制器
 *  历史记录 :  -----------------------
 */
namespace app\wxloginadd_module\working_version\v1\controller;
use think\Controller;
use app\wxloginadd_module\working_version\v1\service\WxloginaddService;

class WxloginaddController extends Controller
{
    /**
     * 名  称 : wxloginaddPost()
     * 功  能 : 授权登录接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['userToken']  => '用户token';
     * 输  入 : $post['avatarUrl']  => '用户头像';
     * 输  入 : $post['nickName']   => '用户昵称';
     * 输  入 : $post['gender']     => '用户昵称';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/10 22:36
     */
    public function wxloginaddPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $wxloginaddService = new WxloginaddService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $wxloginaddService->wxloginaddAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}