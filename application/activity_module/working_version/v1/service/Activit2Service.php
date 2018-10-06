<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Activit2Service.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\service;
use app\activity_module\working_version\v1\dao\Activit2Dao;
use app\activity_module\working_version\v1\library\Activit2Library;
use app\activity_module\working_version\v1\validator\Activit2ValidatePost;
use app\activity_module\working_version\v1\validator\Activit2ValidateGet;
use app\activity_module\working_version\v1\validator\Activit2ValidatePut;
use app\activity_module\working_version\v1\validator\Activit2ValidateDelete;

class Activit2Service
{
    /**
     * 名  称 : activit2Show()
     * 功  能 : 二次获取活动列表逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  入 : ( Int )  $get['ActivityLimit']  => '活动数量';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 12:08
     */
    public function activit2Show($get)
    {
        // 实例化验证器代码
        $validate  = new Activit2ValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $activit2Dao = new Activit2Dao();
        
        // 执行Dao层逻辑
        $res = $activit2Dao->activit2Select($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}