<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SearchScenicService.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  用户端景区逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\service;
use app\user_module\working_version\v1\dao\SearchScenicDao;
use app\user_module\working_version\v1\library\SearchScenicLibrary;
use app\user_module\working_version\v1\validator\SearchScenicValidateGet;
use app\user_module\working_version\v1\validator\ScenicCommentPost;


class SearchScenicService
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : searchScreenListShow()
     * 功  能 : 筛选景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$get['x']  => 'x轴坐标';'
     * 输  入 : '$get['y']  => 'y轴坐标';'
     * 输  入 : '$get['Price']  => '价格';'
     * 输  入 : '$get['heat']  => '热度';'
     * 输  入 : '$get['range']  => '距离';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function searchScreenListShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'x'         => 'require',
            'y'         => 'require',
        ],[
            'x.require'         => '缺少x参数',
            'y.require'         => '缺少y参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->searchScreenListSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : searchScenicShow()
     * 功  能 : 模糊搜索景区逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function searchScenicShow($get)
    {
        // 实例化验证器代码
        $validate  = new SearchScenicValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $searchScenicDao = new SearchScenicDao();
        
        // 执行Dao层逻辑
        $res = $searchScenicDao->searchScenicSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : accurateScenicShow()
     * 功  能 : 精准搜索景区逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function accurateScenicShow($get)
    {
        // 实例化验证器代码
        $validate  = new SearchScenicValidateGet();

        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 实例化Dao层数据类
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->accurateScenicSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicInfoShow()
     * 功  能 : 获取景区详细信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicInfoShow($get)
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
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicInfoSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCarouselShow()
     * 功  能 : 获取景区轮播图信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCarouselShow($get)
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
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicCarouselSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicLinkmanShow()
     * 功  能 : 获取景区客服人员信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicLinkmanShow($get)
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
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicLinkmanSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCommentShow()
     * 功  能 : 获取景区客服人员信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  入 : '$get['page_num']  => '分页数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCommentShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'scenic_id'         => 'require',
            'page_num'          => 'require',
        ],[
            'scenic_id.require'         => '缺少scenic_id参数',
            'page_num.require'          => '缺少page_num参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicCommentSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicCommentService()
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
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicCommentService($post)
    {
        // 实例化验证器代码
        $validate  = new ScenicCommentPost();

        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        // 实例化Dao层数据类
        $searchScenicDao = new SearchScenicDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicCommentDao($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

}