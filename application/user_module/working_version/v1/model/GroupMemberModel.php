<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  GroupMemberModel.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/06 09:54
 *  文件描述 :  团购成员表模型层
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\model;
use think\Model;

class GroupMemberModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.GroupMember');
    }
}