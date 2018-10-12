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
use app\application_module\working_version\v1\model\ActivityModel;
use app\application_module\working_version\v1\model\AdminbespeakModel;
use app\application_module\working_version\v1\model\CourseModel;
use app\application_module\working_version\v1\model\DepositdeductModel;
use app\application_module\working_version\v1\model\DepositModel;
use app\application_module\working_version\v1\model\GroupinfoModel;
use app\application_module\working_version\v1\model\GroupmemberModel;
use app\application_module\working_version\v1\model\GroupModel;
use app\application_module\working_version\v1\model\IntegralModel;
use app\application_module\working_version\v1\model\MemberModel;
use app\application_module\working_version\v1\model\OrderModel;
use app\application_module\working_version\v1\model\PrizeModel;
use app\application_module\working_version\v1\model\ScenicModel;
use app\application_module\working_version\v1\model\ScenicserviceModel;
use app\application_module\working_version\v1\model\TicketModel;
use app\application_module\working_version\v1\model\UserbagModel;
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
        $ScenicModel->scenic_license = $post['scenic_license'];
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
            return returnData('error',$res);
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



    /**
     * 名  称 : exchangeTicket()
     * 功  能 : 兑换门票接口(显示门票内容)
     * 变  量 : --------------------------------------
     * 输  入 : '$post['order_number']  => '订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function exchangeTicket($post)
    {
        $TickModel = new TicketModel();

        $list = $TickModel->where('order_number',$post['order_number'])->field();

        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);

    }


    /**
     * 名  称 : confirmexchangeTicket()
     * 功  能 : 兑确认换门票接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['order_number']  => '订单号';
     * 输  入 : '$post['ticket_sratus']  => '门票状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function confirmexchangeTicket($post)
    {
        $TickModel = new TicketModel();

        if($TickModel->field('ticket_sratus')
                ->where('order_number',$post['order_number'])
                ->field() == 1){
            // 返回数据
            return returnData('error','门票已被使用');
        }else{
            $res = $TickModel->save([
                $TickModel->ticket_sratus    = $post['ticket_sratus']
            ],['order_number'=>$post['order_number']]);
            // 验证
            if(!$res){
                return returnData('error',false);
            }
        }
        // 返回数据
        return returnData('success',$res);

    }


    /**
     * 名  称 : prizeTicket()
     * 功  能 : 兑换奖品接口(显示奖品内容)
     * 变  量 : --------------------------------------
     * 输  入 : '$post['prize_id']  => '奖品主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function prizeTicket($post)
    {
        $PrizeModel = new PrizeModel();
        // 查询
        $list = $PrizeModel->where('prize_id',$post['prize_id'])->field();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);

    }


    /**
     * 名  称 : confirmprizeTicket()
     * 功  能 : 确认兑换奖品接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['prize_id']  => '奖品主键';
     * 输  入 : '$post['prize_status']  => '奖品状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function confirmprizeTicket($post)
    {
        $PrizeModel = new PrizeModel();

        if($PrizeModel->field('prize_status')
                ->where('prize_id',$post['prize_id'])
                ->field() == 1){
            // 返回数据
            return returnData('error','奖品已被领取');
        }else{
            $res = $PrizeModel->save([
                $PrizeModel->prize_status    = $post['prize_status']
            ],['prize_id'=>$post['prize_id']]);
            // 验证
            if(!$res){
                return returnData('error',false);
            }
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : activeStatus()
     * 功  能 : 修改活动状态接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['activity_id']  => '活动主键';
     * 输  入 : '$post['activity_status']  => '活动状态';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function activeStatus($post)
    {
        $ActivityModel = new ActivityModel();
        // 进行修改
        $res = $ActivityModel->save([
            $ActivityModel->activity_status    = $post['activity_status']
        ],['activity_id'=>$post['activity_id']]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : depositDeduction()
     * 功  能 : 获取押金扣除记录列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositDeduction($post)
    {
        $DepositdeductModel = new DepositdeductModel();
        // 查询
        $list = $DepositdeductModel->where('scenic_id',$post['scenic_id'])
            ->select()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : scenicDeposit()
     * 功  能 : 获取景区押金接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicDeposit($post)
    {
        $DepositModel = new DepositModel();
        // 查询
        $list = $DepositModel->where('scenic_id',$post['scenic_id'])
            ->field()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : sceniccustomerserviceDel()
     * 功  能 : 删除景区客服接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['service_id']  => '客服主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function sceniccustomerserviceDel($post)
    {
        $ScenicserviceModel = new ScenicserviceModel();
        // 删除
        $dd = $ScenicserviceModel->where('service_id',$post['service_id'])
            ->where('scenic_id',$post['scenic_id'])
            ->delete();
        // 验证
        if(!$dd){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$dd);
    }


    /**
     * 名  称 : depositPayment()
     * 功  能 : 判断用户是否支付景区押金
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function depositPayment($post)
    {
        $DepositModel = new DepositModel();
        // 查询
        $list = $DepositModel->where('user_token',$post['user_token'])
            ->select()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : customerAdd()
     * 功  能 : 景区添加客服接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['service_name']  => '	客服名称';
     * 输  入 : '$post['service_phone']  => '客服电话';
     * 输  入 : '$post['service_position']  => '客服职位';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function customerAdd($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicserviceModel = new ScenicserviceModel();
        // 景区主键
        $ScenicserviceModel->scenic_id	 = $post['scenic_id'];
        // 客服名称
        $ScenicserviceModel->service_name = $post['service_name'];
        // 客服电话
        $ScenicserviceModel->service_phone = $post['service_phone'];
        // 客服职位
        $ScenicserviceModel->service_position = $post['service_position'];
        // 保存数据库
        $data = $ScenicserviceModel->save();
        // 验证
        if(!$data){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$data);
    }


    /**
     * 名  称 : customerSel()
     * 功  能 : 获取景区客服列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function customerSel($post)
    {
        $ScenicserviceModel = new ScenicserviceModel();
        // 查询
        $list = $ScenicserviceModel->where('scenic_id',$post['scenic_id'])
            ->select()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : customerUpt()
     * 功  能 : 修改景区客服接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['service_id']  => '客服主键';
     * 输  入 : '$post['service_name']  => '客服名称';
     * 输  入 : '$post['service_phone']  => '客服电话';
     * 输  入 : '$post['service_position']  => '客服职位';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function customerUpt($post)
    {
        $ScenicserviceModel = new ScenicserviceModel();
        if($ScenicserviceModel->field('service_name')
                ->where('service_id',$post['service_id'])
                ->field() == $post['service_name'])
        {
            return returnData('error','客服名称重复');
        }{
            // 进行修改
            $res = $ScenicserviceModel->save([
                $ScenicserviceModel->service_name    = $post['service_name'],
                $ScenicserviceModel->service_phone    = $post['service_phone'],
                $ScenicserviceModel->service_position    = $post['service_position'],
            ],['service_id'=>$post['service_id']]);
            // 验证
            if(!$res){
                return returnData('error',false);
            }
        }
        // 返回数据
        return returnData('success',$res);

    }


    /**
     * 名  称 : Comment()
     * 功  能 : 获取景区评论列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function Comment($post)
    {
        $CourseModel = new CourseModel();
        // 查询
        $list = $CourseModel->where('scenic_id',$post['scenic_id'])
            ->select()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : coupon()
     * 功  能 : 领取个人优惠券接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';
     * 输  入 : '$post['index_id']  => '	奖品或优惠券主键';
     * 输  入 : '$post['bag_type']  => '	类型 【奖品、优惠券】';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function coupon($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $UserbagModel = new UserbagModel();
        // 用户token
        $UserbagModel->user_token	= $post['user_token'];
        // 奖品或优惠券主键
        $UserbagModel->index_id = $post['index_id'];
        // 类型 【奖品、优惠券】
        $UserbagModel->bag_type = $post['bag_type'];
        // 使用状态
        $UserbagModel->bag_status = '0';
        // 领取时间
        $UserbagModel->bag_time = time();
        // 保存数据库
        $data = $UserbagModel->save();
        // 验证
        if(!$data){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$data);
    }


    /**
     * 名  称 : couponReceive()
     * 功  能 : 判断用户是否已经领取优惠券
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['index_id']  => '优惠劵主键';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function couponReceive($post)
    {
        // 实例化model
        $UserbagModel = new UserbagModel();
        // 查询
        if ($UserbagModel->field('index_id')
                ->where('user_token', $post['user_token'])
                ->find() == $post['index_id']) {
            // 返回数据
            return returnData('error', '已有此优惠劵');
        } else {
            // 返回数据
            return returnData('success', '没有此优惠劵');
        }
    }


    /**
     * 名  称 : grouppurchaseList()
     * 功  能 : 获取景区下正在进行的团购列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';
     * 输  入 : '$post['group_status']  => '	存在状态';
     * 输  入 : $pagination  => '分页';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function grouppurchaseList($post,$pagination)
    {
        $GroupModel = new GroupModel();
        // 查询
        $list = $GroupModel->where('scenic_id',$post['scenic_id'])
            ->where('group_status',$post['group_status'])
            ->limit($pagination,12)->select()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
    * 名  称 : fightGroup()
    * 功  能 : 查看拼团是否完成
    * 变  量 : --------------------------------------
    * 输  入 : '$post['group_number']  => '订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function fightGroup($post)
    {
        $GroupinfoModel = new GroupinfoModel();
        // 查询
        $list = $GroupinfoModel->where('group_number',$post['group_number'])
            ->find()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : personalPrize()
     * 功  能 : 领取个人奖品接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['index_id']  => '奖品或优惠券主键';
     * 输  入 : '$post['bag_type']  => '类型 【奖品、优惠券】';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function personalPrize($post)
    {
        $UserbagModel = new UserbagModel();
        if($UserbagModel->field('index_id')
                ->where('user_token',$post['user_token'])
                ->select()->toArray() == $post['index_id']){
            return returnData('error','您已领过此奖品');
        }else{
            // 用户token
            $UserbagModel->user_token	= $post['user_token'];
            // 奖品或优惠券主键
            $UserbagModel->index_id = $post['index_id'];
            // 类型 【奖品、优惠券】
            $UserbagModel->bag_type = $post['bag_type'];
            // 使用状态
            $UserbagModel->bag_status = '0';
            // 领取时间
            $UserbagModel->bag_time = time();
            // 保存数据库
            $data = $UserbagModel->save();
            // 验证
            if(!$data){
                return returnData('error',false);
            }
        }
        // 返回数据
        return returnData('success',$data);
    }


    /**
     * 名  称 : personalCoupon()
     * 功  能 : 查询个人优惠券,奖品列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户TOKEN';
     * 输  入 : '$post['bag_status']  => '状态';
     * 输  入 : '$post['bag_type']  => '类型 【奖品、优惠券】';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function personalCoupon($post)
    {
        $UserbagModel = new UserbagModel();
        // 查询
        $list = $UserbagModel->where('user_token',$post['user_token'])
            ->where('bag_type',$post['bag_type'])
            ->order('bag_status',$post['bag_status'])
            ->select()->toArray();
        // 验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : personalCustomers()
     * 功  能 : 获取个人团购信息
     * 变  量 : --------------------------------------
     * 输  入 : '$post['group_number']  => '订单号';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function personalCustomers($post)
    {
        $res = GroupmemberModel::field(
            config('v1_tableName.Scenic').'.scenic_name,'.
            config('v1_tableName.Groupinfo').'.group_num,'.
            config('v1_tableName.Groupinfo').'.man_num,'.
            config('v1_tableName.Users').'.user_name,'.
            config('v1_tableName.Groupinfo').'.group_money,'.
            config('v1_tableName.Groupinfo').'.group_time,'
        )->leftJoin(
            config('v1_tableName.Groupinfo'),
            config('v1_tableName.Groupinfo').'.group_number = ' .
            config('v1_tableName.Groupmember').'.group_number'
        )->leftJoin(
            config('v1_tableName.Scenic'),
            config('v1_tableName.Scenic').'.scenic_id = ' .
            config('v1_tableName.group_Info').'.scenic_id'
        )->leftJoin(
            config('v1_tableName.Users'),
            config('v1_tableName.Users').'.user_token = ' .
            config('v1_tableName.Groupmember').'.user_token'
        )->where(
            config('v1_tableName.Groupmember').'.group_number',
            $post['group_number']
        );
        // 返回数据
        return returnData('success',$res);
    }

}