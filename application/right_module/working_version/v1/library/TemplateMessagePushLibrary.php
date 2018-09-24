<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TemplateMessagePushLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/15 12:12
 *  文件描述 :  Wx_小程序：模板消息推送_类文件
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\library;
class TemplateMessagePushLibrary
{
    /**
     * 名 称 : $TempMsgConfig
     * 功 能 : 模板消息推送_配置数组
     * 创 建 : 2018/08/15 12:15
     */
    private static $TempMsgConfig = array(

        'TempMsgPushUrl' => // 发送模版消息接口地址
        'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send'

    );

    /**
     * 名 称 : __construct()
     * 功 能 : 定义配置信息数据
     * 创 建 : 2018/08/15 12:17
     */
    private function __construct()
    {
        // TODO: 禁止外部实例化
    }

    /**
     * 名 称 : __clone()
     * 功 能 : 禁止外部克隆该实例
     * 创 建 : 2018/08/15 12:20
     */
    private function __clone()
    {
        // TODO: 禁止外部克隆该实例
    }

    /**
     * 名  称 : sendTemplate()
     * 功  能 : 发送模板消息
     * 输  入 : (Array) $data = [
     *     'touser'      => '接收者（用户）的 openid',
     *     'template_id' => '所需下发的模板消息的id',
     *     'page'        => '点击模板卡片后的跳转页面',
     *     'form_id'     => '表单提交场景下的formId',
     *     'data'        => [''=>'',''=>'',''=>''],
     * ];
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/15 12:26
     */
    public static function sendTemplate($access_token,$data)
    {
        // 验证数据是否正确
        $validate = self::dataValidate($access_token,$data);
        if('error' == $validate['msg']) return self::returnArray(
            'error',
            $validate['data']
        );

        // 获取发送模板信息地址
        $url = self::$TempMsgConfig['TempMsgPushUrl'];
        $url.= '?access_token='.$access_token;

        // 发送模板消息
        $wxData = self::curlPost($url,json_encode($data));
        // 解析返回代码
        $wxArr = json_decode($wxData,true);

        // 返回正确数据
        if(($wxArr['errcode']==0)&&($wxArr['errmsg']=='ok')) {
            return self::returnArray('success',$wxArr);
        }
        // 返回错误数据
        return self::returnArray('error',$wxArr);
    }

    /**
     * 名  称 : dataValidate()
     * 功  能 : 验证发送数据
     * 创  建 : 2018/08/15 12:27
     */
    private static function dataValidate($access_token,$data)
    {
        // 判断授权令牌是否发送
        if(empty($access_token)){
            return self::returnArray(
                'error',
                '判断授权令牌是否发送'
            );
        }

        // 处理数据判断数组是否发送
        if(is_array($data))
        {
            $data = json_encode($data);
        }else{
            return self::returnArray(
                'error',
                '请发送模板信息数组'
            );
        }
    }

    /**
     * 名  称 : curlPost()
     * 功  能 : Curl请求发送数据
     * 创  建 : 2018/08/15 12:29
     */
    private static function curlPost($url,$data,$method='POST')
    {
        $ch = curl_init();	 //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }

    /**
     * 名  称 : returnArray()
     * 功  能 : 返回数据
     * 创  建 : 2018/08/15 12:30
     */
    private static function returnArray($msg,$data = false)
    {
        return [ 'msg'=>$msg , 'data'=>$data ];
    }
}