<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserInfoController.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/06 09:54
 *  文件描述 :  用户信息控制器
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\controller;

use think\Controller;
use app\user_module\working_version\v1\service\UserInfoService;
class UserInfoController extends Controller
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : userInfoGet()
     * 功  能 : 获取用户信息及会员信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/06 10:23
     */
    public function userInfoGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new UserInfoService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->userInfoShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : vipExplainGet()
     * 功  能 : 获取会员权益说明
     * 变  量 : --------------------------------------
     * 输  入 : '$get['member_id']  => '会员主键';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/06 10:23
     */
    public function vipExplainGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new UserInfoService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->vipExplainShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : extendGet()
     * 功  能 : 获取推广人员列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/06 10:23
     */
    public function extendGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new UserInfoService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->extendShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : userGroupList()
     * 功  能 : 获取个人团购列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['group_status']  => '团购状态';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/06 10:23
     */
    public function userGroupList(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new UserInfoService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->userGroupListService($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : cancelGroupPost()
     * 功  能 : 取消预约团购
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['group_number']  => '订单号';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/06 10:23
     */
    public function cancelGroupPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new UserInfoService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $searchScenicService->cancelGroupService($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S');
    }

}