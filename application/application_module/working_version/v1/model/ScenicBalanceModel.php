<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicBalanceModel.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区余额模型层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\model;
use think\Model;

class ScenicBalanceModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'scenic_id';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.ScenicBalance');
    }
}