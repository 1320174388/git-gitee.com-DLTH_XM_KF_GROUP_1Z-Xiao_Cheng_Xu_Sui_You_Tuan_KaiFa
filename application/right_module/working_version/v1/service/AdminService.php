<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 09:45
 *  文件描述 :  权限管理~管理员管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\AdminDao;
use app\right_module\working_version\v1\library\AdminLibrary;
use app\right_module\working_version\v1\validator\AdminValidate;
use app\right_module\working_version\v1\validator\AdminValidate1;
use app\right_module\working_version\v1\validator\AdminValidatePut;

class AdminService
{
    /**
     * 名  称 : adminAdd()
     * 功  能 : 管理员申请逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']  => '管理标识';
     * 输  入 : $post['admin_name']   => '管理姓名';
     * 输  入 : $post['admin_phone']  => '联系电话';
     * 输  入 : $post['admin_class']  => '管理分组';
     * 输  入 : $post['right_class']  => '权限分组';
     * 输  入 : $post['admin_formid'] => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 09:43
     */
    public function adminAdd($post)
    {
        // 实例化验证器代码
        $validate  = new AdminValidate();

        // 验证数据
        if(empty($post['admin_class'])){
            $post['admin_class'] = 0;
        }
        if(empty($post['right_class'])){
            $post['right_class'] = 0;
        }

        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $adminDao = new AdminDao();

        // 执行Dao层逻辑
        $res = $adminDao->adminCreate($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : adminShow()
     * 功  能 : 获取管理员申请列表逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_class']  => '管理分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 16:14
     */
    public function adminShow($get)
    {
        // 实例化验证器代码
        $validate  = new AdminValidate1();

        // 验证数据
        if(empty($post['admin_class'])){
            $post['admin_class'] = 0;
        }

        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $adminDao = new AdminDao();

        // 执行Dao层逻辑
        $res = $adminDao->adminSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : adminEdit()
     * 功  能 : 审核管理员接口逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']     => '管理ID';
     * 输  入 : $put['admin_to']     => '审核状态';
     * 输  入 : $put['role_str']     => '职位ID字符窜';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 17:20
     */
    public function adminEdit($put)
    {
        // 实例化验证器代码
        $validate  = new AdminValidatePut();

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证数据
        if (($put['admin_to']!=='yes')&&($put['admin_to']!=='no')) {
            return ['msg'=>'error','data'=>'请正确输入：yes|no，审核状态'];
        }

        // 实例化Dao层数据类
        $adminDao = new AdminDao();

        // 执行Dao层逻辑
        $res = $adminDao->adminUpdate($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}
