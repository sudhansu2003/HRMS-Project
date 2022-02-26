<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Utility;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function __construct()
    {
        if(!file_exists(storage_path() . "/installed"))
        {
            header('location:install');
            die;
        }
    }

    /*protected function authenticated(Request $request, $user)
    {
        if($user->delete_status == 1)
        {
            auth()->logout();
        }

        return redirect('/check');
    }*/

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        if($user->is_active == 0)
        {
            auth()->logout();
        }
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function showLoginForm($lang = '')
    {
        if($lang == '')
        {
            $lang = \App\Models\Utility::getValByName('default_language');
        }
        \App::setLocale($lang);

        return view('auth.login', compact('lang'));
    }

    public function showLinkRequestForm($lang = '')
    {
        if($lang == '')
        {
            $lang = \App\Models\Utility::getValByName('default_language');
        }
        \App::setLocale($lang);

        return view('auth.forgot-password', compact('lang'));
    }
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
