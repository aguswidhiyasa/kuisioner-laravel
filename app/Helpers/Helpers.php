<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Helpers {
    /***
     * Display session message
     *
     * @param string $message
     *
     * @param string $type Tipe notifikasi (error/success)
     */
    public static function message($message, $type = "success")
    {
        $session          = array();
        $session['pesan'] = Session::flash('pesan', $message);
        $session['tipe']  = Session::flash('tipe', $type);
    }

    /**
     * Set active link when route is actve
     * @param string $routeName
     *
     * @return string
    */
    public static function activeLink($routeName, $withSubPages = false)
    {
        $class = $withSubPages ? 'active menu-open' : 'active';
        if (is_array($routeName)) {
            $isRoute = false;
            foreach ($routeName as $route) {
                if (\Route::is($route)) {
                    $isRoute = true;
                }
            }

            return $isRoute ? $class : '';
        } else {
            return \Route::is($routeName) ? $class : '';
        }
    }
}
