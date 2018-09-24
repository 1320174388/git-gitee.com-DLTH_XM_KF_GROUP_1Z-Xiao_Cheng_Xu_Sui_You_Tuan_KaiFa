<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdministratorLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 19:26
 *  文件描述 :  权限管理~管理员管理自定义类
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\library;
use app\right_module\working_version\v1\dao\AdministratorDao;
use app\right_module\working_version\v1\validator\AdministratorValidate3;

class AdministratorLibrary
{
    /**
     * 名  称 : administratorLibGet()
     * 功  能 : 获取管理员列表函数类
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_class']  => '管理员分组标识数字';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 19:31
     */
    public function administratorLibGet($get)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : administratorLibPost()
     * 功  能 : 注册分组管理员函数类
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token'] => '管理员标识';
     * 输  入 : $post['admin_name']  => '管理员姓名';
     * 输  入 : $post['admin_phone'] => '联系电话';
     * 输  入 : $post['admin_class'] => '分组注册ID';
     * 输  入 : $post['right_class'] => '所属权限标识';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 22:09
     */
    public function administratorLibPost($post)
    {
        // 实例化验证器代码
        $validate  = new AdministratorValidate3();

        // 验证数据
        if((empty($post['admin_class']))||($post['admin_class']=='0')){
            return ['msg'=>'error','data'=>'请正确输入分组注册ID'];
        }
        // 验证数据
        if((empty($post['right_class']))||($post['right_class']=='0')){
            return ['msg'=>'error','data'=>'请正确输入所属权限标识'];
        }

        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $administratorDao = new AdministratorDao();

        // 执行Dao层逻辑
        $res = $administratorDao->administratorCreate($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}
