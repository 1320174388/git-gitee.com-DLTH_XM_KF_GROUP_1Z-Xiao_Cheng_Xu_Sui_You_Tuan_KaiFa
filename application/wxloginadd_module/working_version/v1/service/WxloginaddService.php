<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxloginaddService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\wxloginadd_module\working_version\v1\service;
use app\wxloginadd_module\working_version\v1\dao\WxloginaddDao;
use app\wxloginadd_module\working_version\v1\library\WxloginaddLibrary;
use app\wxloginadd_module\working_version\v1\validator\WxloginaddValidatePost;
use app\wxloginadd_module\working_version\v1\validator\WxloginaddValidateGet;
use app\wxloginadd_module\working_version\v1\validator\WxloginaddValidatePut;
use app\wxloginadd_module\working_version\v1\validator\WxloginaddValidateDelete;

class WxloginaddService
{
    /**
     * 名  称 : wxloginaddAdd()
     * 功  能 : 授权登录逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['userToken']  => '用户token';
     * 输  入 : $post['avatarUrl']  => '用户头像';
     * 输  入 : $post['nickName']   => '用户昵称';
     * 输  入 : $post['gender']     => '用户昵称';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/10 22:36
     */
    public function wxloginaddAdd($post)
    {
        // 实例化验证器代码
        $validate  = new WxloginaddValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $wxloginaddDao = new WxloginaddDao();
        
        // 执行Dao层逻辑
        $res = $wxloginaddDao->wxloginaddCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}