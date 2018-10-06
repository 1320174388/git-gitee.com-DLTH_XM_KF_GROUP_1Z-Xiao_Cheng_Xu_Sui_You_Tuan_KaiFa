<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketputDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购数据层
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;
use app\ticketgroup_module\working_version\v1\model\TicketlistModel;
use app\ticketgroup_module\working_version\v1\model\TicketgroupModel;

class TicketputDao implements TicketputInterface
{
    /**
     * 名  称 : ticketputUpdate()
     * 功  能 : 修改门票数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 15:34
     */
    public function ticketputUpdate($put,$status=1)
    {
        // 启动事务
        \think\Db::startTrans();
        try {
            // TODO :  TicketlistModel 模型
            $ticket = TicketlistModel::get($put['scenic_id']);
            // TODO :  实例化 TicketgroupModel 模型
            $scenic = TicketgroupModel::get($put['scenic_id']);
            if($status==1){
                $scenic->scenic_ticket = $ticket['ticket_money'];
                $scenic->save();
            }
            // 删除景区门票申请数据
            $ticket->delete();
            // 提交事务
            \think\Db::commit();
            return returnData('success','审核成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error',$e);
        }
    }
}