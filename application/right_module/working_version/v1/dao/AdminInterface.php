<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 09:45
 *  文件描述 :  权限管理~管理员管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface AdminInterface
{
    /**
     * 名  称 : adminCreate()
     * 功  能 : 声明:管理员申请数据处理
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
    public function adminCreate($post);

    /**
     * 名  称 : adminSelect()
     * 功  能 : 声明:获取管理员申请列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_class']  => '管理分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 16:14
     */
    public function adminSelect($get);

    /**
     * 名  称 : adminUpdate()
     * 功  能 : 声明:审核管理员接口数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']     => '管理ID';
     * 输  入 : $put['admin_to']     => '审核状态';
     * 输  入 : $put['role_str']     => '职位ID字符窜';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 17:20
     */
    public function adminUpdate($put);
}
