<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WifiPoint
 *
 * @property integer $id
 * @property string $bssid
 * @property string $ssid
 * @property string $capabilities
 * @property integer $level
 * @property integer $frequency
 * @property string $timestamp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereBssid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereSsid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereCapabilities($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereFrequency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WifiPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WifiPoint extends Model
{
    protected $fillable = [
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
}
