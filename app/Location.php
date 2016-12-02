<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Location
 *
 * @property integer $id
 * @property string $block
 * @property boolean $level
 * @property boolean $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AccessPoint[] $accessPoints
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereBlock($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereLevel($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    protected $fillable = [
        'block',
        'level',
    ];



    public function accessPoints()
    {
        return $this->hasMany(AccessPoint::class);//->withTimestamps();
    }
}
