<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\RoleService;

class RoleController extends Controller
{
    /**
     * 名  称 : rolePost()
     * 功  能 : 添加职位接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']=> '管理标识';
     * 输  入 : $post['role_name']  => '职位名称';
     * 输  入 : $post['role_class'] => '职位分组';
     * 输  入 : $post['right_str']  => '权限ID字符串';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/19 18:40
     */
    public function rolePost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $roleService = new RoleService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $roleService->roleAdd($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : roleGet()
     * 功  能 : 获取职位信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理标识';
     * 输  入 : $get['role_class']  => '职位分组';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/09/20 16:14
     */
    public function roleGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $roleService = new RoleService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $roleService->roleShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : rolePut()
     * 功  能 : 修改职位信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $put['role_id']     => '职位ID';
     * 输  入 : $put['admin_token'] => '管理标识';
     * 输  入 : $put['role_name']   => '职位名称';
     * 输  入 : $put['role_class']  => '职位分组';
     * 输  入 : $put['right_str']   => '权限ID字符串';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/21 10:13
     */
    public function rolePut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $roleService = new RoleService();

        // 获取传入参数
        $put = $request->put();

        // 执行Service逻辑
        $res = $roleService->roleEdit($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }

    /**
     * 名  称 : roleDelete()
     * 功  能 : 删除职位信息接口
     * 变  量 : --------------------------------------
     * 输  入 : $delete['role_id']     => '职位ID';
     * 输  入 : $delete['role_class']  => '职位分组';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/21 15:17
     */
    public function roleDelete(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $roleService = new RoleService();

        // 获取传入参数
        $delete = $request->delete();

        // 执行Service逻辑
        $res = $roleService->roleDel($delete);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}
