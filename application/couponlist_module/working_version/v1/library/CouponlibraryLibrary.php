<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlibraryLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理自定义类
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\library;
use app\couponlist_module\working_version\v1\dao\CouponlibraryDao;
use app\couponlist_module\working_version\v1\validator\CouponlibraryValidatePost;
use app\couponlist_module\working_version\v1\validator\CouponlibraryValidateGet;
use app\couponlist_module\working_version\v1\validator\CouponlibraryValidatePut;
use app\couponlist_module\working_version\v1\validator\CouponlibraryValidateDelete;

class CouponlibraryLibrary
{
    /**
     * 名  称 : couponlibraryLibPut()
     * 功  能 : 审核优惠券函数类
     * 变  量 : --------------------------------------
     * 输  入 : $put['coupon_id']     => '优惠券ID标识';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/26 19:17
     */
    public function couponlibraryLibPut($put,$status=1)
    {
        // 实例化验证器代码
        $validate  = new CouponlibraryValidatePut();

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证数据
        if(($status!=1)&&($$status!=2)){
            return ['msg'=>'error','data'=>'请正确输入审核状态'];
        }

        // 实例化Dao层数据类
        $couponlibraryDao = new CouponlibraryDao();

        // 执行Dao层逻辑
        $res = $couponlibraryDao->couponlibraryUpdate($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}