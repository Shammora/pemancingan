<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Redirect;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function registerPihak()
    {
        return view('register_pihak');
    }
    public function prosesLogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::User()->peran == "Admin") {
                return Redirect::to('/admin/home');
            } elseif (Auth::User()->peran == "Pemancing") {
                return Redirect::to('/pemancing/home');
            } else {
                return Redirect::to('/pemancingan/home');
            }

        } else {
            \Session::flash('msg_login', 'Username Atau Password Salah!');
            return Redirect::to('/');
        }
    }
    public function prosesRegister(Request $request)
    {
        try {
            $folder = 'web_pemancingan_fahri';

            $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->no_hp = $request->no_hp;
            $user->foto = $uploadedFile->getSecurePath();
            $user->password = bcrypt($request->password);
            $user->peran = 'Pemancing';
            $user->save();

            \Session::flash('msg_success', 'Registrasi Berhasil!');
            return Redirect::route('register');
        } catch (\Exception $e) {
            \Session::flash('msg_error', 'Something Went Wrong!');
            return Redirect::route('register');
        }
    }
    public function prosesRegisterPihak(Request $request)
    {
        try {
            $folder = 'web_pemancingan_fahri';

            $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->no_hp = $request->no_hp;
            $user->foto = $uploadedFile->getSecurePath();
            $user->password = bcrypt($request->password);
            $user->peran = 'Pihak Pemancingan';
            $user->save();

            \Session::flash('msg_success', 'Registrasi Berhasil!');
            return Redirect::route('register_pihak');
        } catch (\Exception $e) {
            \Session::flash('msg_error', 'Something Went Wrong!');
            return Redirect::route('register_pihak');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
