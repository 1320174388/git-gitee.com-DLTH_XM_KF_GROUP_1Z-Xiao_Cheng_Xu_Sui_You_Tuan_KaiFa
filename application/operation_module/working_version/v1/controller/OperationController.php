<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OperationController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\operation_module\working_version\v1\controller;
use think\Controller;
use app\operation_module\working_version\v1\service\OperationService;

class OperationController extends Controller
{
    /**
     * 名  称 : operationGet()
     * 功  能 : 获取所有景区申请信息接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['limitNum']  => '当前已有信息数量';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/06 10:00
     */
    public function operationGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $operationService = new OperationService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $operationService->operationShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : operationPut()
     * 功  能 : 审核景区操作接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['OperationId']     => '申请主键';'
     * 输  入 : '$get['OperationStatus'] => '审核状态';'
     * 输  入 : '$get['OperationInfo']   => '失败原因';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/06 10:37
     */
    public function operationPut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $operationService = new OperationService();
        
        // 获取传入参数
        $put = $request->put();
        
        // 执行Service逻辑
        $res = $operationService->operationEdit($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}