<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinfoDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单数据层
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\dao;
use app\orderinter_module\working_version\v1\model\OrderinfoModel;

class OrderinfoDao implements OrderinfoInterface
{
    /**
     * 名  称 : orderinfoSelect()
     * 功  能 : 获取订单详情数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['groupNumber'] => '订单编号';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/09 16:31
     */
    public function orderinfoSelect($get)
    {
        // TODO :  OrderinfoModel 模型
        $res = OrderinfoModel::field(
            config('v1_tableName.SGY_Group_Member').'.*,'.
            config('wx_sgy_config.SGY_Users_Lists').'.user_name'
        )->leftJoin(
            config('wx_sgy_config.SGY_Users_Lists'),
            config('v1_tableName.SGY_Group_Member').'.user_token ='.
            config('wx_sgy_config.SGY_Users_Lists').'.user_token'
        )->where(
            config('v1_tableName.SGY_Group_Member').'.group_number',
            $get['groupNumber']
        )->select()->toArray();
        // 处理函数返回值
        return \RSD::wxReponse($res,'M',$res,'订单信息不存在');
    }
}