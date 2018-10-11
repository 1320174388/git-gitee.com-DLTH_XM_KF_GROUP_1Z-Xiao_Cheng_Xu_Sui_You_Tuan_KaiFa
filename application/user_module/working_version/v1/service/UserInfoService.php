<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserInfoController.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/06 09:54
 *  文件描述 :  用户信息控制器
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\service;

use app\user_module\working_version\v1\dao\UserInfoDao;

class UserInfoService
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : userInfoShow()
     * 功  能 : 获取用户信息及会员信息
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function userInfoShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'user_token'         => 'require',
        ],[
            'user_token.require'         => '缺少user_token参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }
        // 实例化Dao层数据类
        $searchScenicDao = new UserInfoDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->UserInfoSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : vipExplainShow()
     * 功  能 : 获取会员权益说明
     * 变  量 : --------------------------------------
     * 输  入 : '$get['member_id']  => '会员主键';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function vipExplainShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'member_id'         => 'require',
        ],[
            'member_id.require'         => '缺少member_id参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }
        // 实例化Dao层数据类
        $searchScenicDao = new UserInfoDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->vipExplainSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : extendShow()
     * 功  能 : 获取推广人员列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function extendShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'user_token'         => 'require',
            'num'                => 'require',
        ],[
            'user_token.require'         => '缺少user_token参数',
            'num.require'                => '缺少num参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }
        // 实例化Dao层数据类
        $searchScenicDao = new UserInfoDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->extendSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : userGroupListService()
     * 功  能 : 获取个人团购列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['group_status']  => '团购状态';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function userGroupListService($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'user_token'         => 'require',
            'group_status'       => 'require',
        ],[
            'user_token.require'         => '缺少user_token参数',
            'group_status.require'       => '缺少group_status参数',
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }
        // 实例化Dao层数据类
        $searchScenicDao = new UserInfoDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->userGroupListDao($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}