<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\service;
use app\activity_module\working_version\v1\dao\ActivityDao;
use app\activity_module\working_version\v1\library\ActivityLibrary;
use app\activity_module\working_version\v1\validator\ActivityValidatePost;
use app\activity_module\working_version\v1\validator\ActivityValidateGet;
use app\activity_module\working_version\v1\validator\ActivityValidatePut;
use app\activity_module\working_version\v1\validator\ActivityValidateDelete;

class ActivityService
{
    /**
     * 名  称 : activityAdd()
     * 功  能 : 添加活动逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( File ) $post['ActivityFile']   => '活动图片';
     * 输  入 : (String) $post['ActivityTitle']  => '活动标题';
     * 输  入 : (String) $post['ActivityDes']    => '活动介绍';
     * 输  入 : (String) $post['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $post['ActivityStatus'] => '活动状态';
     * 输  入 : ( Int )  $post['ActivityClass']  => '活动分组';
     * 输  入 : (String) $post['ActivityStart']  => '开始时间';
     * 输  入 : (String) $post['ActivityEnd']    => '结束时间';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/03 15:09
     */
    public function activityAdd($post)
    {
        // 实例化验证器代码
        $validate  = new ActivityValidatePost();

        // 处理活动类型参数
        if(empty($post['ActivityType']))
        {
            $post['ActivityType'] = 0;
        }
        // 处理活动状态参数
        if(empty($post['ActivityStatus']))
        {
            $post['ActivityStatus'] = 0;
        }
        // 处理活动分组参数
        if(empty($post['ActivityClass']))
        {
            $post['ActivityClass'] = 0;
        }
        // 处理活动分组参数
        if(empty($post['ActivityStart']))
        {
            $post['ActivityStart'] = '1970-07-01 00:00:00';
        }
        // 处理活动分组参数
        if(empty($post['ActivityEnd']))
        {
            $post['ActivityEnd'] = '1970-07-01 00:00:00';
        }
        // 处理时间
        $post['ActivityStart'] = strtotime($post['ActivityStart']);
        $post['ActivityEnd']   = strtotime($post['ActivityEnd']);

        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'ActivityFile',
            './uploads/activity/',
            '/uploads/activity/'
        );
        if($imageUploads['msg']=='error'){
            return returnData('error','请发送图片数据');
        }
        $post['ActivityFile'] = $imageUploads['data'];
        
        // 实例化Dao层数据类
        $activityDao = new ActivityDao();
        
        // 执行Dao层逻辑
        $res = $activityDao->activityCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : activityShow()
     * 功  能 : 获取活动广告列表逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 11:09
     */
    public function activityShow($get)
    {
        // 实例化验证器代码
        $validate  = new ActivityValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $activityDao = new ActivityDao();
        
        // 执行Dao层逻辑
        $res = $activityDao->activitySelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : activityEdit()
     * 功  能 : 修改活动广告信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( File ) $put['ActivityId']     => '活动主键';
     * 输  入 : ( File ) $put['ActivityFile']   => '活动图片';
     * 输  入 : (String) $put['ActivityTitle']  => '活动标题';
     * 输  入 : (String) $put['ActivityDes']    => '活动介绍';
     * 输  入 : (String) $put['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $put['ActivityStatus'] => '活动状态';
     * 输  入 : ( Int )  $put['ActivityClass']  => '活动分组';
     * 输  入 : (String) $put['ActivityStart']  => '开始时间';
     * 输  入 : (String) $put['ActivityEnd']    => '结束时间';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 12:16
     */
    public function activityEdit($put)
    {
        // 实例化验证器代码
        $validate  = new ActivityValidatePut();

        // 处理活动类型参数
        if(empty($post['ActivityType']))
        {
            $post['ActivityType'] = 0;
        }
        // 处理活动状态参数
        if(empty($post['ActivityStatus']))
        {
            $post['ActivityStatus'] = 0;
        }
        // 处理活动分组参数
        if(empty($post['ActivityClass']))
        {
            $post['ActivityClass'] = 0;
        }
        // 处理活动分组参数
        if(empty($put['ActivityStart']))
        {
            $put['ActivityStart'] = '1970-07-01 00:00:00';
        }
        // 处理活动分组参数
        if(empty($put['ActivityEnd']))
        {
            $put['ActivityEnd']   = '1970-07-01 00:00:00';
        }
        // 处理时间
        $put['ActivityStart'] = strtotime($put['ActivityStart']);
        $put['ActivityEnd']   = strtotime($put['ActivityEnd']);

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'ActivityFile',
            './uploads/activity/',
            '/uploads/activity/'
        );
        if($imageUploads['msg']=='error'){
            $put['ActivityFile'] = 'false';
        }else{
            $put['ActivityFile'] = $imageUploads['data'];
        }

        // 实例化Dao层数据类
        $activityDao = new ActivityDao();
        
        // 执行Dao层逻辑
        $res = $activityDao->activityUpdate($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : activityDel()
     * 功  能 : 删除活动广告信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $delete['ActivityId']     => '活动主键';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/05 14:41
     */
    public function activityDel($delete)
    {
        // 实例化验证器代码
        $validate  = new ActivityValidateDelete();
        
        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $activityDao = new ActivityDao();
        
        // 执行Dao层逻辑
        $res = $activityDao->activityDelete($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}