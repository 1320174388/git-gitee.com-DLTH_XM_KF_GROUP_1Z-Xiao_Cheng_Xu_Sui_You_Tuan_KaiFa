<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 09:45
 *  文件描述 :  权限管理~管理员管理自定义类
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\library;

class AdminLibrary
{
    /**
     * 名  称 : adminLibPost()
     * 功  能 : 管理员申请函数类
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']  => '管理标识';
     * 输  入 : $post['admin_name']   => '管理姓名';
     * 输  入 : $post['admin_phone']  => '联系电话';
     * 输  入 : $post['admin_class']  => '管理分组';
     * 输  入 : $post['right_class']  => '权限分组';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 09:43
     */
    public function adminLibPost($post)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : adminLibGet()
     * 功  能 : 获取管理员申请列表函数类
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token']  => '管理标识';
     * 输  入 : $get['admin_class']  => '管理分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 16:14
     */
    public function adminLibGet($get)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }
}
