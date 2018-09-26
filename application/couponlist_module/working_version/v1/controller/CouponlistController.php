<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\controller;
use think\Controller;
use app\couponlist_module\working_version\v1\service\CouponlistService;

class CouponlistController extends Controller
{
    /**
     * 名  称 : couponlistPost()
     * 功  能 : 添加优惠券数据接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']    => '用户标识';
     * 输  入 : $post['scenic_id']     => '景区主键';
     * 输  入 : $post['coupon_money']  => '优惠金额';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/26 14:46
     */
    public function couponlistPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $couponlistService = new CouponlistService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $couponlistService->couponlistAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : couponlistGet()
     * 功  能 : 获取景区所有优惠券信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id'] => '景区ID';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/26 20:41
     */
    public function couponlistGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $couponlistService = new CouponlistService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $couponlistService->couponlistShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}