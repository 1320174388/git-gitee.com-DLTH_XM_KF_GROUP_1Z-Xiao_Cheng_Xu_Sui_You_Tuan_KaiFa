<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalpurchaseService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\service;
use app\personalpurchase_module\working_version\v1\dao\PersonalpurchaseDao;
use app\personalpurchase_module\working_version\v1\library\PersonalpurchaseLibrary;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidatePost;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidateGet;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidatePut;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidateDelete;

class PersonalpurchaseService
{
    /**
     * 名  称 : personalpurchaseAdd()
     * 功  能 : 个人购票逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenic_id']    => '景区ID';
     * 输  入 : $post['token']        => '用户token';
     * 输  入 : $post['coupon_id']    => '优惠券ID不使用发0';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 14:29
     */
    public function personalpurchaseAdd($post)
    {
        // 实例化验证器代码
        $validate  = new PersonalpurchaseValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $personalpurchaseDao = new PersonalpurchaseDao();
        
        // 执行Dao层逻辑
        $res = $personalpurchaseDao->personalpurchaseCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}