<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AccessPoint
 *
 * @property integer $id
 * @property integer $location_id
 * @property string $bssid
 * @property string $ssid
 * @property string $capabilities
 * @property integer $level
 * @property integer $frequency
 * @property string $timestamp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Location $location
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereLocationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereBssid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereSsid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereCapabilities($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereFrequency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessPoint locationId($location_id)
 * @mixin \Eloquent
 */
class AccessPoint extends Model
{
    protected $fillable = [
        'location_id',
        'bssid',
        'ssid',
        'capabilities',
        'level',
        'frequency',
        'timestamp'
    ];

    protected $casts = [
        'level' => 'integer',
        'frequency' => 'integer'
    ];

    public function scopeLocationId($query, $location_id)
    {
        return $query->where('location_id', $location_id);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
