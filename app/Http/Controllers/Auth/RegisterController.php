<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers; // トレイト使用
// ①【showRegistrationForm】ユーザ新規登録画面表示メソッド
// ②【register】ユーザ新規登録後のログインメソッド
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // ユーザ新規登録後【localhost:8080/】にリダイレクト
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    //オーバーライド(トレイト使用のため)
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->validated())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function redirectPath()
    {
        $userId = auth()->id();

        if (!$userId) {
            abort(500, "ユーザーIDが取得できませんでした。");
        }

        return route('user.show', ['id' => $userId]);
    }
}
