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


class SearchScenicService
{
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
     * 输  入 : '$get['scenic_name']  => '景区名称';'
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
}