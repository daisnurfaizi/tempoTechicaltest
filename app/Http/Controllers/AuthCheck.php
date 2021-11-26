<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthCheck extends Controller
{
    public function AuthCheck(Request $request)
    {
        // dd($request);
        $rules = [
            'login'                => 'required',
            'password'              => 'required',

        ];
        $messages = [
            'login.required'         => 'login wajib diisi',
            'pswd.required'     => 'Password wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        } else {
            $pengguna = Pengguna::where('login', $request->login)->first();
            // dd(Hash::check($request->password, $pengguna->pswd));
            if ($pengguna) {
                if ($pengguna->login == $request->login and Hash::check($request->password, $pengguna->pswd)) {
                    // $request->session()->put('login', $request->longin);
                    Session::put('login', $request->login);
                    return redirect('Dashboard');
                } else {
                    return redirect()->back()->withErrors(['msg' => 'ID User Atau Password Anda Salah']);;
                }
            } else {
                return redirect()->back()->withErrors(['msg' => ['ID User Atau Password Anda Salah']]);;
            }
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
