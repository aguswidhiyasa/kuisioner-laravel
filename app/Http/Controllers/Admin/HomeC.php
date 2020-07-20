<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeC extends Controller
{
    //

    public function index()
    {
        return view('admin.home.home');
    }
}
