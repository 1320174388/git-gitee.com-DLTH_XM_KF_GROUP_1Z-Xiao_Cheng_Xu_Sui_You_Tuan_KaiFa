<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalpurchaseController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票控制器
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\controller;
use think\Controller;
use app\personalpurchase_module\working_version\v1\service\PersonalpurchaseService;

class PersonalpurchaseController extends Controller
{
    /**
     * 名  称 : personalpurchasePost()
     * 功  能 : 个人购票接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenic_id']    => '景区ID';
     * 输  入 : $post['group_id']     => '团购ID';
     * 输  入 : $post['group_type']   => '购票类型:1=个人,2=发起团购,3=加入团购,4=发起预约,5=加入预约';
     * 输  入 : $post['token']        => '用户token';
     * 输  入 : $post['coupon_id']    => '优惠券ID不使用发0';
     * 输  入 : $post['invitation']   => '邀请状态标识:yes/no';
     * 输  入 : $post['invitanumber'] => '邀请订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/12 14:29
     */
    public function personalpurchasePost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $personalpurchaseService = new PersonalpurchaseService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $personalpurchaseService->personalpurchaseAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}