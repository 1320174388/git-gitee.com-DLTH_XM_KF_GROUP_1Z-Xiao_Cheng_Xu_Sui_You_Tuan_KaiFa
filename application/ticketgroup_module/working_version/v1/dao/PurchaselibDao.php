<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaselibDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购数据层
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;
use app\ticketgroup_module\working_version\v1\model\PurchaseModel;
use app\ticketgroup_module\working_version\v1\model\TicketgroupModel;

class PurchaselibDao implements PurchaselibInterface
{
    /**
     * 名  称 : purchaselibUpdate()
     * 功  能 : 审核团购模式添加数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['group_id'] => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/29 09:59
     */
    public function purchaselibUpdate($put,$statsu)
    {
        // TODO :  PurchaseModel 模型
        $purchade = PurchaseModel::get($put['group_id']);
        // 处理数据
        $purchade->apply_status = $statsu;
        $purchade->group_status = $statsu;
        // 写入数据
        $res = $purchade->save();
        // 返回数据
        return \RSD::wxReponse($res,'M','添加团购审核成功','审核失败');
    }

    /**
     * 名  称 : purchaselibDelete()
     * 功  能 : 删除团购模式数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/02 15:05
     */
    public function purchaselibDelete($delete,$status)
    {
        // TODO :  PurchaseModel 模型
        $purchade = PurchaseModel::get($delete['group_id']);
        // 判断数据
        if($statsu = 1){
            $apply_status = 1;
            $group_status = 2;
        }else{
            $apply_status = 1;
            $group_status = 1;
        }
        // 处理数据
        $purchade->apply_status = $apply_status;
        $purchade->group_status = $group_status;
        // 写入数据
        $res = $purchade->save();
        // 返回数据
        return \RSD::wxReponse($res,'M','添加团购审核成功','审核失败');
    }
}