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
use app\wx_payment_module\working_version\v1\controller\IndexController;
class ScenicController extends Controller
{
    /**
     * 名  称 : scenicPost()
     * 功  能 : 景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['scenic_name']  => '景区名称';'
     * 输  入 : '$post['scenic_img']  => '景区图片';'
     * 输  入 : '$post['scenic_address']  => '景区地址';'
     * 输  入 : '$post['scenic_man']  => '景区负责人';'
     * 输  入 : '$post['scenic_phone']  => '联系电话';'
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
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->scenicAdd($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : scenicPost()
     * 功  能 : 景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区ID';
     * 输  入 : '$post['scenic_license']  => '执照照片路径';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function imgPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->imgPost($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
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
        $schoolid = $request->post('scenic_id');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->obtainScenic($schoolid);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
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
        $schoolid = $request->post('scenic_id');
        $scenicstatus = $request->post('scenic_status');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->modifyScenic($schoolid, $scenicstatus);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : obtainApplication()
     * 功  能 : 默认获取景区申请列表
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainApplication(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 执行Service逻辑
        $res = $ScenicService->obtainApplication();

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : scenicApplication()
     * 功  能 : 获取景区申请列表
     * 变  量 : '$post['scenic_type']  => '景区类型';
     * 变  量 : '$post['scenic_status']  => '景区状态';
     * 变  量 : '$post['pagination']  => '分页';
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicApplication(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->scenicApplication($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区类型接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenictype['scenic_type']  => '景区类型';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicVip(\think\Request $request)
    {
        // 获取传值
        $schoolid = $request->post('scenic_id');
        $scenictype = $request->post('scenic_type');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->scenicVip($schoolid, $scenictype);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : singleScenic()
     * 功  能 : 搜索单个景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_identity']  => '用户身份证';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function singleScenic(\think\Request $request)
    {
        // 获取传值
        $useridentity = $request->post('user_identity');
        if (!$useridentity) return returnResponse(2, '请发送身份证号');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->singleScenic($useridentity);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : singleUser()
     * 功  能 : 搜索用户接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_identity']  => '用户身份证';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function singleUser(\think\Request $request)
    {
        // 获取传值
        $useridentity = $request->post('user_identity');
        if (!$useridentity) return returnResponse(2, '请发送身份证号');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->singleUser($useridentity);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : scenicModify()
     * 功  能 : 修改景区信息接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  入 : '$post['scenic_man']  => '景区负责人';'
     * 输  入 : '$post['scenic_phone']  => '联系电话';'
     * 输  入 : '$post['scenic_x']  => '景区x坐标';'
     * 输  入 : '$post['scenic_y']  => '景区y坐标';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicModify(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->scenicModify($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : modifyAdmin()
     * 功  能 : 修改景区管理员接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function modifyAdmin(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->modifyAdmin($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : membershipSel()
     * 功  能 : 获取会员卡信息接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function membershipSel(\think\Request $request)
    {
        // 引入Service逻辑层代码
        $res = (new ScenicService())->membershipSel();
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : integralSel()
     * 功  能 : 获取管理积分接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function integralSel(\think\Request $request)
    {
        // 引入Service逻辑层代码
        $res = (new ScenicService())->integralSel();
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : integralUpt()
     * 功  能 : 修改管理积分接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['integral_id']  => '积分获得主键';
     * 输  入 : '$post['integral_transaction']  => '交易积分';
     * 输  入 : '$post['integral_spread  ']  => '推广积分';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function integralUpt(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->integralUpt($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '修改成功');
    }

    /**
     * 名  称 : userIntegral()
     * 功  能 : 获取用户积分接口
     * 变  量 : $post['user_token']  => '用户TOKEN'
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function userIntegral(\think\Request $request)
    {
        // 获取传入参数
        $usertoken = $request->post('user_token');
        // 引入Service逻辑层代码
        $res = (new ScenicService())->userIntegral($usertoken);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : userintegralUpt()
     * 功  能 : 修改用户积分接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['int_transaction']  => '用户积分';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function userintegralUpt(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->userintegralUpt($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : depositscenicUpt()
     * 功  能 : 修改景区押金接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['deposit_money']  => '景区押金';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositscenicUpt(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->depositscenicUpt($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : membershipUpt()
     * 功  能 : 修改会员卡接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['member_id']  => '会员卡主键';
     * 输  入 : '$post['member_name']  => '会员卡名称';
     * 输  入 : '$post['member_integral']  => '会员卡积分额度';
     * 输  入 : '$post['member_text']  => '会员卡权益说明';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function membershipUpt(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->membershipUpt($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : scenicList()
     * 功  能 : 获取申请通过的景区列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_status']  => '景区状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicList(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->scenicList($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : groupProportion()
     * 功  能 : 获取预约团购扣除比例接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function groupProportion(\think\Request $request)
    {
        // 引入Service逻辑层代码
        $res = (new ScenicService())->groupProportion();
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : groupUpt()
     * 功  能 : 修改预约团购扣除比例接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['bespeak_id']  => '主键';
     * 输  入 : '$post['deductions']  => '扣费比例';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function groupUpt(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->groupUpt($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : exchangeTicket()
     * 功  能 : 兑换门票接口(显示门票内容)
     * 变  量 : --------------------------------------
     * 输  入 : '$post['order_number']  => '订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function exchangeTicket(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->exchangeTicket($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : confirmexchangeTicket()
     * 功  能 : 确认兑换门票接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['order_number']  => '订单号';
     * 输  入 : '$post['ticket_sratus']  => '门票状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function confirmexchangeTicket(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->confirmexchangeTicket($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : prizeTicket()
     * 功  能 : 兑换奖品接口(显示奖品内容)
     * 变  量 : --------------------------------------
     * 输  入 : '$post['prize_id']  => '奖品主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function prizeTicket(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->prizeTicket($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : confirmprizeTicket()
     * 功  能 : 确认兑换奖品接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['prize_id']  => '奖品主键';
     * 输  入 : '$post['prize_status']  => '奖品状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function confirmprizeTicket(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->confirmprizeTicket($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : activeStatus()
     * 功  能 : 修改活动状态接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['activity_id']  => '活动主键';
     * 输  入 : '$post['activity_status']  => '活动状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function activeStatus(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->activeStatus($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : depositDeduction()
     * 功  能 : 获取押金扣除记录列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositDeduction(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->depositDeduction($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : scenicDeposit()
     * 功  能 : 获取景区押金接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicDeposit(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->scenicDeposit($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : sceniccustomerserviceDel()
     * 功  能 : 删除景区客服接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['service_id']  => '客服主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function sceniccustomerserviceDel(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->sceniccustomerserviceDel($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : depositPayment()
     * 功  能 : 判断用户是否支付景区押金
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositPayment(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->depositPayment($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : customerAdd()
     * 功  能 : 景区添加客服接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['service_name']  => '客服名称';
     * 输  入 : '$post['service_phone']  => '客服电话';
     * 输  入 : '$post['service_position']  => '客服职位';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function customerAdd(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->customerAdd($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S');
    }


    /**
     * 名  称 : customerSel()
     * 功  能 : 获取景区客服列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function customerSel(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->customerSel($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : customerUpt()
     * 功  能 : 修改景区客服接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['service_id']  => '客服主键';
     * 输  入 : '$post['service_name']  => '客服名称';
     * 输  入 : '$post['service_phone']  => '客服电话';
     * 输  入 : '$post['service_position']  => '客服职位';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function customerUpt(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->customerUpt($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : Comment()
     * 功  能 : 获取景区评论列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function Comment(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->Comment($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : coupon()
     * 功  能 : 领取个人优惠券接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';
     * 输  入 : '$post['index_id']  => '    奖品或优惠券主键';
     * 输  入 : '$post['bag_type']  => '    类型 【奖品、优惠券】';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function coupon(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->coupon($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : couponReceive()
     * 功  能 : 判断用户是否已经领取优惠券
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['index_id']  => '优惠劵主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function couponReceive(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->couponReceive($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : grouppurchaseList()
     * 功  能 : 获取景区下正在进行的团购列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['group_status']  => '    存在状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function grouppurchaseList(\think\Request $request, $pagination)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->grouppurchaseList($post, $pagination);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : fightGroup()
     * 功  能 : 查看拼团是否完成
     * 变  量 : --------------------------------------
     * 输  入 : '$post['group_number']  => '订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function fightGroup(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->fightGroup($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : personalPrize()
     * 功  能 : 领取个人奖品接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['index_id']  => '奖品或优惠券主键';
     * 输  入 : '$post['bag_type']  => '类型 【奖品、优惠券】';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function personalPrize(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->personalPrize($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : personalCoupon()
     * 功  能 : 查询个人优惠券列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['bag_status']  => '状态';
     * 输  入 : '$post['bag_type']  => '类型 【奖品、优惠券】';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function personalCoupon(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->personalCoupon($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }


    /**
     * 名  称 : personalCustomers()
     * 功  能 : 获取个人团购信息
     * 变  量 : --------------------------------------
     * 输  入 : '$post['group_number']  => '订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function personalCustomers(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $ScenicService = new ScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $ScenicService->personalCustomers($post);

        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }

    /**
     * 名  称 : scenicPoints()
     * 功  能 : 获取景区押金接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicPoints(\think\Request $request)
    {
        // 获取传值
        $schoolid = $request->post();
        // 引入Service逻辑层代码
        $res = (new ScenicService())->scenicPoints($schoolid);
        if ($res['msg'] == 'error') return returnResponse(2, $res['data']);
        // 处理函数返回值
        return \RSD::wxReponse($res, 'S', '请求成功');
    }
}