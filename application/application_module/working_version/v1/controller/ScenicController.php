<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicController.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请控制器
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\controller;
use think\Controller;
use app\application_module\working_version\v1\service\ScenicService;

class ScenicController extends Controller
{
    /**
     * 名  称 : scenicPost()
     * 功  能 : 景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['scenic_name']  => '景区名称';'
     * 输  入 : '$post['scenic_img']  => '景区图片';'
     * 输  入 : '$post['scenic_address']  => '景区地址';'
     * 输  入 : '$post['scenic_man']  => '景区负责人';'
     * 输  入 : '$post['scenic_phone']  => '联系电话';'
     * 输  入 : '$post['scenic_license']  => '执照照片路径';'
     * 输  入 : '$post['scenic_x']  => '景区x坐标';'
     * 输  入 : '$post['scenic_y']  => '景区y坐标';'
     * 输  入 : '$post['scenic_type']  => '景区类型';'
     * 输  入 : '$post['scenic_ticket']  => '景区门票';'
     * 输  入 : '$post['scenic_status']  => '申请状态';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $scenicService = new ScenicService();
        // 获取传入参数
        $scenicid = $request->post('scenic_id');
        $usertoken = $request->post('user_token');
        $scenicname = $request->post('scenic_name');
        $scenicimg = $request->post('scenic_img');
        $scenicaddress = $request->post('scenic_address');
        $scenicman = $request->post('scenic_man');
        $scenicphone = $request->post('scenic_phone');
        $sceniclicense = $request->post('scenic_license');
        $scenicx = $request->post('scenic_x');
        $scenicy = $request->post('scenic_y');
        $scenictype = $request->post('scenic_type');
        $scenicticket = $request->post('scenic_ticket');
        $scenicstatus = $request->post('scenic_status');

        // 执行Service逻辑
        $res = $scenicService->scenicAdd($scenicid,$usertoken,$scenicname,$scenicimg,$scenicaddress,
            $scenicman,$scenicphone,$sceniclicense,$scenicx,$scenicy,$scenictype,$scenicticket,$scenicstatus);
        
        // 处理函数返回值
        return returnResponse(0,'添加成功',$res['data']);
    }



    /**
     * 名  称 : obtainScenic()
     * 功  能 : 获取景区列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainScenic(\think\Request $request)
    {
        // 获取传值
        $schoolid  = $request->post('scenic_id');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->obtainScenic($schoolid);
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回数据
        return returnResponse(0,'查询成功',$res['data']);
    }

    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenicstatus['scenic_status']  => '景区申请状态';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function modifyScenic(\think\Request $request)
    {
        // 获取传值
        $schoolid  = $request->post('scenic_id');
        $scenicstatus  = $request->post('scenic_status');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->modifyScenic($schoolid,$scenicstatus);
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回数据
        return returnResponse(0,'修改成功',$res['data']);
    }
}