<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票控制器
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\controller;
use think\Controller;
use app\personalpurchase_module\working_version\v1\service\PersonalnotifyService;

class PersonalnotifyController extends Controller
{
    /**
     * 名  称 : personalnotifyPost()
     * 功  能 : 个人购票回调接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/12 16:36
     */
    public function personalnotifyPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $personalnotifyService = new PersonalnotifyService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $personalnotifyService->personalnotifyAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}