<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinterDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单数据层
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\dao;
use app\orderinter_module\working_version\v1\model\OrderinterModel;
use app\orderinter_module\working_version\v1\model\OrdermemberrModel;

class OrderinterDao implements OrderinterInterface
{
    /**
     * 名  称 : orderinterSelect()
     * 功  能 : 获取订单列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']    => '景区ID';
     * 输  入 : $get['groupType']   => '团购类型';
     * 输  入 : $get['groupStatus'] => '完成状态';
     * 输  入 : $get['groupLimit']  => '订单数量';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/09 13:27
     */
    public function orderinterSelect($get)
    {
        // TODO :  OrderinterModel 模型
        $order = OrderinterModel::where(
            'scenic_id',$get['scenicId']
        )->where(
            'group_status',$get['groupStatus']
        );
        if($get['groupType']){
            $order = $order->where(
                'group_type',$get['groupStatus']
            );
        }
        // 分页获取数据
        $order = $order->order(
            'group_time','desc'
        )->limit(
            $get['groupLimit'],12
        )->select()->toArray();
        // 返回数据
        return \RSD::wxReponse($order,'M',$order,'当前没有新订单数据');
    }
}