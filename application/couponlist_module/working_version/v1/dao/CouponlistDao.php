<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\dao;
use app\couponlist_module\working_version\v1\model\ScenicModel;
use app\couponlist_module\working_version\v1\model\CouponlistModel;
use app\couponlist_module\working_version\v1\model\OperationModel;

class CouponlistDao implements CouponlistInterface
{
    /**
     * 名  称 : couponlistCreate()
     * 功  能 : 添加优惠券数据数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']    => '用户标识';
     * 输  入 : $post['scenic_id']     => '景区主键';
     * 输  入 : $post['coupon_money']  => '优惠金额';
     * 输  入 : $post['form_id']       => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/26 14:46
     */
    public function couponlistCreate($post)
    {
        // TODO : 获取景区数据，判断是不是vip景区
        $scenic = ScenicModel::get($post['scenic_id']);
        // TODO : 判断景区是不是VIP景区
        if($scenic['scenic_type']=='1'){
            $applyStatus = 1;
            $tishixinxi  = '添加成功';
        }else{
            $applyStatus = 0;
            $tishixinxi  = '添加审核';
        }
        $data = CouponlistModel::where(
            'scenic_id',$post['scenic_id']
        )->where(
            'coupon_money',$post['coupon_money']
        )->where(
            'coupon_status','in','0,1'
        )->where(
            'apply_status','in','0,1'
        )->find();
        if($data){
            return returnData('error','优惠券已添加');
        }
        // 启动事务
        \think\Db::startTrans();
        try {
            // TODO :  CouponlistModel 模型
            $coupon = new CouponlistModel();
            // TODO :  处理数据
            $coupon->scenic_id     = $post['scenic_id'];
            $coupon->coupon_money  = $post['coupon_money'];
            $coupon->apply_status  = $applyStatus;
            $coupon->coupon_status = 0;
            $coupon->coupon_time   = time();
            // TODO :  写入数据
            $res = $coupon->save();
            // TODO :  验证数据是否添加成功
            if(($res)&&($applyStatus==0)){
                // TODO : 实例化 景区申请表模型
                $operation = new OperationModel();
                // TODO : 处理数据
                $operation->user_token        = $post['user_token'];
                $operation->scenic_id         = $post['scenic_id'];
                $operation->josn              = json_encode([
                    'coupon_id'     => $coupon['coupon_id']
                ],320);
                $operation->class_name        = 'app\couponlist_module\working_'.
                    'version\v1\library\CouponlibraryLibrary';
                $operation->function_name     = 'couponlibraryLibPut';
                $operation->operation_content = '【'.$scenic['scenic_name'].
                    '】申请添加【'.$post['coupon_money'].'元】优惠券。';
                $operation->operation_status  = 0;
                $operation->form_id           = $post['form_id'];
                // TODO : 写入数据
                $operation->save();
            }
            // 提交事务
            \think\Db::commit();
            return returnData('success',$tishixinxi);
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','添加失败');
        }
    }

    /**
     * 名  称 : couponlistSelect()
     * 功  能 : 获取景区所有优惠券信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id'] => '景区ID';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/26 20:41
     */
    public function couponlistSelect($get)
    {
        // TODO :  CouponlistModel 模型
        $res = CouponlistModel::where(
            'scenic_id',$get['scenic_id']
        )->where(
            'coupon_status','in','0,1'
        )->select()->toArray();
        // 返回数据
        return \RSD::wxReponse($res,'M',$res,'当前景区没有优惠券');
    }

    /**
     * 名  称 : couponlistDelete()
     * 功  能 : 删除优惠券数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户Token标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  入 : $delete['form_id']    => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/27 09:31
     */
    public function couponlistDelete($delete)
    {
        // TODO : 获取景区数据，判断是不是vip景区
        $scenic = ScenicModel::get($delete['scenic_id']);
        // TODO : 判断景区是不是VIP景区
        if($scenic['scenic_type']=='1'){
            $applyStatus = 2;
            $tishixinxi  = '删除成功';
        }else{
            $applyStatus = 0;
            $tishixinxi  = '删除审核';
        }
        $data = CouponlistModel::where(
            'coupon_id',$delete['coupon_id']
        )->where(
            'coupon_status','1'
        )->where(
            'apply_status','0'
        )->find();
        if($data){
            return returnData('error','优惠券已在删除申请状态');
        }
        // 启动事务
        \think\Db::startTrans();
        try {
            // TODO :  CouponlistModel 模型
            $coupon = CouponlistModel::get($delete['coupon_id']);
            // TODO :  处理数据
            $coupon->apply_status  = $applyStatus;
            // TODO :  写入数据
            $res = $coupon->save();
            // TODO :  验证数据是否添加成功
            if(($res)&&($applyStatus==0)){
                // TODO : 实例化 景区申请表模型
                $operation = new OperationModel();
                // TODO : 处理数据
                $operation->user_token        = $delete['user_token'];
                $operation->scenic_id         = $delete['scenic_id'];
                $operation->josn              = json_encode([
                    'coupon_id'=>$coupon['coupon_id']
                ],320);
                $operation->class_name        = 'app\couponlist_module\working_'.
                    'version\v1\library\CoupondelLibrary';
                $operation->function_name     = 'coupondelLibDelete';
                $operation->operation_content = '【'.$scenic['scenic_name'].
                    '】申请删除【'.$coupon['coupon_money'].'元】优惠券。';
                $operation->operation_status  = 0;
                $operation->form_id           = $delete['form_id'];
                // TODO : 写入数据
                $operation->save();
            }
            // 提交事务
            \think\Db::commit();
            return returnData('success',$tishixinxi);
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','删除失败');
        }
    }
}