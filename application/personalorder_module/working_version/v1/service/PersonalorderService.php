<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalorderService.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/10 19:29
 *  文件描述 :  个人订单逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\personalorder_module\working_version\v1\service;
use app\personalorder_module\working_version\v1\dao\PersonalorderDao;
use app\personalorder_module\working_version\v1\library\PersonalorderLibrary;
use app\personalorder_module\working_version\v1\validator\PersonalorderValidatePost;
use app\personalorder_module\working_version\v1\validator\PersonalorderValidateGet;
use app\personalorder_module\working_version\v1\validator\PersonalorderValidatePut;
use app\personalorder_module\working_version\v1\validator\PersonalorderValidateDelete;

class PersonalorderService
{
    /**
     * 名  称 : personalorder()
     * 功  能 : 根据token状态，查询出景区表内
     * 变  量 : --------------------------------------
     * 输  入 : user_token    => 'user_token;
     * 输  出 : [ 'msg' => 'success','data' => [ 'token'=>$token ] ]
     * 输  出 : [ 'msg' => 'error',  'data' => $data['data'] ]
     * 创  建 : 2018/06/12 21:50
     */
    public function PersonalorderService($post)
    {
        $validate = new \think\Validate([
            'user_token' => 'require',
        ],[
            'user_token.require' => '请发送token值',
        ]);
        if(!$validate->check($post)){
            return returnData('error',$validate->getError());
        }
        // 实例化Dao层数据类
        $userOrder = new PersonalorderDao();

        //执行Dao层逻辑
        $res = $userOrder->personalorder($post);

        //处理函数返回值
        return \RSD::wxReponse($res,'D');

    }


}