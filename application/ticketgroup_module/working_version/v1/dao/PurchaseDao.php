<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaseDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购数据层
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;
use app\ticketgroup_module\working_version\v1\model\PurchaseModel;
use app\ticketgroup_module\working_version\v1\model\OperationModel;
use app\ticketgroup_module\working_version\v1\model\TicketgroupModel;

class PurchaseDao implements PurchaseInterface
{
    /**
     * 名  称 : purchaseCreate()
     * 功  能 : 添加团购模式数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']  => '用户标识';
     * 输  入 : $post['scenic_id']   => '景区主键';
     * 输  入 : $post['group_money'] => '团购价格';
     * 输  入 : $post['group_num']   => '团购人数';
     * 输  入 : $post['form_id']     => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 20:31
     */
    public function purchaseCreate($post)
    {
        // TODO :  TicketgroupModel 模型
        $scenic = TicketgroupModel::get($post['scenic_id']);
        // TODO :  判断景区是否纯在
        if(!$scenic){
            return returnData('error','景区不存在');
        }
        if($post['group_num']<=1){
            return returnData('error','团购人数不可以小于1');
        }
        $find = PurchaseModel::where(
            'scenic_id',$post['scenic_id']
        )->where(
            'group_num',$post['group_num']
        )->where(
            'apply_status','in','0,1'
        )->where(
            'group_status','in','0,1'
        )->find();
        if($find){
            return returnData('error','此团购模式已存在');
        }
        // TODO :  获取景区信息，判断是不是VIP景区
        if($scenic['scenic_type']==1){
            // 实例化 PurchaseModel 模型
            $purchase = new PurchaseModel();
            // 处理团购数据
            $purchase->scenic_id    = $post['scenic_id'];
            $purchase->group_money  = $post['group_money'];
            $purchase->group_num    = $post['group_num'];
            $purchase->apply_status = 1;
            $purchase->group_status = 1;
            // 写入数据
            $res = $purchase->save();
            // 返回数据
            return \RSD::wxReponse($res,'M','添加成功','添加失败');
        }else{
            // 启动事务
            \think\Db::startTrans();
            try {
                // 实例化 PurchaseModel 团购模型
                $purchase = new PurchaseModel();
                // 处理数据
                $purchase->scenic_id    = $post['scenic_id'];
                $purchase->group_money  = $post['group_money'];
                $purchase->group_num    = $post['group_num'];
                $purchase->apply_status = 0;
                $purchase->group_status = 0;
                // 写入数据
                $res = $purchase->save();
                if($res){
                    // TODO : 实例化 景区申请表模型
                    $operation = new OperationModel();
                    // TODO : 处理数据
                    $operation->user_token        = $post['user_token'];
                    $operation->scenic_id         = $post['scenic_id'];
                    $operation->josn              = json_encode([
                        'group_id' => $purchase['group_id']
                    ],320);
                    $operation->class_name        = 'app\ticketgroup_module\working_'.
                        'version\v1\library\PurchaselibLibrary';
                    $operation->function_name     = 'purchaselibLibPut';
                    $operation->operation_content = '【'.$scenic['scenic_name'].
                        '】申请添加【'.$post['group_num'].'人,'.$post['group_money'].'元】团购操作。';
                    $operation->operation_status  = 0;
                    $operation->form_id           = $post['form_id'];
                    // TODO : 写入数据
                    $operation->save();
                }
                \think\Db::commit();
                return \RSD::wxReponse(true,'M','添加审核');
            } catch (\Exception $e) {
                // 回滚事务
                \think\Db::rollback();
                return \RSD::wxReponse(false,'M','','添加失败');
            }
        }
    }

    /**
     * 名  称 : purchaseDelete()
     * 功  能 : 删除团购模式数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  入 : $delete['form_id']    => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/29 19:14
     */
    public function purchaseDelete($delete)
    {
        // TODO :  TicketgroupModel 模型
        $scenic = TicketgroupModel::get($delete['scenic_id']);
        // TODO :  判断景区是否纯在
        if(!$scenic){
            return returnData('error','景区不存在');
        }
        // TODO :  判断团购模式是否存在
        $find = PurchaseModel::where(
            'scenic_id',$delete['scenic_id']
        )->where(
            'group_id',$delete['group_id']
        )->where(
            'group_status',1
        )->find();
        if(!$find){
            return returnData('error','团购模式不存在');
        }
        // TODO :  判断是不是VIP景区
        if($scenic['scenic_type']==1){
            // 实例化 PurchaseModel 模型
            $purchase = PurchaseModel::get($delete['group_id']);
            // 处理团购数据
            $purchase->apply_status = 2;
            $purchase->group_status = 2;
            // 写入数据
            $res = $purchase->save();
            // 返回数据
            return \RSD::wxReponse($res,'M','删除成功','删除失败');
        }else{
            // 启动事务
            \think\Db::startTrans();
            try {
                // 实例化 PurchaseModel 团购模型
                $purchase = PurchaseModel::get($delete['group_id']);
                // 判断团购模式
                if(
                    ($purchase['apply_status']==0)&&
                    ($purchase['group_status']==1)
                ) {
                    return \RSD::wxReponse(false,'M','','已在删除申请中');
                }
                // 处理数据
                $purchase->apply_status = 0;
                // 写入数据
                $res = $purchase->save();
                if($res){
                    // TODO : 实例化 景区申请表模型
                    $operation = new OperationModel();
                    // TODO : 处理数据
                    $operation->user_token        = $delete['user_token'];
                    $operation->scenic_id         = $delete['scenic_id'];
                    $operation->josn              = json_encode([
                        'group_id' => $purchase['group_id']
                    ],320);
                    $operation->class_name        = 'app\ticketgroup_module\working_'.
                        'version\v1\library\PurchaselibLibrary';
                    $operation->function_name     = 'purchaselibLibDelete';
                    $operation->operation_content = '【'.$scenic['scenic_name'].
                        '】申请删除【'.$purchase['group_num'].'人,'.$purchase['group_money'].'元】团购操作。';
                    $operation->operation_status  = 0;
                    $operation->form_id           = $delete['form_id'] ;
                    // TODO : 写入数据
                    $operation->save();
                }
                \think\Db::commit();
                return \RSD::wxReponse(true,'M','删除审核');
            } catch (\Exception $e) {
                // 回滚事务
                \think\Db::rollback();
                return \RSD::wxReponse(false,'M','','删除失败');
            }
        }
    }

    /**
     * 名  称 : purchaseSelect()
     * 功  能 : 获取团购模式数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id']  => '景区主键';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/03 10:39
     */
    public function purchaseSelect($get)
    {
        // TODO :  PurchaseModel 模型
        $res = PurchaseModel::where(
            'scenic_id',$get['scenic_id']
        )->where(
            'group_status','in','0,1'
        )->select()->toArray();
        // 返回数据
        return \RSD::wxReponse($res,'M',$res,'当前没有添加团购');
    }
}