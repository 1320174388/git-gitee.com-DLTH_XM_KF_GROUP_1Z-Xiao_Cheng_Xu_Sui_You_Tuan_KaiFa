<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 09:45
 *  文件描述 :  权限管理~管理员管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\AdminService;

class AdminController extends Controller
{
    /**
     * 名  称 : adminPost()
     * 功  能 : 管理员申请接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']  => '管理标识';
     * 输  入 : $post['admin_name']   => '管理姓名';
     * 输  入 : $post['admin_phone']  => '联系电话';
     * 输  入 : $post['admin_class']  => '管理分组';
     * 输  入 : $post['right_class']  => '权限分组';
     * 输  入 : $post['admin_formid'] => '表单ID';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/22 09:43
     */
    public function adminPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $adminService = new AdminService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $adminService->adminAdd($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : adminGet()
     * 功  能 : 获取管理员申请列表接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_class']  => '管理分组';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/22 16:14
     */
    public function adminGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $adminService = new AdminService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $adminService->adminShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : adminPut()
     * 功  能 : 审核管理员接口接口
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']     => '管理ID';
     * 输  入 : $put['admin_to']     => '审核状态';
     * 输  入 : $put['role_str']     => '职位ID字符窜';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/22 17:20
     */
    public function adminPut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $adminService = new AdminService();

        // 获取传入参数
        $put = $request->put();

        // 执行Service逻辑
        $res = $adminService->adminEdit($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }


}
