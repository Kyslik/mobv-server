<?php

$factory->define(App\AccessPoint::class, function (Faker\Generator $faker) {
    return [
        'location_id' => rand(1, 15),
        'device_id' => rand(1, 5),
        'bssid' => $faker->macAddress,
        'ssid' => $faker->userName
    ];
});