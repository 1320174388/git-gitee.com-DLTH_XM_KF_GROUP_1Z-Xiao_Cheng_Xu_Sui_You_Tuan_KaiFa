<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  GrouppurchaselistService.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 19:23
 *  文件描述 :  查询未完成团购内容逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\grouppurchaselist_module\working_version\v1\service;
use app\grouppurchaselist_module\working_version\v1\dao\GrouppurchaselistDao;
use app\grouppurchaselist_module\working_version\v1\library\GrouppurchaselistLibrary;
use app\grouppurchaselist_module\working_version\v1\validator\GrouppurchaselistValidatePost;
use app\grouppurchaselist_module\working_version\v1\validator\GrouppurchaselistValidateGet;
use app\grouppurchaselist_module\working_version\v1\validator\GrouppurchaselistValidatePut;
use app\grouppurchaselist_module\working_version\v1\validator\GrouppurchaselistValidateDelete;

class GrouppurchaselistService
{
    /**
     * 名  称 : grouppurchaselist()
     * 功  能 : 根据group_status状态，查询出个人及团购订单表
     * 变  量 : --------------------------------------
     * 输  入 : group_status    => 'group_status'
     * 输  出 : [ 'msg' => 'success','data' => [ 'token'=>$token ] ]
     * 输  出 : [ 'msg' => 'error',  'data' => $data['data'] ]
     * 创  建 : 2018/10/11 19:23
     */
    public function GrouppurchaselistService($get)
    {
        /**
         * 名  称 : grouppurchaselist()
         * 功  能 : 根据token状态，查询出景区表内
         * 变  量 : --------------------------------------
         * 输  入 : group_status    => '0';
         * 输  出 : [ 'msg' => 'success','data' => [ 'token'=>$token ] ]
         * 输  出 : [ 'msg' => 'error',  'data' => $data['data'] ]
         * 创  建 : 2018/06/12 21:50
         */
        //实例化Dao层
        $userOrder = new GrouppurchaselistDao();

        //执行Dao层逻辑
        $res = $userOrder->GrouppurchaselistDao($get);

        //处理函数返回值
        return \RSD::wxReponse($res,'D');

    }
}