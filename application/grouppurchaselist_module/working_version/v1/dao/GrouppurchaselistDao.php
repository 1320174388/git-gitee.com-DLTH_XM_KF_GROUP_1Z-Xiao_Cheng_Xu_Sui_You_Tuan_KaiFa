<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  GrouppurchaselistDao.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 19:23
 *  文件描述 :  查询未完成团购内容数据层
 *  历史记录 :  -----------------------
 */
namespace app\grouppurchaselist_module\working_version\v1\dao;
use app\grouppurchaselist_module\working_version\v1\model\GrouppurchaselistModel;

class GrouppurchaselistDao implements GrouppurchaselistInterface
{
    /**
     * 名  称 : GrouppurchaselistDao()
     * 功  能 : 查询景区的未完成团购订单，
     * 变  量 : --------------------------------------
     * 输  入 : group_status =>  未完成的订单
     * 输  入 : scenic_id =>  景区主键
     * 输  出 : [ 'msg' => 'success', 'data' => $data ]
     * 创  建 : 2018/10/11 19:23
     */
    public function GrouppurchaselistDao($get)
    {
//        将未完成订单查询出来
        $res = GrouppurchaselistModel::field(
            config('grouppurchaselist_v1_tableName.Scen').'.*,'.
            config('grouppurchaselist_v1_tableName.Grochase').'.*'
        )->leftJoin(
            config('grouppurchaselist_v1_tableName.Grochase'),
            config('grouppurchaselist_v1_tableName.Scen').'.scenic_id = '.
            config('grouppurchaselist_v1_tableName.Grochase').'.scenic_id'
        )->where(
            config('grouppurchaselist_v1_tableName.Grochase').'.scenic_id',
            $get['scenic_id']
        )->where(
            config('grouppurchaselist_v1_tableName.Grochase').'.group_status',0
        )->select()->toArray();
        //返回结果
        return \RSD::wxReponse($res,'M',$res,'当前没有团购进行');
    }
}