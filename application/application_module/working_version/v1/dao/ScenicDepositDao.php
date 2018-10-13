<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicDao.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区押金数据层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\dao;

use app\application_module\working_version\v1\model\DepositModel;
use app\application_module\working_version\v1\library\EnterprisePay;
use app\application_module\working_version\v1\model\HomeUsers;
use app\application_module\working_version\v1\model\UserModel;
use app\application_module\working_version\v1\model\ExtractListModel;
use app\application_module\working_version\v1\model\ScenicProfitModel;
use app\application_module\working_version\v1\model\ScenicBalanceModel;
class ScenicDepositDao
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicDepositExtractDao()
     * 功  能 : 提现景区押金
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['deposit_money']  => '提现金额';'
     * 输  出 : ['msg'=>'success','data'=>'请求数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicDepositExtractDao($post)
    {
        //创建模型
        $opject = new DepositModel();
        //判断用户是否 为管理员
        $isAdmin = $opject->where([
            'scenic_id' => $post['scenic_id'],
            'user_token' => $post['user_token']
        ])->find();
        //返回结果
        if (!$isAdmin){
            return returnData('error','非法操作');
        }
        //提现金额不能超过押金数量
        if ((int)$post['deposit_money'] > (int)$isAdmin['deposit_money']){
            return returnData('error','不能超过押金数量');
        }
        //获取用户openid
        $homeUsers = HomeUsers::Where('user_token',$post['user_token'])
                                ->field('user_openid')
                                ->find();
        //获取用户真实姓名
        $userName = UserModel::Where('user_token',$post['user_token'])
                    ->field('user_name')
                    ->find();

        //开启事务
        \think\Db::startTrans();

        //创建模型
        $opject = DepositModel::where('scenic_id',$post['scenic_id'])->find();
        //修改押金数量
        $res = $opject->setDec('deposit_money',(int)$post['deposit_money']);
        //押金为0 更新状态
        if ($opject->deposit_money <= 0){
            $opject->deposit_state = 0;
            $opject->save();
        }

        //传入配置信息
        $extract = new EnterprisePay(
            config('pay_config.AppId'),
            config('pay_config.Merchant'),
            config('pay_config.Key'),
            config('pay_config.CertPath'),
            config('pay_config.KeyPath')
        );
       $extractRes = $extract->pay([
                    //用户openid
                    'openid'        => $homeUsers['user_openid'],
                    //企业付款描述信息
                    'desc'          => '景区押金提现',
                    //收款用户姓名
                    're_user_name'  => $userName['user_name'],
                    //金额 单位分
                    'amount'        => (int)$post['deposit_money']*100
                  ]);
       if($extractRes['msg'] == 0){
            //插入提现表
           $extract = new ExtractListModel();
           $extract->save([
               'user_token' => $post['user_token'],
               'scenic_id' => $post['scenic_id'],
               'extract_money' => $post['deposit_money'],
               'extract_type' => 3
           ]);
           //提交事务
           \think\Db::commit();
           return returnData('success','提现成功');
       }else{
           //事务回滚
           \think\Db::rollback();
           return returnData('error',$extractRes['data']['err_code_des']);
       }
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicBalanceSelect()
     * 功  能 : 获取景区余额表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  出 : ['msg'=>'success','data'=>'请求数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicBalanceSelect($get)
    {
        //创建模型
        $opject = new ScenicBalanceModel();
        //查询
       $res = $opject->where('scenic_id',$get['scenic_id'])
                ->find();
       //返回结果
        return \RSD::wxReponse($res,'M',$res,'没有数据');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : scenicProfitSelect()
     * 功  能 : 获取景区收益列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区id';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : ['msg'=>'success','data'=>'请求数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function scenicProfitSelect($get)
    {
        //创建模型
        $opject = new ScenicProfitModel();
        //查询
        $res = $opject->where('scenic_id',$get['scenic_id'])
                    ->limit($get['num'],12)
                    ->select()
                    ->toArray();
        //返回结果
        return \RSD::wxReponse($res,'M',$res,'没有数据');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : balanceExtractDao()
     * 功  能 : 提现景区余额
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['balance_money']  => '提现金额';'
     * 输  出 : ['msg'=>'success','data'=>'请求数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function balanceExtractDao($post)
    {
        //创建景区余额模型
        $scenicBalance = new ScenicBalanceModel();
        //获取景区余额
        $money = $scenicBalance->where('scenic_id',$post['scenic_id'])
                                ->field('balance_money')
                                ->find();
        //返回余额不足
        if((int)$money['balance_money'] < (int)$post['balance_money']){
            return returnData('error','余额不足');
        }
        //获取用户openid
        $homeUsers = HomeUsers::Where('user_token',$post['user_token'])
            ->field('user_openid')
            ->find();
        //获取用户真实姓名
        $userName = UserModel::Where('user_token',$post['user_token'])
            ->field('user_name')
            ->find();

        //传入配置信息
        $extract = new EnterprisePay(
            config('pay_config.AppId'),
            config('pay_config.Merchant'),
            config('pay_config.Key'),
            config('pay_config.CertPath'),
            config('pay_config.KeyPath')
        );
        $extractRes = $extract->pay([
            //用户openid
            'openid'        => $homeUsers['user_openid'],
            //企业付款描述信息
            'desc'          => '景区余额提现',
            //收款用户姓名
            're_user_name'  => $userName['user_name'],
            //金额 单位分
            'amount'        => (int)$post['balance_money']*100
        ]);
        //开始事务
        \think\Db::startTrans();

        if($extractRes['msg'] == 0){
            //更新景区余额
            $res = $scenicBalance->where('scenic_id',$post['scenic_id'])
                ->setDec('balance_money',
                    (int)$post['balance_money']);
            //插入提现表
            $extract = new ExtractListModel();
            $extract->save([
                'user_token'    => $post['user_token'],
                'scenic_id'     => $post['scenic_id'],
                'extract_money' => $post['balance_money'],
                'extract_type'  => 2,
            ]);
            if($res){
                //提交事务
                \think\Db::commit();
                return returnData('success','提现成功');
            }else{
                //事务回滚
                \think\Db::rollback();
                return returnData('error','提现失败');
            }
        }else{
            //事务回滚
            \think\Db::rollback();
            return returnData('error',$extractRes['data']['err_code_des']);
        }

    }
}