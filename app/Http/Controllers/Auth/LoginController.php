<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->tipe_user == 'ADMIN') {
            return response()->json([
                'status' => 'success',
                'redirect_route' => route('admin.home')
            ]);
        }

        return response()->json([
            'status' => 'success',
            'redirect_route' => $this->redirectTo
        ]);
    }

    public function redirectTo()
    {
        $user = Auth::user();
        if ($user->tipe_user == 'ADMIN') {
            return $this->redirectTo = '/admin';
        }

        return RouteServiceProvider::HOME;
    }
}
