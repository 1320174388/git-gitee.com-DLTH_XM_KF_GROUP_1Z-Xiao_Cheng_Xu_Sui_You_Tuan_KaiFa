<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SearchScenicController.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  景区押金控制器
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\controller;

use think\Controller;

class ScenicDepositController extends Controller
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicDepositExtract()
     * 功  能 : 提现景区押金
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['deposit_money']  => '提现金额';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicDepositExtract(\think\Request $request)
    {
//        // 实例化Service层逻辑类
//        $searchScenicService = new ();
//
//        // 获取传入参数
//        $get = $request->get();
//
//        // 执行Service逻辑
//        $res = $searchScenicService->($get);
//
//        // 处理函数返回值
//        return \RSD::wxReponse($res,'S','请求成功');
    }
}