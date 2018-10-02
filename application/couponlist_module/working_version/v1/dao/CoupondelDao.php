<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CoupondelDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\dao;
use app\couponlist_module\working_version\v1\model\CouponlistModel;

class CoupondelDao implements CoupondelInterface
{
    /**
     * 名  称 : coupondelDelete()
     * 功  能 : 删除优惠券数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/27 09:54
     */
    public function coupondelDelete($delete,$status=1)
    {
        // TODO :  CoupondelModel 模型
        $coupon = CouponlistModel::get($delete['coupon_id']);
        // 验证审核状态
        if($status==1){
            $couponStatus = 2;
        }else{
            $couponStatus = 1;
        }
        // 处理数据
        $coupon->apply_status  = $couponStatus;
        $coupon->coupon_status = $couponStatus;
        // 保存数据
        $res = $coupon->save();
        // 返回数据
        return \RSD::wxReponse($res,'M','删除成功','删除失败');
    }
}