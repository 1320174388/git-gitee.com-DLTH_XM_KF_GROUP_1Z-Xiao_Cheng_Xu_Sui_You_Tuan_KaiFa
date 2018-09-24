<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 09:45
 *  文件描述 :  权限管理~管理员管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\UserModel;
use app\right_module\working_version\v1\model\AdminModel;
use app\right_module\working_version\v1\model\AdminRole;
use app\right_module\working_version\v1\library\AccessTokenRequest;
use app\right_module\working_version\v1\library\TemplateMessagePushLibrary;

class AdminDao implements AdminInterface
{
    /**
     * 名  称 : adminCreate()
     * 功  能 : 管理员申请数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']  => '管理标识';
     * 输  入 : $post['admin_name']   => '管理姓名';
     * 输  入 : $post['admin_phone']  => '联系电话';
     * 输  入 : $post['admin_class']  => '管理分组';
     * 输  入 : $post['right_class']  => '权限分组';
     * 输  入 : $post['admin_formid'] => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 09:43
     */
    public function adminCreate($post)
    {
        // TODO :  AdminModel 模型
        $userIsToken = $this->userIs(
            'admin_token',$post['admin_token'],$post['admin_class']
        );
        // TODO :  验证数据，返回数据
        if($userIsToken){
            return returnData('error','您的账号已经申请过管理员');
        }
        // TODO :  AdminModel 模型
        $userIsToken = $this->userIs(
            'admin_name',$post['admin_name'],$post['admin_class']
        );
        // TODO :  验证数据，返回数据
        if($userIsToken){
            return returnData('error','管理员名称已存在');
        }
        // TODO :  AdminModel 模型
        $userIsPhone = $this->userIs(
            'admin_phone',$post['admin_phone'],$post['admin_class']
        );
        // TODO :  验证数据，返回数据
        if($userIsPhone){
            return returnData('error','此联系电话已经申请过管理员');
        }

        // TODO :  实例化模型
        $admin = new AdminModel();
        // TODO :  处理数据
        $admin->admin_token  = $post['admin_token'];
        $admin->admin_name   = $post['admin_name'];
        $admin->admin_phone  = $post['admin_phone'];
        $admin->admin_type   = 2;
        $admin->admin_class  = $post['admin_class'];
        $admin->admin_status = 0;
        $admin->admin_time   = time();
        $admin->right_class  = $post['right_class'];
        $admin->admin_formid = $post['admin_formid'];
        // TODO :  保存数据
        $res = $admin->save();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M','申请成功','申请失败');
    }

    /**
     * 判断管理员名称是否存在
     */
    private function userIs($string,$admin_token,$admin_class)
    {
        // TODO :  AdminModel 模型
        return AdminModel::where(
            $string,$admin_token
        )->where(
            'admin_class',$admin_class
        )->where(
            'admin_status','in','0,1'
        )->find();
    }

    /**
     * 名  称 : adminSelect()
     * 功  能 : 获取管理员申请列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_class']  => '管理分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 16:14
     */
    public function adminSelect($get)
    {
        // TODO :  AdminModel 模型
        $res = AdminModel::where(
            'admin_class',$get['admin_class']
        )->select()->toArray();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M',$res,'请求失败');
    }

    /**
     * 名  称 : adminUpdate()
     * 功  能 : 审核管理员接口数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']     => '管理ID';
     * 输  入 : $put['admin_to']     => '审核状态';
     * 输  入 : $put['role_str']     => '职位ID字符窜';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 17:20
     */
    public function adminUpdate($put)
    {
        // 启动事务
        \think\Db::startTrans();
        try {
            // TODO :  AdminModel 模型
            $admin = AdminModel::get($put['admin_id']);
            // TODO :  判断用户是否存在
            if(!$admin){
                return returnData('error','审核用户不存在');
            }
            // 判断用户是否已经过审核
            if($admin['admin_status']==1){
                return returnData('error','管理员已过审核');
            }

            // 处理审核结果
            $red    = ($put['admin_to']=='yes')?'通过':'未通过';
            $status = ($put['admin_to']=='yes')?1:2;

            // TODO :  处理数据
            $roleArr = explode(',',$put['role_str']);

            // TODO :  获取success_token
            $accessTokenArr = AccessTokenRequest::wxRequest(
                config('v1_config.wx_AppID'),
                config('v1_config.wx_AppSecret'),
                './project_access_token/'
            );

            // TODO :  获取openid
            $user = UserModel::field('user_openid')->where(
                'user_token',$admin['admin_token']
            )->find();

            // 发送模板消息
            TemplateMessagePushLibrary::sendTemplate(
                $accessTokenArr['data']['access_token'],
                [
                    'touser'      => $user['user_openid'],
                    'template_id' => config('v1_config.Wx_Code_ShenHe'),
                    'page'        => config('v1_config.Wx_Code_Url'),
                    'form_id'     => $admin['admin_formid'],
                    'data'        => [
                        'keyword1' => ['value'=>$admin['admin_name']],
                        'keyword2' => ['value'=>$admin['admin_phone']],
                        'keyword3' => ['value'=>$red],
                        'keyword4' => ['value'=>date(
                            'Y-m-d H:i',$admin['admin_time']
                        )],
                    ],
                ]
            );

            // TODO :  处理数据
            $admin->admin_status = $status;
            $admin->admin_right  = json_encode($roleArr,320);
            // TODO :  修改数据
            $admin->save();

            if($status==2){
                // 提交事务
                \think\Db::commit();
                return returnData('success','审核成功');
            }
            // 处理数据
            $roleArray = [];
            foreach($roleArr as $k => $v){
                if(is_numeric($v)){
                    $roleArray[] = [
                        'admin_id'  => $put['admin_id'], 'role_id' => $v
                    ];
                }
            }
            // 写入职位
            $adminRole = new AdminRole();
            $adminRole->saveAll($roleArray);

            // 提交事务
            \think\Db::commit();
            return returnData('success','审核成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','审核失败');
        }
    }
}
