<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  DeductionsController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 14:10
 *  文件描述 :  扣除景区押金控制器
 *  历史记录 :  -----------------------
 */
namespace app\deductions_module\working_version\v1\controller;
use think\Controller;
use app\deductions_module\working_version\v1\service\DeductionsService;

class DeductionsController extends Controller
{
    /**
     * 名  称 : deductionsPut()
     * 功  能 : 扣除景区押金接口
     * 变  量 : --------------------------------------
     * 输  入 : $put['ScenicId']   => '景区主键';
     * 输  入 : $put['Deduction']  => '扣除原因';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/06 17:05
     */
    public function deductionsPut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $deductionsService = new DeductionsService();
        
        // 获取传入参数
        $put = $request->put();
        
        // 执行Service逻辑
        $res = $deductionsService->deductionsEdit($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicLevelGet()
     * 功  能 : 获取景区平均星级
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id']   => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/06 17:05
     */
    public function scenicLevelGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $deductionsService = new DeductionsService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $deductionsService->scenicLevelShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}