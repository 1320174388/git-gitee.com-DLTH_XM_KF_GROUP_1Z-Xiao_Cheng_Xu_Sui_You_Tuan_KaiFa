<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaseController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购控制器
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\controller;
use think\Controller;
use app\ticketgroup_module\working_version\v1\service\PurchaseService;

class PurchaseController extends Controller
{
    /**
     * 名  称 : purchasePost()
     * 功  能 : 添加团购模式接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']  => '用户标识';
     * 输  入 : $post['scenic_id']   => '景区主键';
     * 输  入 : $post['group_money'] => '团购价格';
     * 输  入 : $post['group_num']   => '团购人数';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/28 20:31
     */
    public function purchasePost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $purchaseService = new PurchaseService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $purchaseService->purchaseAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : purchaseDelete()
     * 功  能 : 删除团购模式接口
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/29 19:14
     */
    public function purchaseDelete(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $purchaseService = new PurchaseService();
        
        // 获取传入参数
        $delete = $request->delete();
        
        // 执行Service逻辑
        $res = $purchaseService->purchaseDel($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : purchaseGet()
     * 功  能 : 获取团购模式接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/03 10:39
     */
    public function purchaseGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $purchaseService = new PurchaseService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $purchaseService->purchaseShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}