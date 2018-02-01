<?php
namespace app\common\exception;

use Exception;
use think\App;
use think\exception\Handle;
use think\Request;
use think\Env;

class Http extends Handle
{
    /**
     * [render 重写的render]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-10-17T17:24:12+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     Exception                $exception         [description]
     * @return    [type]                              [description]
     */
    public function render(Exception $exception)
    {
        if (Request::instance()->module() == 'api') {
            return json([
                'code' => -2,
                'msg' => '服务器内部故障',
                'data' => App::$debug ? [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'message' => $this->getMessage($exception),
                    'code' => $this->getCode($exception),
                ] : [
                    'code' => $this->getCode($exception),
                    'message' => $this->getMessage($exception),
                ],
            ], 200, Env::get('API_CROSS', false) ? ['Access-Control-Allow-Origin' => '*'] : []);
        }
        // 其他错误交给系统处理
        return parent::render($exception);
    }
}
