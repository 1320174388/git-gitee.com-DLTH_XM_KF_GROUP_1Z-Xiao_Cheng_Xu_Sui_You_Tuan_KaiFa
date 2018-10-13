<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicModel.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  景区模型层
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\model;
use think\Model;

class GroupInfoModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'group_number';

    //设置时间字段名称
    protected $createTime = 'group_time';

    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.groupInfo');
    }
    // 关联团购成员表
    public function GroupMember()
    {
        return $this->hasOne('GroupMemberModel','group_number');
    }
}