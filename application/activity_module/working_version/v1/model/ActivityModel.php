<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理模型层
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\model;
use think\Model;

class ActivityModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'activity_id';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.ActicityList');
    }
}