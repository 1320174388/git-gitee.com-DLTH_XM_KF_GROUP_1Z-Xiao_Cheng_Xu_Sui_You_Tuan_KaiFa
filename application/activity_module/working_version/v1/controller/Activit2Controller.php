<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Activit2Controller.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\controller;
use think\Controller;
use app\activity_module\working_version\v1\service\Activit2Service;

class Activit2Controller extends Controller
{
    /**
     * 名  称 : activit2Get()
     * 功  能 : 二次获取活动列表接口
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  入 : ( Int )  $get['ActivityLimit']  => '活动数量';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 12:08
     */
    public function activit2Get(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $activit2Service = new Activit2Service();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $activit2Service->activit2Show($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
}