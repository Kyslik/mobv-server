<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property integer $id
 * @property string $block
 * @property boolean $level
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereBlock($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    protected $fillable = [
        'block',
        'level',
    ];

    public function wifi_points(){
        return $this->belongsToMany('App\WifiPoint');
    }
}
