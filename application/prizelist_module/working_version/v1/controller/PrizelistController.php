<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\controller;
use think\Controller;
use app\prizelist_module\working_version\v1\service\PrizelistService;

class PrizelistController extends Controller
{
    /**
     * 名  称 : prizelistPost()
     * 功  能 : 添加奖品信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenicId']  => '景区主键';
     * 输  入 : $post['przeName']  => '奖品名称';
     * 输  入 : $post['przeFile']  => '奖品图片';
     * 输  入 : $post['przePrice'] => '奖品价值';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/25 15:03
     */
    public function prizelistPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $prizelistService = new PrizelistService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $prizelistService->prizelistAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : prizelistGet()
     * 功  能 : 获取奖品信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/25 15:34
     */
    public function prizelistGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $prizelistService = new PrizelistService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $prizelistService->prizelistShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}