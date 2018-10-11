<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrdergrouppurchaseDao.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 11:06
 *  文件描述 :  通过订单成员表联查团购邀请码中的其他表的信息
 *  历史记录 :  -----------------------
 */
namespace app\ordergrouppurchase_module\working_version\v1\dao;
use app\ordergrouppurchase_module\working_version\v1\model\OrdergrouppurchaseModel;

class OrdergrouppurchaseDao implements OrdergrouppurchaseInterface
{
    //执行联查操作
    public function OrdergrouppurchaseDao($get)
    {
        /**
         * 名  称 : personalorder()
         * 功  能 : 根据订单号判断是否有团购信息
         * 变  量 : --------------------------------------
         * 输  入 : user_token => user_token;
         * 输  出 : [ 'msg' => 'success', 'data' => $userInfo ]
         * 输  出 : [ 'msg' => 'error',  'data' => false ]
         * 创  建 : 2018/10/11 11:40
         */
        $res = OrdergrouppurchaseModel::field(
            config('ordergrouppurchase_v1_tableName.Perorder').'.*,'.
            config('ordergrouppurchase_v1_tableName.Group').'.group_num,'.
            config('ordergrouppurchase_v1_tableName.Group').'.man_num,'.
            config('ordergrouppurchase_v1_tableName.Group').'.group_money,'.
            config('ordergrouppurchase_v1_tableName.Scenic').'.scenic_name,'.
            config('ordergrouppurchase_v1_tableName.Users').'.user_nickName,'.
            config('ordergrouppurchase_v1_tableName.Users').'.user_name'
        )->leftJoin(
            config('ordergrouppurchase_v1_tableName.Group'),
            config('ordergrouppurchase_v1_tableName.Perorder').'.group_number ='.
            config('ordergrouppurchase_v1_tableName.Group').'.group_number'
        )->leftJoin(
            config('ordergrouppurchase_v1_tableName.Scenic'),
            config('ordergrouppurchase_v1_tableName.Group').'.scenic_id ='.
            config('ordergrouppurchase_v1_tableName.Scenic').'.scenic_id'
        )->leftJoin(
            config('ordergrouppurchase_v1_tableName.Users'),
            config('ordergrouppurchase_v1_tableName.Perorder').'.user_token = '.
            config('ordergrouppurchase_v1_tableName.Users').'.user_token'
        )->where(
            config('ordergrouppurchase_v1_tableName.Perorder').'.group_number',$get['group_number']
        )->select()->toArray();

        //返回结果
        return \RSD::wxReponse($res,'M',$res,'没有团购订单');
    }
}