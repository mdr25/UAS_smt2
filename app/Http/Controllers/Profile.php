<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class Profile extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        Alert::success('Success', 'Profile berhasil di Update');
        return redirect('profile');
    }
}
