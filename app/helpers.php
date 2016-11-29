<?php


use Illuminate\Support\Debug\Dumper;

if (!function_exists('d')) {
    /**
     * @param  mixed
     * @return void
     */
    function d()
    {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());
    }
}

if (!function_exists('validateJson')) {

    /**
     * @param $json
     * @throws Exception
     */
    function validateJson($json)
    {
        if (empty($json)) {
            if (class_exists('App\Exceptions\InvalidJsonException')) {
                throw new App\Exceptions\InvalidJsonException();
            }
            throw new Exception('Something went wrong.');
        }
    }
}
