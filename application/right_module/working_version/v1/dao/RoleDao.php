<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\AdminModel;
use app\right_module\working_version\v1\model\RoleModel;
use app\right_module\working_version\v1\model\RoleRight;
use app\right_module\working_version\v1\model\UserModel;
use app\right_module\working_version\v1\model\RightModel;

class RoleDao implements RoleInterface
{
    /**
     * 名  称 : roleCreate()
     * 功  能 : 添加职位数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token']=> '管理标识';
     * 输  入 : $post['role_name']  => '职位名称';
     * 输  入 : $post['role_class'] => '职位分组';
     * 输  入 : $post['right_str']  => '权限ID字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/19 18:40
     */
    public function roleCreate($post)
    {
        // TODO : 获取数据
        $data = RoleModel::where(
            'role_name',$post['role_name']
        )->where(
            'role_class',$post['role_class']
        )->find();
        // TODO : 判断数据
        if($data){
            return \RSD::wxReponse(false,'M','','角色已存在');
        }

        // 获取管理员名称
        $userName = ''; $this->getAdminName($post,$userName);

        // 启动事务
        \think\Db::startTrans();
        try {
            // 获取权限数据
            $post['right_array'] = explode(',',$post['right_str']);
            // TODO : 实例化 RoleModel 模型
            $role = new RoleModel();
            // TODO : 处理数据
            $role->role_name  = $post['role_name'];
            $role->role_class = $post['role_class'];
            $role->role_insert= $userName;
            $role->role_right = json_encode($post['right_array'],320);
            $role->role_time  = time();
            // TODO : 写入数据
            $role->save();
            // TODO : 获取数据
            $data = RoleModel::where(
                'role_name',$post['role_name']
            )->where(
                'role_class',$post['role_class']
            )->find();
            // 处理数据
            $rightArray = [];
            foreach($post['right_array'] as $k => $v){
                if(is_numeric($v)){
                    $rightArray[] = [
                        'role_id'  => $data['role_id'], 'right_id' => $v
                    ];
                }
            }
            // 写入权限
            $roleRight = new RoleRight();
            $roleRight->saveAll($rightArray);
            // 提交事务
            \think\Db::commit();
            return returnData('success','添加成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','添加失败');
        }
    }

    /**
     * 获取管理名称
     */
    private function getAdminName($post,&$userName){
        // TODO :  判断是否是最高管理员，获取所有职位
        if(($post['role_class']=='0')&&($this->userIsAdmin($post))){
            $userName = 'Boss';
        }else{
            // TODO :  判断是不是当前组最高管理员，获取所有职位
            if(($post['role_class']!=='0')&&($this->userIsClassAdmin($post))){
                $userName = 'Boss';
            }else{
                // TODO : 获取管理
                $userName =  AdminModel::where(
                    'admin_token',$post['admin_token']
                )->where(
                    'admin_class',$post['role_class']
                )->find()['admin_name'];
            }
        }
    }

