<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\service;
use app\couponlist_module\working_version\v1\dao\CouponlistDao;
use app\couponlist_module\working_version\v1\library\CouponlistLibrary;
use app\couponlist_module\working_version\v1\validator\CouponlistValidatePost;
use app\couponlist_module\working_version\v1\validator\CouponlistValidateGet;
use app\couponlist_module\working_version\v1\validator\CouponlistValidatePut;
use app\couponlist_module\working_version\v1\validator\CouponlistValidateDelete;

class CouponlistService
{
    /**
     * 名  称 : couponlistAdd()
     * 功  能 : 添加优惠券数据逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']    => '用户标识';
     * 输  入 : $post['scenic_id']     => '景区主键';
     * 输  入 : $post['coupon_money']  => '优惠金额';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/26 14:46
     */
    public function couponlistAdd($post)
    {
        // 实例化验证器代码
        $validate  = new CouponlistValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $couponlistDao = new CouponlistDao();
        
        // 执行Dao层逻辑
        $res = $couponlistDao->couponlistCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : couponlistShow()
     * 功  能 : 获取景区所有优惠券信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id'] => '景区ID';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/26 20:41
     */
    public function couponlistShow($get)
    {
        // 实例化验证器代码
        $validate  = new CouponlistValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $couponlistDao = new CouponlistDao();
        
        // 执行Dao层逻辑
        $res = $couponlistDao->couponlistSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : couponlistDel()
     * 功  能 : 删除优惠券逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户Token标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/27 09:31
     */
    public function couponlistDel($delete)
    {
        // 实例化验证器代码
        $validate  = new CouponlistValidateDelete();
        
        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $couponlistDao = new CouponlistDao();
        
        // 执行Dao层逻辑
        $res = $couponlistDao->couponlistDelete($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}