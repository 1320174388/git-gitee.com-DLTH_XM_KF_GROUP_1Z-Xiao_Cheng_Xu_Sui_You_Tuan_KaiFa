<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdministratorInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 19:26
 *  文件描述 :  权限管理~管理员管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface AdministratorInterface
{
    /**
     * 名  称 : administratorSelect()
     * 功  能 : 声明:获取管理员列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token']  => '32位AdminToken标识';
     * 输  入 : $get['admin_class']  => '管理员分组标识数字';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 19:31
     */
    public function administratorSelect($get);

    /**
     * 名  称 : administratorUpdate()
     * 功  能 : 声明:修改管理员权限数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']  => '管理ID';
     * 输  入 : $put['role_str']  => '请正确输入1~2000字职位字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 21:17
     */
    public function administratorUpdate($put);

    /**
     * 名  称 : administratorDelete()
     * 功  能 : 声明:删除管理员数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['admin_id']  => '管理ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 21:45
     */
    public function administratorDelete($delete);

    /**
     * 名  称 : administratorCreate()
     * 功  能 : 声明:注册分组管理员函数数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token'] => '管理员标识';
     * 输  入 : $post['admin_name']  => '管理员姓名';
     * 输  入 : $post['admin_phone'] => '联系电话';
     * 输  入 : $post['admin_class'] => '分组注册ID';
     * 输  入 : $post['right_class'] => '所属权限标识';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 22:09
     */
    public function administratorCreate($post);
}
