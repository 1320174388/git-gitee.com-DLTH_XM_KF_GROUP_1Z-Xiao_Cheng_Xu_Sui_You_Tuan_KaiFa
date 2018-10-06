<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RealnameDao.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/09/15 00:00
 *  文件描述 :  实名认证模块数据层
 *  历史记录 :  -----------------------
 */
namespace app\realname_module\working_version\v1\dao;
use app\realname_module\working_version\v1\model\UsersModel;

class RealnameDao implements RealnameInterface
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : realnameCreate()
     * 功  能 : 用户实名认证数据处理
     * 变  量 : --------------------------------------
     * 输  入 : (string)    $user_phone        =>  用户手机号  【必填】
     * 输  入 : (string)    $user_identity        =>  身份证号  【必填】
     * 输  入 : (string)    $user_name       =>  真实姓名  【必填】
     * 输  入 : (string)    $user_token       =>  用户token  【必填】
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/15 00:06
     */
    public function realnameCreate($post)
    {
        // UsersModel 模型
        $users = new UsersModel();
        $res = $users->save(['user_identity'=>md5($post['user_identity']),
                        'user_name'=>$post['user_name'],
                        'user_status'=>1,
                        'user_phone'=>$post['user_phone']],
                        ['user_token'=>$post['user_token']]);
        return \RSD::wxReponse($res,'M','认证成功','认证失败');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : realnameselect()
     * 功  能 : 查询实名制状态
     * 变  量 : --------------------------------------
     * 输  入 : (string)    $user_token        =>  用户token  【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/15 00:06
     */
    public function realnameselect($get)
    {
        // UsersModel 模型
        $users = new UsersModel();
        //执行查询
      $res = $users->where('user_token',$get['user_token'])
                ->field('user_status')->find();

      if ($res['user_status'] == 1){
          $result = true;
      }else{
           $result= false;
      }
        return \RSD::wxReponse($result,'M','以认证','未认证');

    }
}
