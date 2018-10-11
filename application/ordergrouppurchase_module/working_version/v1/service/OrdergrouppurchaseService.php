<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrdergrouppurchaseService.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 11:06
 *  文件描述 :  通过团购邀请码获取个人信息逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\ordergrouppurchase_module\working_version\v1\service;
use app\ordergrouppurchase_module\working_version\v1\dao\OrdergrouppurchaseDao;
use app\ordergrouppurchase_module\working_version\v1\library\OrdergrouppurchaseLibrary;
use app\ordergrouppurchase_module\working_version\v1\validator\OrdergrouppurchaseValidatePost;
use app\ordergrouppurchase_module\working_version\v1\validator\OrdergrouppurchaseValidateGet;
use app\ordergrouppurchase_module\working_version\v1\validator\OrdergrouppurchaseValidatePut;
use app\ordergrouppurchase_module\working_version\v1\validator\OrdergrouppurchaseValidateDelete;

class OrdergrouppurchaseService
{
    /**
     * 名  称 : ordergrouppurchase()
     * 功  能 : 获取团购信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : group_invite    => 'group_invite';
     * 输  出 : [ 'msg' => 'success','data' => [ 'token'=>$token ] ]
     * 输  出 : [ 'msg' => 'error',  'data' => $data['data'] ]
     * 创  建 : 2018/10/11 15:20
     */
    public function ordergrouppurchaseService($get)
    {
        $validate = new \think\Validate([
            'group_number'=>'require',
        ],[
            'group_number.require'=>'没有订单号'
        ]);
        if(!$validate->check($get)){
            return returnData('error',$validate->getError());
        }
        //实例化Dao层逻辑
        $userOrder = new OrdergrouppurchaseDao();

        //执行Dao层数据
        $res = $userOrder->OrdergrouppurchaseDao($get);

        //处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

}