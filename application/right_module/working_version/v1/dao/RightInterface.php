<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 10:11
 *  文件描述 :  权限管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface RightInterface
{
    /**
     * 名  称 : rightSelect()
     * 功  能 : 声明:获取所有权限信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理员UserToken标识';
     * 输  入 : $get['admin_class'] => '管理员分组,1/2/3,分级获取';
     * 输  入 : $get['role_class']  => '角色分组,1/2/3,分级获取';
     * 输  入 : $get['right_class'] => '权限分组,1/2/3,分级获取';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/19 11:30
     */
    public function rightSelect($get);
}
