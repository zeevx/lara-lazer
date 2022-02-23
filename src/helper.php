<?php
use Illuminate\Contracts\Foundation\Application;

if (!function_exists('lazerpay')) {

    /**
     * @return Application|mixed
     */
    function lazerpay()
    {
        return app('lazerpay');
    }
}
