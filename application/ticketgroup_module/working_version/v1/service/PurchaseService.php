<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaseService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\service;
use app\ticketgroup_module\working_version\v1\dao\PurchaseDao;
use app\ticketgroup_module\working_version\v1\library\PurchaseLibrary;
use app\ticketgroup_module\working_version\v1\validator\PurchaseValidatePost;
use app\ticketgroup_module\working_version\v1\validator\PurchaseValidateGet;
use app\ticketgroup_module\working_version\v1\validator\PurchaseValidatePut;
use app\ticketgroup_module\working_version\v1\validator\PurchaseValidateDelete;

class PurchaseService
{
    /**
     * 名  称 : purchaseAdd()
     * 功  能 : 添加团购模式逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']  => '用户标识';
     * 输  入 : $post['scenic_id']   => '景区主键';
     * 输  入 : $post['group_money'] => '团购价格';
     * 输  入 : $post['group_num']   => '团购人数';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 20:31
     */
    public function purchaseAdd($post)
    {
        // 实例化验证器代码
        $validate  = new PurchaseValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $purchaseDao = new PurchaseDao();
        
        // 执行Dao层逻辑
        $res = $purchaseDao->purchaseCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : purchaseDel()
     * 功  能 : 删除团购模式逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/29 19:14
     */
    public function purchaseDel($delete)
    {
        // 实例化验证器代码
        $validate  = new PurchaseValidateDelete();
        
        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $purchaseDao = new PurchaseDao();
        
        // 执行Dao层逻辑
        $res = $purchaseDao->purchaseDelete($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}