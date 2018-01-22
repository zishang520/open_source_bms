<?php

namespace luoyy\Entrust;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package luoyy\Entrust
 */

use luoyy\Entrust\Contracts\EntrustPermissionInterface;
use luoyy\Entrust\Traits\EntrustPermissionTrait;
use think\facade\Config;
use think\Model;

class EntrustPermission extends Model implements EntrustPermissionInterface
{
    use EntrustPermissionTrait;

    /**
     * The database name used by the model.
     *
     * @var string
     */
    protected $name;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->name = Config::get('entrust.permissions_table');
    }

}
