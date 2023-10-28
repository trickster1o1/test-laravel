<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function loginForm() {
        if(session()->has('user')) {
            return redirect()->route('userPet.index');
        }
        return view('welcome');
    }
    public function userLogin(Request $req)
    {
        // User::create([
        //     'name'=>'Nischal Tuladhar',
        //     'email'=>'nischal@mail.com',
        //     'password'=>'nischal@123',
        // ]);
        if (session()->has('user')) {
            return redirect()->route('userPet.index');
        }

        $user = User::where('email', $req->email)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                session(['user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'id' => $user->id
                ]]);
            }

            return redirect()->route('userPet.index');
        }
        return redirect('/')->with('error', '1');
    }

    public function logout() {
        session()->forget('user');
        return redirect('/');
    }
}
