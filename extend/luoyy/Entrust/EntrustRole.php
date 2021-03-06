<?php

namespace luoyy\Entrust;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package luoyy\Entrust
 */

use think\Model;
use think\Config;
use luoyy\Entrust\Contracts\EntrustRoleInterface;
use luoyy\Entrust\Traits\EntrustRoleTrait;

class EntrustRole extends Model implements EntrustRoleInterface
{
    use EntrustRoleTrait;

    /**
     * The database table used by the model.
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
        $this->name = Config::get('entrust.roles_table');
    }

}
