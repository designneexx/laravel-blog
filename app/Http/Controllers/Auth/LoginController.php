<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|'
        ], [
            'required' => 'Поле :attribute обязательно для заполнения',
            'email' => 'Поле :attribute обязательно для заполнения',
            'confirmed' => 'Поле :attribute обязательно для заполнения',
            'password' => 'Поле :attribute обязательно для заполнения',
            'password_confirmed' => 'Поле :attribute обязательно для заполнения',
        ]);

        if($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        if($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return response()->json([
            'message' => 'Неверное имя пользователя или пароль',
            'userNotFound' => true,
        ], 400);
    }
}
