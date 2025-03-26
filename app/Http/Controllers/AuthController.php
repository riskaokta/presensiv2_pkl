<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        // $pass = 12345;
        // echo Hash::make($pass);
        // echo password_hash($pass, PASSWORD_BCRYPT);
        // INI ERROR REDIRECT KE DASHBOARD
        // $a = Hash::make($request->password);
        // echo $jam;

        //Validasi input
        $request->validate([
            'npm' => 'required',
            'password' => 'required',
        ], [
            'npm.required' => 'NPM wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // $password = Hash::make($request->password);
        // echo $password;
        $mahasiswa = Mahasiswa::where('npm', $request->npm)->first();
        // Attempt login
        if ($mahasiswa && Hash::check($request->password, $mahasiswa->password)) {
            // Redirect jika berhasil login
            Auth::guard(name: 'mahasiswa')->login($mahasiswa);
            return redirect('/dashboard');
        } else {
            // Redirect jika gagal login
            echo "Gagal Login";
        }
    }

    public function proseslogout()
    {
        Auth::guard('mahasiswa')->logout(); // Logout pengguna dari guard mahasiswa
        return redirect('/');

        // if (Auth::guard('mahasiswa')->check()) {
        //     Auth::guard('mahasiswa')->logout();
        //     return redirect('/');
        // }

    }

    public function proseslogoutadmin()
    {
        if (Auth::guard('mahasiswa')->check()) {
            Auth::guard('mahasiswa')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginadmin(Request $request)
    {

        // $a = Hash::make($request->password);
        // echo $a;
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning' => 'Email/Password Salah']);
        }
    }
}
