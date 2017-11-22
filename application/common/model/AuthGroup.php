<?php

namespace app\common\model;

use luoyy\Entrust\EntrustRole;

/**
 * This is the model class for table "os_auth_group".
 *
 * @property string $id
 * @property string $title
 * @property integer $status
 * @property string $rules
 */
class AuthGroup extends EntrustRole
{

}
