<?php

namespace app\common\controller;

use think\Controller;

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
    protected function dump($code, $msg, $data = null)
    {
        return json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
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
        return $this->dump(-1, '系统繁忙');
    }
}
