<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 10:11
 *  文件描述 :  权限管理自定义类
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\library;
use app\right_module\working_version\v1\dao\RightDao;
use app\right_module\working_version\v1\validator\RightValidate;

class RightLibrary
{
    /**
     * 名  称 : rightLibGet()
     * 功  能 : 获取所有权限信息函数类
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理员UserToken标识';
     * 输  入 : $get['admin_class'] => '管理员分组,1/2/3,分级获取';
     * 输  入 : $get['role_class']  => '角色分组,1/2/3,分级获取';
     * 输  入 : $get['right_class'] => '权限分组,1/2/3,分级获取';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/19 11:30
     */
    public function rightLibGet($get)
    {
        // 实例化验证器代码
        $validate  = new RightValidate();

        // 处理验证前数据
        if(empty($get['admin_class'])){
            $get['admin_class'] = '0';
        }
        // 处理验证前数据
        if(empty($get['role_class'])){
            $get['role_class'] = '0';
        }
        // 处理验证前数据
        if(empty($get['right_class'])){
            $get['right_class'] = '0';
        }

        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $rightDao = new RightDao();

        // 执行Dao层逻辑
        $res = $rightDao->rightSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}
