<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivitcontService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\service;
use app\activity_module\working_version\v1\dao\ActivitcontDao;
use app\activity_module\working_version\v1\library\ActivitcontLibrary;
use app\activity_module\working_version\v1\validator\ActivitcontValidatePost;
use app\activity_module\working_version\v1\validator\ActivitcontValidateGet;
use app\activity_module\working_version\v1\validator\ActivitcontValidatePut;
use app\activity_module\working_version\v1\validator\ActivitcontValidateDelete;

class ActivitcontService
{
    /**
     * 名  称 : activitcontAdd()
     * 功  能 : 添加活动详情逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $post['ActivityId']       => '活动ID';
     * 输  入 : (String) $post['ActivityType']     => '内容类型';
     * 输  入 : (String) $post['ActivityCont']     => '活动内容';
     * 输  入 : (String) $post['ActivitySort']     => '活动排序';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 09:35
     */
    public function activitcontAdd($post)
    {
        // 实例化验证器代码
        $validate  = new ActivitcontValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证数据
        if(
            ($post['ActivityType']!=='text')&&
            ($post['ActivityType']!=='image')
        ){
            return returnData('error','请正确发送内容类型');
        }

        // 验证数据
        if($post['ActivityType']=='text'){
            if(empty($post['ActivityCont'])){
                return returnData('error','请发送内容');
            }
        }

        // 验证数据
        if($post['ActivityType']=='image'){
            // 判断文件资源是否上传
            $imageUploads = imageUploads(
                'ActivityCont',
                './uploads/activitycont/',
                '/uploads/activitycont/'
            );
            if($imageUploads['msg']=='error'){
                return returnData('error','请发送文件数据');
            }
            $post['ActivityCont'] = $imageUploads['data'];
        }

        // 实例化Dao层数据类
        $activitcontDao = new ActivitcontDao();
        
        // 执行Dao层逻辑
        $res = $activitcontDao->activitcontCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : activitcontDel()
     * 功  能 : 删除活动详情逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ContentId']       => '内容ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 10:49
     */
    public function activitcontDel($delete)
    {
        // 实例化验证器代码
        $validate  = new ActivitcontValidateDelete();
        
        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $activitcontDao = new ActivitcontDao();
        
        // 执行Dao层逻辑
        $res = $activitcontDao->activitcontDelete($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : activitcontShow()
     * 功  能 : 获取活动详情列表逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityId']       => '活动ID';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:54
     */
    public function activitcontShow($get)
    {
        // 实例化验证器代码
        $validate  = new ActivitcontValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $activitcontDao = new ActivitcontDao();
        
        // 执行Dao层逻辑
        $res = $activitcontDao->activitcontSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}