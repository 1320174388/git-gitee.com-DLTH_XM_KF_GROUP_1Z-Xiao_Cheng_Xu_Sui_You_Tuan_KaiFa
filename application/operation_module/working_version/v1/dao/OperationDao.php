<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OperationDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\operation_module\working_version\v1\dao;
use app\operation_module\working_version\v1\model\OperationModel;

class OperationDao implements OperationInterface
{
    /**
     * 名  称 : operationSelect()
     * 功  能 : 获取所有景区申请信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['limitNum']  => '当前已有信息数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:00
     */
    public function operationSelect($get)
    {
        // TODO :  OperationModel 模型
        $status1 = OperationModel::field(
            config('wx_sgy_config.SGY_DataOperation').'.operation_id,'.
            config('wx_sgy_config.SGY_Users_Lists').'.user_name,'.
            config('wx_sgy_config.SGY_DataScenicList').'.scenic_name,'.
            config('wx_sgy_config.SGY_DataOperation').'.operation_content,'.
            config('wx_sgy_config.SGY_DataOperation').'.operation_status'
        )->leftJoin(
            config('wx_sgy_config.SGY_Users_Lists'),
            config('wx_sgy_config.SGY_DataOperation').'.user_token = '.
            config('wx_sgy_config.SGY_Users_Lists').'.user_token'
        )->leftJoin(
            config('wx_sgy_config.SGY_DataScenicList'),
            config('wx_sgy_config.SGY_DataOperation').'.scenic_id = '.
            config('wx_sgy_config.SGY_DataScenicList').'.scenic_id'
        )->where(
            config('wx_sgy_config.SGY_DataOperation').'.operation_status',1
        )->select()->toArray();
        $status0 = OperationModel::field(
            config('wx_sgy_config.SGY_DataOperation').'.operation_id,'.
            config('wx_sgy_config.SGY_Users_Lists').'.user_name,'.
            config('wx_sgy_config.SGY_DataScenicList').'.scenic_name,'.
            config('wx_sgy_config.SGY_DataOperation').'.operation_content,'.
            config('wx_sgy_config.SGY_DataOperation').'.operation_status'
        )->leftJoin(
            config('wx_sgy_config.SGY_Users_Lists'),
            config('wx_sgy_config.SGY_DataOperation').'.user_token = '.
            config('wx_sgy_config.SGY_Users_Lists').'.user_token'
        )->leftJoin(
            config('wx_sgy_config.SGY_DataScenicList'),
            config('wx_sgy_config.SGY_DataOperation').'.scenic_id = '.
            config('wx_sgy_config.SGY_DataScenicList').'.scenic_id'
        )->where(
            config('wx_sgy_config.SGY_DataOperation').'.operation_status',0
        )->limit($get['limitNum'],12)->select()->toArray();
        // 返回数据
        return \RSD::wxReponse(true,'M',[
            'status1'=>$status1,
            'status0'=>$status0,
        ]);
    }

    /**
     * 名  称 : operationUpdate()
     * 功  能 : 审核景区操作数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['OperationId']     => '申请主键';'
     * 输  入 : '$get['OperationStatus'] => '审核状态';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/06 10:37
     */
    public function operationUpdate($put)
    {
        // TODO :  OperationModel 模型
        $operation = OperationModel::get($put['OperationId']);
        // 启动事务
        \think\Db::startTrans();
        try {
            $operation->operation_status = $put['OperationStatus'];
            $operation->save();
            $toexamine = new $operation['class_name']();
            $res = $toexamine->$operation['function_name'](
                json_decode($operation['josn'],true),$put['OperationStatus']
            );
            if($res['msg']=='error'){
                return returnData('error',$res['data']);
            }
            // 提交事务
            \think\Db::commit();
            return returnData('success','审核成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','审核失败');
        }
    }
}