    /**
     * 名  称 : roleSelect()
     * 功  能 : 获取职位信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理标识';
     * 输  入 : $get['role_class']  => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/20 16:14
     */
    public function roleSelect($get)
    {
        // TODO :  判断是否是最高管理员，获取所有职位
        if(($get['role_class']=='0')&&($this->userIsAdmin($get))){
            $res = $this->roleListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'当前还没有添加职位,请添加职位'
            );
        }
        // TODO :  判断是不是当前组最高管理员，获取所有职位
        if(($get['role_class']!=='0')&&($this->userIsClassAdmin($get))){
            $res = $this->roleListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'当前还没有添加职位,请添加职位'
            );
        }

        // TODO :  获取职位信息
        $res = $this->roleAdminListGet($get);
        return \RSD::wxReponse(
            $res,'M',$res,'没有下级职位'
        );
    }

    /**
     * 判断用户是不是小程序最高管理员
     */
    private function userIsAdmin($get)
    {
        // TODO :  UserModel 模型
        $token = UserModel::get(1)['user_token'];
        // TODO :  判断用户是否是最高管理员
        if(($token == $get['admin_token'])
            &&($get['role_class']=='0')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取小程序最高权限组所有职位
     */
    private function roleListGet($get)
    {
        // TODO :  RoleModel 模型，返回权限数据列表
        return RoleModel::where(
            'role_class',
            $get['role_class']
        )->select()->toArray();
    }

    /**
     * 判断用户是不是小程序其他分组最高管理员
     */
    private function userIsClassAdmin($get)
    {
        // TODO :  AdminModel 模型
        $type = AdminModel::where(
            'admin_token',$get['admin_token']
        )->where(
            'admin_class',$get['role_class']
        )->where(
            'admin_type',1
        )->where(
            'admin_status',1
        )->find();
        // TODO :  判断用户是否是最高管理员
        if($type){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取管理员可管理职位信息
     */
    private function roleAdminListGet($get)
    {
        // TODO :  AdminModel 模型，返回权限数据列表
        $right =  AdminModel::Distinct(true)->field(
            config('v1_tableName.Data_Right_Lists').'.*'
        )->leftJoin(
            config('v1_tableName.Index_Admin_Roles'),
            config('v1_tableName.Data_User_Admins').'.admin_id = '.
            config('v1_tableName.Index_Admin_Roles').'.admin_id'
        )->leftJoin(
            config('v1_tableName.Data_Role_Lists'),
            config('v1_tableName.Index_Admin_Roles').'.role_id = '.
            config('v1_tableName.Data_Role_Lists').'.role_id'
        )->leftJoin(
            config('v1_tableName.Index_Role_Rights'),
            config('v1_tableName.Data_Role_Lists').'.role_id = '.
            config('v1_tableName.Index_Role_Rights').'.role_id'
        )->leftJoin(
            config('v1_tableName.Data_Right_Lists'),
            config('v1_tableName.Index_Role_Rights').'.right_id = '.
            config('v1_tableName.Data_Right_Lists').'.right_id'
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_token',
            $get['admin_token']
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_class',
            $get['role_class']
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_status',
            1
        )->where(
            config('v1_tableName.Data_Role_Lists').'.role_class',
            $get['role_class']
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_status',
            1
        )->select()->toArray();


        // TODO :  RightModel 模型，返回职位数据列表
        $role =  RightModel::Distinct(true)->field(
            config('v1_tableName.Data_Role_Lists').'.*'
        )->leftJoin(
            config('v1_tableName.Index_Role_Rights'),
            config('v1_tableName.Data_Right_Lists').'.right_id = '.
            config('v1_tableName.Index_Role_Rights').'.right_id'
        )->leftJoin(
            config('v1_tableName.Data_Role_Lists'),
            config('v1_tableName.Index_Role_Rights').'.role_id = '.
            config('v1_tableName.Data_Role_Lists').'.role_id'
        )->leftJoin(
            config('v1_tableName.Index_Admin_Roles'),
            config('v1_tableName.Data_Role_Lists').'.role_id = '.
            config('v1_tableName.Index_Admin_Roles').'.role_id'
        )->where(
            config('v1_tableName.Data_Role_Lists').'.role_class',
            $get['role_class']
        );
        $str = '';
        foreach($right as $v){
            $str .= $v['right_id'].',';
        };
        // 添加查询条件
        $role = $role->where(
            config('v1_tableName.Index_Role_Rights').'.right_id',
            'in',rtrim($str,',')
        );

        // 获取数据
        $role = $role->select()->toArray();

        // 获取数组
        $role_array = explode(',',rtrim($str,','));

        // 新数据
        $roleNewArr = [];
        $resArrNum = count($role);
        foreach($role as $v){
            $types = true;
            $arrNum = 0;
            foreach(json_decode($v['role_right'],true) as $j){
                if(!in_array($j,$role_array)){
                    $types = false;
                }
                $arrNum++;
            }
            if(($types)&&($arrNum<$resArrNum)){
                $roleNewArr[] = $v;
            }
        }

        // 返回数据
        return $roleNewArr;
    }

    /**
     * 名  称 : roleUpdate()
     * 功  能 : 修改职位信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['role_id']     => '职位ID';
     * 输  入 : $put['admin_token'] => '管理标识';
     * 输  入 : $put['role_name']   => '职位名称';
     * 输  入 : $put['role_class']  => '职位分组';
     * 输  入 : $put['right_str']   => '权限ID字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/21 10:13
     */
    public function roleUpdate($put)
    {
        // TODO : 获取数据
        $data = RoleModel::where(
            'role_name',$put['role_name']
        )->where(
            'role_class',$put['role_class']
        )->find();
        // TODO : 判断数据
        if(($data)&&($data['role_id']!=$put['role_id'])){
            return \RSD::wxReponse(false,'M','','角色已存在');
        }
        // 获取管理员名称
        $userName = ''; $this->getAdminName($put,$userName);
        // 启动事务
        \think\Db::startTrans();
        try {
            // 获取权限数据
            $put['right_array'] = explode(',',$put['right_str']);
            // TODO : 实例化 RoleModel 模型
            $role = RoleModel::get($put['role_id']);
            if(!$role){
                return \RSD::wxReponse(false,'M','','职位不存在');
            }
            // TODO : 处理数据
            $role->role_name  = $put['role_name'];
            $role->role_class = $put['role_class'];
            $role->role_insert= $userName;
            $role->role_right = json_encode($put['right_array'],320);
            $role->role_time  = time();
            // TODO : 写入数据
            $role->save();
            // 处理数据
            $rightArray = [];
            foreach($put['right_array'] as $k => $v){
                if(is_numeric($v)){
                    $rightArray[] = [
                        'role_id'  => $put['role_id'], 'right_id' => $v
                    ];
                }
            }
            RoleRight::where(
                'role_id',$put['role_id']
            )->delete();
            // 写入权限
            $roleRight = new RoleRight();
            $roleRight->saveAll($rightArray);
            // 提交事务
            \think\Db::commit();
            return returnData('success','修改成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','修改失败');
        }
    }

    /**
     * 名  称 : roleDelete()
     * 功  能 : 删除职位信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['role_id']     => '职位ID';
     * 输  入 : $delete['role_class']  => '职位分组';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/21 15:17
     */
    public function roleDelete($delete)
    {
        // TODO : 获取数据
        $data = RoleModel::where(
            'role_id',$delete['role_id']
        )->where(
            'role_class',$delete['role_class']
        )->find();
        // TODO : 判断数据
        if(!$data){
            return \RSD::wxReponse(false,'M','','要删除职位不存在');
        }
        // 启动事务
        \think\Db::startTrans();
        try {
            $data->delete();
            RoleRight::where(
                'role_id',$delete['role_id']
            )->delete();
            // 提交事务
            \think\Db::commit();
            return returnData('success','删除成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','删除失败');
        }
    }

}
