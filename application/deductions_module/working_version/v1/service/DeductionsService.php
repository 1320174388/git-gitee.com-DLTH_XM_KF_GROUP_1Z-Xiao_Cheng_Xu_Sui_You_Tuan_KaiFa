<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  DeductionsService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 14:10
 *  文件描述 :  扣除景区押金逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\deductions_module\working_version\v1\service;
use app\deductions_module\working_version\v1\dao\DeductionsDao;
use app\deductions_module\working_version\v1\library\DeductionsLibrary;
use app\deductions_module\working_version\v1\validator\DeductionsValidatePost;
use app\deductions_module\working_version\v1\validator\DeductionsValidateGet;
use app\deductions_module\working_version\v1\validator\DeductionsValidatePut;
use app\deductions_module\working_version\v1\validator\DeductionsValidateDelete;

class DeductionsService
{
    /**
     * 名  称 : deductionsEdit()
     * 功  能 : 扣除景区押金逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $put['ScenicId']   => '景区主键';
     * 输  入 : $put['Deduction']  => '扣除原因';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/06 17:05
     */
    public function deductionsEdit($put)
    {
        // 实例化验证器代码
        $validate  = new DeductionsValidatePut();
        
        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $deductionsDao = new DeductionsDao();
        
        // 执行Dao层逻辑
        $res = $deductionsDao->deductionsUpdate($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicLevelShow()
     * 功  能 : 获取景区平均星级
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id']   => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/06 17:05
     */
    public function scenicLevelShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'scenic_id'         => 'require',
        ],[
            'scenic_id.require'         => '缺少scenic_id参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $deductionsDao = new DeductionsDao();

        // 执行Dao层逻辑
        $res = $deductionsDao->scenicLevelSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}