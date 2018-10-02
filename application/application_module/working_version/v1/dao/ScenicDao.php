<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicDao.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请数据层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\dao;
use app\application_module\working_version\v1\model\AdminbespeakModel;
use app\application_module\working_version\v1\model\DepositModel;
use app\application_module\working_version\v1\model\IntegralModel;
use app\application_module\working_version\v1\model\MemberModel;
use app\application_module\working_version\v1\model\ScenicModel;
use app\application_module\working_version\v1\model\UsermemberModel;
use app\application_module\working_version\v1\model\UserModel;
use think\Db;

class ScenicDao
{

    /**
     * 名  称 : scenicCreate()
     * 功  能 : 景区申请数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$usertoken['user_token']  => '用户token';'
     * 输  入 : '$scenicname['scenic_name']  => '景区名称';'
     * 输  入 : '$scenicimg['scenic_img']  => '景区图片';'
     * 输  入 : '$scenicaddress['scenic_address']  => '景区地址';'
     * 输  入 : '$scenicman['scenic_man']  => '景区负责人';'
     * 输  入 : '$scenicphone['scenic_phone']  => '联系电话';'
     * 输  入 : '$scenicx['scenic_x']  => '景区x坐标';'
     * 输  入 : '$scenicy['scenic_y']  => '景区y坐标';'
     * 输  入 : '$scenictype['scenic_type']  => '景区类型';'
     * 输  入 : '$scenicticket['scenic_ticket']  => '景区门票';'
     * 输  入 : '$scenicstatus['scenic_status']  => '申请状态';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicAdd($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();
        // 用户token
        $ScenicModel->user_token	 = $post['user_token'];
        // 景区名称
        $ScenicModel->scenic_name	 = $post['scenic_name'];
        // 景区图片
        $ScenicModel->scenic_img	 = $post['scenic_img'];
        // 景区地址
        $ScenicModel->scenic_address	 = $post['scenic_address'];
        // 景区负责人
        $ScenicModel->scenic_man	 = $post['scenic_man'];
        // 联系电话
        $ScenicModel->scenic_phone	 = $post['scenic_phone'];
        // 执照照片路径
        $ScenicModel->scenic_license	 = $post['scenic_license'];
        // 景区x坐标
        $ScenicModel->scenic_x	 = $post['scenic_x'];
        // 景区y坐标
        $ScenicModel->scenic_y	 = $post['scenic_y'];
        // 景区类型
        $ScenicModel->scenic_type	 = $post['scenic_type'];
        // 景区门票
        $ScenicModel->scenic_ticket	 = $post['scenic_ticket'];
        // 申请状态
        $ScenicModel->scenic_status	 = $post['scenic_status'];
        // 时间
        $ScenicModel->scenic_time	 = time();
        // 保存数据库
        $data = $ScenicModel->save();
        // 验证
        if(!$data){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$data);
    }


    /**
     * 名  称 : scenicPost()
     * 功  能 : 景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区ID';
     * 输  入 : '$post['scenic_license']  => '执照照片路径';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function imgPost($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();
        // 景区ID
        $ScenicModel->scenic_id	 = $post['scenic_id'];
        // 用户token
        $ScenicModel->scenic_license	 = $post['scenic_license'];
        // 保存数据库
        $data = $ScenicModel->save();
        // 验证
        if(!$data){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$data);
    }



    /**
     * 名  称 : obtainScenic()
     * 功  能 : 获取景区列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainScenic($scenicid='')
    {
        $ScenicModel= new ScenicModel();
        if($scenicid == ''){
            $list = $ScenicModel->select();
        }else{
            $list = $ScenicModel->where('scenic_id',$scenicid)->find();
        }
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenicstatus['scenic_status']  => '景区申请状态';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function modifyScenic($schoolid,$scenicstatus)
    {
        $ScenicModel= new ScenicModel();
        // 进行修改
        $res = $ScenicModel->save([
            $ScenicModel->scenic_status    = $scenicstatus
        ],['scenic_id'=>$schoolid]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }



    /**
     * 名  称 : obtainApplication()
     * 功  能 : 默认获取景区申请列表
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainApplication()
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();
        $list1 = $ScenicModel->where('scenic_status',1)->limit(0,6)->select()->toArray();
        $list2 = $ScenicModel->where('scenic_status',0)->limit(0,6)->select()->toArray();
        // 返回数据
        return returnData('success',['list1'=>$list1,'list2'=>$list2]);
    }

    /**
     * 名  称 : scenicApplication()
     * 功  能 : 获取景区申请列表
     * 变  量 : '$post['scenic_type']  => '景区类型';
     * 变  量 : '$post['scenic_status']  => '景区状态';
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicApplication($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();

        $res = $ScenicModel->where('scenic_type',$post['scenic_type'])
            ->where('scenic_status',$post['scenic_status'])
            ->select()->toArray();

        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区类型接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenictype['scenic_type']  => '景区类型';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicVip($schoolid,$scenictype)
    {
        $ScenicModel= new ScenicModel();
        // 进行修改
        $res = $ScenicModel->save([
            $ScenicModel->scenic_type    = $scenictype
        ],['scenic_id'=>$schoolid]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : singleScenic()
     * 功  能 : 搜索单个景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_identity']  => '用户身份证';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function singleScenic($useridentity)
    {
        $UserModel = new UserModel();

        $list = $UserModel->field('user_token')->where('user_identity',$useridentity)
            ->find()->toArray();

        $res = ScenicModel::where('user_token',$list)->find()->toArray();

        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }

    /**
     * 名  称 : singleUser()
     * 功  能 : 搜索用户接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_identity']  => '用户身份证';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function singleUser($useridentity)
    {
        $UserModel = new UserModel();

        $list = $UserModel->where('user_identity',$useridentity)->find()->toArray();

        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : scenicModify()
     * 功  能 : 修改景区信息接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  入 : '$post['scenic_man']  => '景区负责人';'
     * 输  入 : '$post['scenic_phone']  => '联系电话';'
     * 输  入 : '$post['scenic_x']  => '景区x坐标';'
     * 输  入 : '$post['scenic_y']  => '景区y坐标';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicModify($post)
    {
        $ScenicModel= new ScenicModel();
        // 进行修改
        $res = $ScenicModel->save([
            $ScenicModel->scenic_man    = $post['scenic_man'],
            $ScenicModel->scenic_phone    = $post['scenic_phone'],
            $ScenicModel->scenic_x    = $post['scenic_x'],
            $ScenicModel->scenic_y    = $post['scenic_y']
        ],['scenic_id'=>$post['scenic_id']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : modifyAdmin()
     * 功  能 : 修改景区管理员接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function modifyAdmin($post)
    {
        // 启动事务
        Db::startTrans();
        try {
            $ScenicModel= new ScenicModel();
            // 进行修改
            $res = $ScenicModel->save([
                $ScenicModel->user_token    = $post['user_token']
            ],['scenic_id'=>$post['scenic_id']]);
            // 进行修改
            $DepositModel= new DepositModel();
            $res = $DepositModel->save([
                $DepositModel->user_token  = $post['user_token']
            ],['scenic_id'=>$post['scenic_id']]);
            // 验证数据
            if(!$res) return returnData('error');
            Db::commit();
            // 返回数据格式
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error');
        }
    }




    /**
     * 名  称 : membershipSel()
     * 功  能 : 获取会员卡信息接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function membershipSel()
    {
        $MemberModel= new MemberModel();
        //
        $list = $MemberModel->select();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : integralSel()
     * 功  能 : 获取管理积分接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function integralSel()
    {
        $IntegralModel = new IntegralModel();
        // 查询
        $list = $IntegralModel->select();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }

    /**
     * 名  称 : integralUpt()
     * 功  能 : 修改管理积分接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['integral_id']  => '积分获得主键';
     * 输  入 : '$post['integral_transaction']  => '交易积分';
     * 输  入 : '$post['integral_spread  ']  => '推广积分';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function integralUpt($post)
    {
        $IntegralModel = new IntegralModel();
        // 进行修改
        $res = $IntegralModel->save([
            $IntegralModel->integral_transaction    = $post['integral_transaction'],
            $IntegralModel->integral_spread    = $post['integral_spread']
        ],['integral_id'=>$post['integral_id']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : userIntegral()
     * 功  能 : 获取用户积分接口
     * 变  量 : $post['user_token']  => '用户TOKEN'
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function userIntegral($usertoken='')
    {
        $UsermemberModel = new UsermemberModel();
        // 查找
        if($usertoken == ''){
            $list = $UsermemberModel->select();
        }else{
            $list = $UsermemberModel->where('user_token',$usertoken)->find();
        }
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }

    /**
     * 名  称 : userintegralUpt()
     * 功  能 : 修改用户积分接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['int_transaction']  => '用户积分';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function userintegralUpt($post)
    {
        $UsermemberModel = new UsermemberModel();
        // 进行修改
        $res = $UsermemberModel->save([
            $UsermemberModel->int_transaction    = $post['int_transaction']
        ],['user_token'=>$post['user_token']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : userIntegral()
     * 功  能 : 获取用户积分接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositScenic()
    {
        $DepositModel = new DepositModel();
        // 查找
        $list = $DepositModel->select();
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : depositscenicUpt()
     * 功  能 : 修改景区押金接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['deposit_money']  => '景区押金';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositscenicUpt($post)
    {
        $DepositModel = new DepositModel();
        // 进行修改
        $res = $DepositModel->save([
            $DepositModel->deposit_money    = $post['deposit_money']
        ],['scenic_id'=>$post['scenic_id']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }



    /**
     * 名  称 : membershipUpt()
     * 功  能 : 修改会员卡接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['member_id']  => '会员卡主键';
     * 输  入 : '$post['member_name']  => '会员卡名称';
     * 输  入 : '$post['member_integral']  => '会员卡积分额度';
     * 输  入 : '$post['member_text']  => '会员卡权益说明';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function membershipUpt($post)
    {
        $MemberModel = new MemberModel();
        // 进行修改
        $res = $MemberModel->save([
            $MemberModel->member_name    = $post['member_name'],
            $MemberModel->member_integral    = $post['member_integral'],
            $MemberModel->member_text    = $post['member_text']
        ],['member_id'=>$post['member_id']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }




    /**
     * 名  称 : scenicList()
     * 功  能 : 获取申请通过的景区列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_status']  => '景区状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicList($post)
    {
        $res = ScenicModel::field(
            config('v1_tableName.Scenic').'.scenic_name,'.
            config('v1_tableName.Scenic').'.scenic_man,'.
            config('v1_tableName.Deposit').'.deposit_money,'
        )->leftJoin(
            config('v1_tableName.Deposit'),
            config('v1_tableName.Deposit').'.scenic_id = ' .
            config('v1_tableName.Scenic').'.scenic_id'
        )->where(
            config('v1_tableName.Scenic').'.scenic_status',
            $post['scenic_status']
        );
        $res = $res->select()->toArray();
        // 返回数据
        return returnData('success',$res);
    }



    /**
     * 名  称 : groupProportion()
     * 功  能 : 获取预约团购扣除比例接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function groupProportion()
    {
        $AdminbespeakModel = new AdminbespeakModel();
        // 查找
        $list = $AdminbespeakModel->select()->toArray();
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }



    /**
     * 名  称 : groupUpt()
     * 功  能 : 修改预约团购扣除比例接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['bespeak_id']  => '主键';
     * 输  入 : '$post['deductions']  => '扣费比例';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function groupUpt($post)
    {
        $MemberModel = new MemberModel();
        // 进行修改
        $res = $MemberModel->save([
            $MemberModel->deductions    = $post['deductions']
        ],['bespeak_id'=>$post['bespeak_id']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }
}