<?php

namespace app\api\controller;

use app\common\controller\ApiBaseController;
use app\common\model\City;
use think\Request;

class CityController extends ApiBaseController
{
    /**
     * [get 获取地区]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-11-24T11:46:02+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     Request                  $request   [description]
     * @param     integer                  $parent_id [description]
     * @param     integer                  $level     [description]
     * @return    [type]                              [description]
     */
    public function get(Request $request, $parent_id = 0, $level = 1)
    {
        $data = $request->post();
        $parent_id = !empty($data['parent_id']) ? $data['parent_id'] : $parent_id;
        $level = !empty($data['level']) ? $data['level'] : $level;
        return $this->dump(0, '获取成功', City::field('`value`,`text`,`parent_id`,`level`')->where(['parent_id' => $parent_id, 'level' => $level])->cache(true)->select());
    }
}
