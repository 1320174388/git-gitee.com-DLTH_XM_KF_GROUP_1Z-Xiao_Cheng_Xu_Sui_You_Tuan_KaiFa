<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdministratorService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 19:26
 *  文件描述 :  权限管理~管理员管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\AdministratorDao;
use app\right_module\working_version\v1\library\AdministratorLibrary;
use app\right_module\working_version\v1\validator\AdministratorValidate;
use app\right_module\working_version\v1\validator\AdministratorValidate1;
use app\right_module\working_version\v1\validator\AdministratorValidate2;
use app\right_module\working_version\v1\validator\AdministratorValidate3;

class AdministratorService
{
    /**
     * 名  称 : administratorShow()
     * 功  能 : 获取管理员列表逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token']  => '32位AdminToken标识';
     * 输  入 : $get['admin_class']  => '管理员分组标识数字';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 19:31
     */
    public function administratorShow($get)
    {
        // 实例化验证器代码
        $validate  = new AdministratorValidate();

        // 验证数据
        if(empty($get['admin_class'])){
            $get['admin_class'] = 0;
        }

        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $administratorDao = new AdministratorDao();

        // 执行Dao层逻辑
        $res = $administratorDao->administratorSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : administratorEdit()
     * 功  能 : 修改管理员权限逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']  => '管理ID';
     * 输  入 : $put['role_str']  => '请正确输入1~2000字职位字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 21:17
     */
    public function administratorEdit($put)
    {
        // 实例化验证器代码
        $validate  = new AdministratorValidate1();

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $administratorDao = new AdministratorDao();

        // 执行Dao层逻辑
        $res = $administratorDao->administratorUpdate($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : administratorDel()
     * 功  能 : 删除管理员逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $delete['admin_id']  => '管理ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 21:45
     */
    public function administratorDel($delete)
    {
        // 实例化验证器代码
        $validate  = new AdministratorValidate2();

        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $administratorDao = new AdministratorDao();

        // 执行Dao层逻辑
        $res = $administratorDao->administratorDelete($delete);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}
