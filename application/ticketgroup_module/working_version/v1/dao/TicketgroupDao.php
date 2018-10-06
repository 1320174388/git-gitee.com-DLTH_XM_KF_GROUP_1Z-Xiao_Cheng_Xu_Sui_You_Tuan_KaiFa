<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketgroupDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购数据层
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;
use app\ticketgroup_module\working_version\v1\model\OperationModel;
use app\ticketgroup_module\working_version\v1\model\TicketlistModel;
use app\ticketgroup_module\working_version\v1\model\TicketgroupModel;

class TicketgroupDao implements TicketgroupInterface
{
    /**
     * 名  称 : ticketgroupSelect()
     * 功  能 : 获取门票信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区ID';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/27 20:31
     */
    public function ticketgroupSelect($get)
    {
        // TODO :  TicketgroupModel 模型
        $scenic = TicketgroupModel::get($get['scenic_id']);
        // TODO :  判断当前进去是否存在
        if(!$scenic){
            return returnData('error','景区不存在');
        }
        // TODO :  获取景区门票价格数据
        $ticket = TicketlistModel::where(
            'scenic_id',$get['scenic_id']
        )->where(
            'ticket_status',0
        )->find();
        // 判断是有门票修改申请
        if($ticket){ $ticket = 1; }else{ $ticket = 0; }
        // 返回数据
        return \RSD::wxReponse($scenic,'M',[
            'secnic_ticket' => $scenic['scenic_ticket'],
            'ticket_status' => $ticket,
        ],'请求失败');
    }

    /**
     * 名  称 : ticketgroupUpdate()
     * 功  能 : 修改门票金额数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  入 : $put['ticket_money'] => '门票价格';
     * 输  入 : $put['form_id']      => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 10:23
     */
    public function ticketgroupUpdate($put)
    {
        // TODO :  TicketgroupModel 模型
        $scenic = TicketgroupModel::get($put['scenic_id']);
        // TODO :  判断景区是否纯在
        if(!$scenic){
            return returnData('error','景区不存在');
        }
        // TODO :  获取景区信息，判断是不是VIP景区
        if($scenic['scenic_type']==1){
            $scenic->scenic_ticket = $put['ticket_money'];
            $res = $scenic->save();
            return \RSD::wxReponse($res,'M','修改成功','修改失败');
        }else{
            // 判断是否有变更申请
            $result = TicketlistModel::get($put['scenic_id']);
            if($result){
                return returnData('error','门票数据更新已在申请中');
            }
            // 启动事务
            \think\Db::startTrans();
            try {
                // 示例话景区门票表模型
                $ticket = new TicketlistModel();
                // 处理数据
                $ticket->scenic_id     = $put['scenic_id'];
                $ticket->ticket_money  = $put['ticket_money'];
                $ticket->ticket_status = 0;
                // 写入数据
                $res = $ticket->save();
                if($res){
                    // TODO : 实例化 景区申请表模型
                    $operation = new OperationModel();
                    // TODO : 处理数据
                    $operation->user_token        = $put['user_token'];
                    $operation->scenic_id         = $put['scenic_id'];
                    $operation->josn              = json_encode([
                        'scenic_id'=>$put['scenic_id']
                    ],320);
                    $operation->class_name        = 'app\ticketgroup_module\working_'.
                        'version\v1\library\TicketputLibrary';
                    $operation->function_name     = 'ticketputLibPut';
                    $operation->operation_content = '【'.$scenic['scenic_name'].
                        '】申请修改门票价格为【'.$put['ticket_money'].'元】。';
                    $operation->operation_status  = 0;
                    $operation->form_id           = $put['form_id'];
                    // TODO : 写入数据
                    $operation->save();
                }
                \think\Db::commit();
                return \RSD::wxReponse(true,'M','更新审核');
            } catch (\Exception $e) {
                // 回滚事务
                \think\Db::rollback();
                return \RSD::wxReponse(false,'M','','添加失败');
            }
        }
    }
}