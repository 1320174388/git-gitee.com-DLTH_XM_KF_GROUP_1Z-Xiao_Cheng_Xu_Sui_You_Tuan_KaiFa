<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ExtractListModel.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  登录表模型层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\model;
use think\Model;

class ExtractListModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    //设置时间字段名称
    protected $createTime = 'extract_time';

    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.ExtractList');
    }
}