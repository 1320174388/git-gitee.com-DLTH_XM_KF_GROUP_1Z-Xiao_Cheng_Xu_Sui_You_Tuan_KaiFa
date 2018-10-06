<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  DeductionsDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 14:10
 *  文件描述 :  扣除景区押金数据层
 *  历史记录 :  -----------------------
 */
namespace app\deductions_module\working_version\v1\dao;
use app\deductions_module\working_version\v1\model\AdminprofitModel;
use app\deductions_module\working_version\v1\model\AdminbalanceModel;
use app\deductions_module\working_version\v1\model\DepositModel;
use app\deductions_module\working_version\v1\model\DepositdeductModel;

class DeductionsDao implements DeductionsInterface
{
    /**
     * 名  称 : deductionsUpdate()
     * 功  能 : 扣除景区押金数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['ScenicId']   => '景区主键';
     * 输  入 : $put['Deduction']  => '扣除原因';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/06 17:05
     */
    public function deductionsUpdate($put)
    {
        // TODO : 获取景区押金数据
        $deposit = DepositModel::where(
            'scenic_id',$put['ScenicId']
        )->where(
            'deposit_state',1
        )->find();
        // 验证数据
        if(!$deposit){
            return returnData('error','该景区押金已扣除还未支付');
        }
        // 启动事务
        \think\Db::startTrans();
        try {
            // 写入押金扣除数据表
            $depositDeduct = new DepositdeductModel();
            $depositDeduct->scenic_id         = $put['ScenicId'];
            $depositDeduct->deduct_money      = $deposit['deposit_money'];
            $depositDeduct->deposit_deduction = $put['Deduction'];
            $depositDeduct->deposit_time      = time();
            $depositDeduct->save();
            // 写入景区收入表中
            $adminProfit = new AdminprofitModel();
            $adminProfit->profit_money  = $deposit['deposit_money'];
            $adminProfit->profit_source = '扣除景区押金获得';
            $adminProfit->profit_time   = time();
            $adminProfit->profit_type   = 1;
            $adminProfit->save();
            // 写入数据到押金月表
            $adminBalance = AdminbalanceModel::get(1);
            $adminBalance->balance_money = math_add(
                $deposit['deposit_money'],
                $adminBalance['balance_money']
            );
            $adminBalance->save();
            $deposit->deposit_money = 0;
            $deposit->deposit_state = 0;
            $deposit->save();
            // 提交事务
            \think\Db::commit();
            return returnData('success','押金扣除成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error',$e);
        }


    }
}