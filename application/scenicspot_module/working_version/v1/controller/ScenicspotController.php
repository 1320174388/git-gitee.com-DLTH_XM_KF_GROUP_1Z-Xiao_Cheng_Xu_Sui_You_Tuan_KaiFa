<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicspotController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\scenicspot_module\working_version\v1\controller;
use think\Controller;
use app\scenicspot_module\working_version\v1\service\ScenicspotService;

class ScenicspotController extends Controller
{
    /**
     * 名  称 : scenicspotPost()
     * 功  能 : 添加轮播图接口接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['imageFile']  => '图片资源';'
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 输  入 : '$post['imageSort']  => '景区排序';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/25 13:43
     */
    public function scenicspotPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $scenicspotService = new ScenicspotService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $scenicspotService->scenicspotAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}