<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }
 
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
 
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);
 
        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login'); #login.blade dosyasını yansıt
    }
 
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [ #Kullanıcının girdiği e-posta ve şifre bilgilerinin doğruluğunu kontrol eder.
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
 
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) { # Kullanıcının girdiği e-posta ve şifreyi kullanarak kimlik doğrulaması yapar.
            throw ValidationException::withMessages([
                'email' => trans('auth.failed') #çoklu dil desteği resources/lang
            ]);
        }
 
        $request->session()->regenerate(); #Başarılı giriş olursa oturum kimliği yenilenir. Bu saldırılarılara karşı bir güvenlik önlemidir.
 
       /**
        * if (auth()->user()->type == 'admin') {
        *    return redirect()->route('admin/home'); #admin ise bu rota kullanılır
        *} else {
         *   return redirect()->route('home'); #normal kullanıcı ise bu rota kullanılır
        *} */
         
        return redirect()->route('admin/home');
    }
 
    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); # artık kullanıcı sistemde oturum açmış olarak görünmez
 
        $request->session()->invalidate(); #oturum verilerine eriş ve bütün verileri temizle
 
        return redirect('/login');
    }
 
    public function profile()
    {
        return view('userprofile');
    }
}
