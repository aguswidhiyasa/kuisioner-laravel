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
    public static function activeLink($routeName)
    {
        return \Route::is($routeName) ? "active" : '';
    }
}
