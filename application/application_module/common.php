<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  common.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请模块公共何函数文件
 *  历史记录 :  -----------------------
 */

// +----------------------------------
// : 自定义函数区域
// +----------------------------------
/**
 * 名  称 : imageUploads()
 * 功  能 : 处理文件上传函数
 * 变  量 : --------------------------------------
 * 输  入 : ( File ) $fileName  => '文件资源';
 * 输  入 : (String) $fileDir   => '文件保存路径'
 * 输  入 : (String) $fileUrl   => '文件保存后的URL地址'
 * 输  出 : ['success'=>'文件路径']
 * 创  建 : 2018/08/11 11:31
 */
function imageUploads($fileName,$fileDir,$fileUrl)
{
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file($fileName);
    // 判断是否上传图片
    if(!$file) return returnData(
        'error','没有上传图片'
    );
    // 移动到框架应用根目录/uploads/ 目录下 ，
    $info = $file->move($fileDir);
    // 返回上传失败获取错误信息
    if(!$info) return returnData(
        'error', $file->getError()
    );
    // 获取 20160820/42a79759f284b767dfcb2a0197904287.jpg
    return returnData(
        'success',
        $fileUrl.$info->getSaveName()
    );
}