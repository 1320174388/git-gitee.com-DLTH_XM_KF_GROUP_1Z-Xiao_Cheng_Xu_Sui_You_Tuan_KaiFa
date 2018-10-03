<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaseLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购自定义类
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\library;

class PurchaseLibrary
{
    /**
     * 名  称 : purchaseLibPost()
     * 功  能 : 添加团购模式函数类
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']  => '用户标识';
     * 输  入 : $post['scenic_id']   => '景区主键';
     * 输  入 : $post['group_money'] => '团购价格';
     * 输  入 : $post['group_num']   => '团购人数';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 20:31
     */
    public function purchaseLibPost($post)
    {
        // TODO : 执行函数处理逻辑
        
        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : purchaseLibDelete()
     * 功  能 : 删除团购模式函数类
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/29 19:14
     */
    public function purchaseLibDelete($delete)
    {
        // TODO : 执行函数处理逻辑
        
        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : purchaseLibGet()
     * 功  能 : 获取团购模式函数类
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id']  => '景区主键';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/03 10:39
     */
    public function purchaseLibGet($get)
    {
        // TODO : 执行函数处理逻辑
        
        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }
}