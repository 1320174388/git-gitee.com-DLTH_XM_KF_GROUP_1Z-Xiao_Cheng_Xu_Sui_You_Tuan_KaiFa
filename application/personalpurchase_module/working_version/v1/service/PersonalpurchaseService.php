<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalpurchaseService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\service;
use app\personalpurchase_module\working_version\v1\dao\PersonalpurchaseDao;
use app\personalpurchase_module\working_version\v1\library\PersonalpurchaseLibrary;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidatePost;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidateGet;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidatePut;
use app\personalpurchase_module\working_version\v1\validator\PersonalpurchaseValidateDelete;

class PersonalpurchaseService
{
    /**
     * 名  称 : personalpurchaseAdd()
     * 功  能 : 个人购票逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenic_id']    => '景区ID';
     * 输  入 : $post['group_id']     => '团购ID';
     * 输  入 : $post['group_type']   => '购票类型:1=个人,2=发起团购,3=加入团购,4=发起预约,5=加入预约';
     * 输  入 : $post['token']        => '用户token';
     * 输  入 : $post['coupon_id']    => '优惠券ID不使用发0';
     * 输  入 : $post['invitation']   => '邀请状态标识:yes/no';
     * 输  入 : $post['invitanumber'] => '邀请订单号';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 14:29
     */
    public function personalpurchaseAdd($post)
    {
        // 实例化验证器代码
        $validate  = new PersonalpurchaseValidatePost();

        // 判断邀请状态标识是否发送
        if(empty($post['invitation'])){
            $post['invitation'] = 'no';
        }
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 团购标识是否发送
        if(
            ($post['group_type']!='1')&&
            (empty($post['group_id']))&&
            (!is_numeric($post['group_id']))
        ){
            return ['msg'=>'error','data'=>'请正确发送团购ID'];
        }

        // 判断邀请状态标识是否发送
        if(
            ($post['invitation']!='no')&&
            ($post['invitation']!='yes')
        ){
            return ['msg'=>'error','data'=>'请正确发送邀请状态标识'];
        }

        // 判断订单号是否发送
        if(
            ($post['group_type']=='3')||
            ($post['group_type']=='5')||
            ($post['invitation']=='yes')
        ){
            if(empty($post['invitanumber'])){
                return returnData('error','请发送邀请码或加入订单号');
            }
        }

        // 验证购票类型
        if(
            ($post['group_type']!='1')&&
            ($post['group_type']!='2')&&
            ($post['group_type']!='3')&&
            ($post['group_type']!='4')&&
            ($post['group_type']!='5')
        ){
            return returnData('error','请正确发送购票类型');
        }
        
        // 实例化Dao层数据类
        $personalpurchaseDao = new PersonalpurchaseDao();
        
        // 执行Dao层逻辑
        $res = $personalpurchaseDao->personalpurchaseCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}