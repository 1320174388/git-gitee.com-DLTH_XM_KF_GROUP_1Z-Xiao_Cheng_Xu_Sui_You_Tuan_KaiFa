<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\RoleDao;
use app\right_module\working_version\v1\library\RoleLibrary;
use app\right_module\working_version\v1\validator\RoleValidate;
use app\right_module\working_version\v1\validator\RoleValidate1;
use app\right_module\working_version\v1\validator\RoleValidate2;
use app\right_module\working_version\v1\validator\RoleValidate3;

class RoleService
{
    /**
     * 名  称 : roleAdd()
     * 功  能 : 添加职位逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']=> '管理标识';
     * 输  入 : $post['role_name']  => '职位名称';
     * 输  入 : $post['role_class'] => '职位分组';
     * 输  入 : $post['right_str']  => '权限ID字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/19 18:40
     */
    public function roleAdd($post)
    {
        // 实例化验证器代码
        $validate  = new RoleValidate();

        // 处理数据
        if(empty($post['role_class'])){
            $post['role_class'] = '0';
        }

        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $roleDao = new RoleDao();

        // 执行Dao层逻辑
        $res = $roleDao->roleCreate($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : roleShow()
     * 功  能 : 获取职位信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理标识';
     * 输  入 : $get['role_class']  => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/20 16:14
     */
    public function roleShow($get)
    {
        // 实例化验证器代码
        $validate  = new RoleValidate1();

        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $roleDao = new RoleDao();

        // 执行Dao层逻辑
        $res = $roleDao->roleSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : roleEdit()
     * 功  能 : 修改职位信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $put['role_id']     => '职位ID';
     * 输  入 : $put['admin_token'] => '管理标识';
     * 输  入 : $put['role_name']   => '职位名称';
     * 输  入 : $put['role_class']  => '职位分组';
     * 输  入 : $put['right_str']   => '权限ID字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/21 10:13
     */
    public function roleEdit($put)
    {
        // 实例化验证器代码
        $validate  = new RoleValidate2();

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $roleDao = new RoleDao();

        // 执行Dao层逻辑
        $res = $roleDao->roleUpdate($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : roleDel()
     * 功  能 : 删除职位信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $delete['role_id']     => '职位ID';
     * 输  入 : $delete['role_class']  => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/21 15:17
     */
    public function roleDel($delete)
    {
        // 实例化验证器代码
        $validate  = new RoleValidate3();

        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $roleDao = new RoleDao();

        // 执行Dao层逻辑
        $res = $roleDao->roleDelete($delete);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}
