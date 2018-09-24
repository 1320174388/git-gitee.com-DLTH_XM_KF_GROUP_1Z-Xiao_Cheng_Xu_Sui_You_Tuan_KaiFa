<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdministratorController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 19:26
 *  文件描述 :  权限管理~管理员管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\AdministratorService;

class AdministratorController extends Controller
{
    /**
     * 名  称 : administratorGet()
     * 功  能 : 获取管理员列表接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token']  => '32位AdminToken标识';
     * 输  入 : $get['admin_class']  => '管理员分组标识数字';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/22 19:31
     */
    public function administratorGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $administratorService = new AdministratorService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $administratorService->administratorShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : administratorPut()
     * 功  能 : 修改管理员权限接口
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']  => '管理ID';
     * 输  入 : $put['role_str']  => '请正确输入1~2000字职位字符串';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/22 21:17
     */
    public function administratorPut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $administratorService = new AdministratorService();

        // 获取传入参数
        $put = $request->put();

        // 执行Service逻辑
        $res = $administratorService->administratorEdit($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : administratorDelete()
     * 功  能 : 删除管理员接口
     * 变  量 : --------------------------------------
     * 输  入 : $delete['admin_id']  => '管理ID';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/22 21:45
     */
    public function administratorDelete(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $administratorService = new AdministratorService();

        // 获取传入参数
        $delete = $request->delete();

        // 执行Service逻辑
        $res = $administratorService->administratorDel($delete);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}
