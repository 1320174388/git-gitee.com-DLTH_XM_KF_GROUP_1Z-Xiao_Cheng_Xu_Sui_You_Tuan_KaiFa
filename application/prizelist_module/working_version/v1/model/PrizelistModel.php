<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理模型层
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\model;
use think\Model;

class PrizelistModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'prize_id';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.SGY_Data_Prize_list');
    }
}