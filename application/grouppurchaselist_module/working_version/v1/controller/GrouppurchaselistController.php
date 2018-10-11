<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  GrouppurchaselistController.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 19:23
 *  文件描述 :  查询未完成团购内容控制器
 *  历史记录 :  -----------------------
 */
namespace app\grouppurchaselist_module\working_version\v1\controller;
use think\Controller;
use app\grouppurchaselist_module\working_version\v1\service\GrouppurchaselistService;

class GrouppurchaselistController extends Controller
{
    /**
     * 名  称 : grouppurchaselist()
     * 功  能 : 查询个人及团购订单中未完成订单的团购类型和团购人数
     * 变  量 : --------------------------------------
     * 输  入 : group_type => 'group_type'
     * 输  入 : group_num => 'group_num'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":trun}
     * 创  建 : 2018/10/11 19:23
     */
    public function Grouppurchaselist(\think\Request $request)
    {
        //实例化Service层
        $Gorder = new GrouppurchaselistService();
        //获取传入参数
        $get = $request->get();
        //执行Service层逻辑
        $res = $Gorder->GrouppurchaselistService($get);
        //处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');

    }

}