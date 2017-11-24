<?php

namespace app\common\model;

use think\Model;

/**
 * This is the model class for table "os_system".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 */
class System extends Model
{

    public function getValueAttr($value)
    {
        if (is_string($value)) {
            return unserialize($value);
        }
        return $value;
    }

    public function setValueAttr($val)
    {
        if (is_string($val)) {
            return $val;
        }
        return serialize($val);
    }
    /**
     * [updateOrCreate 更新或者创建]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-08-11T14:42:02+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     array                    $where     [条件]
     * @param     array                    $data      [数据]
     * @return    [type]                              [description]
     */
    public function updateOrCreate(array $where, array $data)
    {
        if ($this->where($where)->count() > 0) {
            return $this->isUpdate(true)->save($data, $where);
        } else {
            return $this->isUpdate(false)->save($where + $data, []);
        }
    }
}
