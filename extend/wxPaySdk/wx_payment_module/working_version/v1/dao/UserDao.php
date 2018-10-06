<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserModel.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/07/26 15:20
 *  文件描述 :  用户信息操作层
 *  历史记录 :  -----------------------
 */
namespace app\wx_payment_module\working_version\v1\dao;
use app\wx_payment_module\working_version\v1\model\UserModel;
class UserDao
{
    /**
     * 名  称 : getOpenid()
     * 创  建 : 2018/08/14 16:40
     * 功  能 : 通过token获取openid
     * 变  量 : --------------------------------------
     * 输  入 : (string)  $token  => `用户token`
     * 输  出 : [ 'msg' => 'success', 'data' => openid ]
     */
    public function getOpenid($token)
    {
        //执行数据查询
        $result = (new UserModel())->where('user_token',$token)->find();
        //返回结果
        if ($result)
        {
            return returnData('success',$result->toArray());
        }else
        {
            return returnData('error',false);
        }

    }
}
