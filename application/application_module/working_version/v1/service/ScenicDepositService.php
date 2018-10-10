<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicService.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区押金逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\service;

use app\application_module\working_version\v1\dao\ScenicDepositDao;

class ScenicDepositService
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicExtractService()
     * 功  能 : 提现景区押金
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['deposit_money']  => '提现金额';'
     * 输  出 : ['msg'=>'success','data'=>'请求数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicExtractService($post)
    {
        // 验证数据
        $validate = new \think\Validate([
            'user_token'        => 'require',
            'scenic_id'         => 'require',
            'deposit_money'     => 'require',
        ],[
            'user_token.require'        => '缺少user_token参数',
            'scenic_id.require'         => '缺少scenic_id参数',
            'deposit_money.require'     => '缺少deposit_money参数',
        ]);
        if (!$validate->check($post)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $searchScenicDao = new ScenicDepositDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicDepositExtractDao($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicBalanceShow()
     * 功  能 : 获取景区余额表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicBalanceShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'scenic_id'         => 'require'
        ],[
            'scenic_id.require'         => '缺少scenic_id参数'
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $searchScenicDao = new ScenicDepositDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicBalanceSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicProfitShow()
     * 功  能 : 获取景区收益信息列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"请求数据"}
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicProfitShow($get)
    {
        // 验证数据
        $validate = new \think\Validate([
            'scenic_id'         => 'require',
            'num'               => 'require'
        ],[
            'scenic_id.require'         => '缺少scenic_id参数',
            'num.require'               => '缺少num参数'
        ]);
        if (!$validate->check($get)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $searchScenicDao = new ScenicDepositDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->scenicProfitSelect($get);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : balanceExtractService()
     * 功  能 : 提现景区余额
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['balance_money']  => '提现金额';'
     * 输  出 : ['msg'=>'success','data'=>'请求数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function balanceExtractService($post)
    {
        // 验证数据
        $validate = new \think\Validate([
            'user_token'        => 'require',
            'scenic_id'         => 'require',
            'balance_money'     => 'require',
        ],[
            'user_token.require'        => '缺少user_token参数',
            'scenic_id.require'         => '缺少scenic_id参数',
            'balance_money.require'     => '缺少balance_money参数',
        ]);
        if (!$validate->check($post)) {
            return returnData('error',$validate->getError());
        }

        // 实例化Dao层数据类
        $searchScenicDao = new ScenicDepositDao();

        // 执行Dao层逻辑
        $res = $searchScenicDao->balanceExtractDao($post);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}