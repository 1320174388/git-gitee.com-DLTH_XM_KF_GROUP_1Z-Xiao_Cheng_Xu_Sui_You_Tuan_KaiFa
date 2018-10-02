<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CoupondelLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理自定义类
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\library;
use app\couponlist_module\working_version\v1\dao\CoupondelDao;
use app\couponlist_module\working_version\v1\validator\CoupondelValidatePost;
use app\couponlist_module\working_version\v1\validator\CoupondelValidateGet;
use app\couponlist_module\working_version\v1\validator\CoupondelValidatePut;
use app\couponlist_module\working_version\v1\validator\CoupondelValidateDelete;

class CoupondelLibrary
{
    /**
     * 名  称 : coupondelLibDelete()
     * 功  能 : 删除优惠券函数类
     * 变  量 : --------------------------------------
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/27 09:54
     */
    public function coupondelLibDelete($delete,$status=1)
    {
        // 实例化验证器代码
        $validate  = new CoupondelValidateDelete();

        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证数据
        if(($status!=1)&&($$status!=2)){
            return ['msg'=>'error','data'=>'请正确输入审核状态'];
        }

        // 实例化Dao层数据类
        $coupondelDao = new CoupondelDao();

        // 执行Dao层逻辑
        $res = $coupondelDao->coupondelDelete($delete);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}