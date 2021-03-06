<?php

namespace app\common\controller;

use think\Controller;
use think\Env;

class ApiBaseController extends Controller
{
    /**
     * [dump 输出接口数据]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-10-13T14:49:21+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     [int]                   $code      [状态码]
     * @param     [string]                   $msg       [消息]
     * @param     [data]                   $data      [数据的内容默认为null]
     * @return    [json]                              [返回json数据]
     */
    protected static function dump($code, $msg, $data = null)
    {
        return json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ], 200, Env::get('API_CROSS', false) ? ['Access-Control-Allow-Origin' => '*'] : []);
    }

    /**
     * [_empty 空方法]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-10-13T14:50:21+0800
     * @copyright (c)                      ZiShang520    All Rights Reserved
     * @return    [type]                   [description]
     */
    public function _empty()
    {
        return self::dump(-1, '请求地址未找到，请检查你的地址是否正确！');
    }
}
