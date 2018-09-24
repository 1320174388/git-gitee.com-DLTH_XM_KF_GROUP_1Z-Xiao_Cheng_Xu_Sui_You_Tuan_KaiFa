<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位管理自定义类
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\library;

class RoleLibrary
{
    /**
     * 名  称 : roleLibPost()
     * 功  能 : 添加职位函数类
     * 变  量 : --------------------------------------
     * 输  入 : $post['role_name']  => '职位名称';
     * 输  入 : $post['role_class'] => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/19 18:40
     */
    public function roleLibPost($post)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : roleLibGet()
     * 功  能 : 获取职位信息函数类
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理标识';
     * 输  入 : $get['role_class']  => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/20 16:14
     */
    public function roleLibGet($get)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : roleLibPut()
     * 功  能 : 修改职位信息函数类
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_token'] => '管理标识';
     * 输  入 : $put['role_name']   => '职位名称';
     * 输  入 : $put['role_class']  => '职位分组';
     * 输  入 : $put['right_str']   => '权限ID字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/21 10:13
     */
    public function roleLibPut($put)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : roleLibDelete()
     * 功  能 : 删除职位信息函数类
     * 变  量 : --------------------------------------
     * 输  入 : $delete['admin_token'] => '管理标识';
     * 输  入 : $delete['role_class']  => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/21 15:17
     */
    public function roleLibDelete($delete)
    {
        // TODO : 执行函数处理逻辑

        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

}
