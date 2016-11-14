<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 07.11.2016
 * Time: 19:36
 */
class Place extends Model
{
    protected $fillable = [
        'block',
        'floor',
    ];
}
