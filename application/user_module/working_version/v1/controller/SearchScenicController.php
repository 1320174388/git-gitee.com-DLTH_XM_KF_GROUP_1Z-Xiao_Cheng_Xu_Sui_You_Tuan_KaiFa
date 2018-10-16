<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SearchScenicController.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  用户端景区控制器
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\controller;
use think\Controller;
use app\user_module\working_version\v1\service\SearchScenicService;

class SearchScenicController extends Controller
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : searchScenicGet()
     * 功  能 : 筛选景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['x']  => 'x轴坐标';'
     * 输  入 : '$get['y']  => 'y轴坐标';'
     * 输  入 : '$get['Price']  => '价格';'
     * 输  入 : '$get['heat']  => '热度';'
     * 输  入 : '$get['range']  => '距离';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function searchScreenListGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->searchScreenListShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 作  者 : Feng Tianshui
     * 名  称 : searchScenicGet()
     * 功  能 : 模糊搜索景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function searchScenicGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();
        
        // 获取传入参数
        $get = $request->get();
        
        // 执行Service逻辑
        $res = $searchScenicService->searchScenicShow($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : accurateScenicGet()
     * 功  能 : 精准搜索景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function accurateScenicGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->accurateScenicShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicInfoGet()
     * 功  能 : 获取景区详细信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicInfoGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->scenicInfoShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCarouselGet()
     * 功  能 : 获取景区轮播图
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCarouselGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->scenicCarouselShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicLinkmanGet()
     * 功  能 : 获取景区客服人员信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicLinkmanGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->scenicLinkmanShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCommentGet()
     * 功  能 : 获取景区评论列表信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  入 : '$get['page_num']  => '分页数量';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCommentGet(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $get = $request->get();

        // 执行Service逻辑
        $res = $searchScenicService->scenicCommentShow($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCommentPost()
     * 功  能 : 景区评论接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['group_number']  => '订单号';'
     * 输  入 : '$post['comment_service']  => '服务星级';'
     * 输  入 : '$post['comment_health']  => '卫生星级';'
     * 输  入 : '$post['comment_view']  => '景观星级';'
     * 输  入 : '$post['comment_cosy']  => '舒适度星级';'
     * 输  入 : '$post['comment_content']  => '评论内容';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCommentPost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $searchScenicService = new SearchScenicService();

        // 获取传入参数
        $post = $request->post();

        // 执行Service逻辑
        $res = $searchScenicService->scenicCommentService($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'S');
    }

}