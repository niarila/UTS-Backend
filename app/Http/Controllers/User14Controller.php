<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User14Controller extends Controller
{
    public function users14()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        $users = collect(User::where('role', 'User')->get());
        return view('user.users', [
            'no'=>1,
            'users'=>$users->sortBy('is_aktif', false),
            'role'=>$role
        ]);
    }

    public function profile14()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        return view('user.profile', [
            'role'=>$role
        ]);
    }

    public function detailUser14($id)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }

        $user = User::find($id);

        return view('user.detailUser', [
            'user'=>$user,
            'role'=>$role,
        ]);
    }

    // ===aprove user===
    public function approveUser14($id)
    {
        $user=User::find($id);
        $user->is_aktif=true;
        $user->save();

        return redirect('/users14')->with('success','Success Aprove');
    }

    public function deleteUser14($id)
    {
        User::find($id)->delete();
        return redirect('/users14')->with('success', 'Success delete');
    }

    public function login14()
    {
        return view('user.login');
    }

    public function loginProses14(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect('/');
        }
        return redirect('/login14')->with('error','Email or password wrong');
    }

    public function logout14(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register14()
    {
        return view('user.register');
    }

    public function registerProses14(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>Str::random(60),
            'foto'=>$request->foto
        ]);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $user->foto=$request->file('foto')->getClientOriginalName();
            $user->save();
        }


        return redirect('/login14')->with('success','register success');
    }

    public function updatePassword14()
    {
        return view('user.updatePassword');
    }

    public function updatePasswordProses14(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/profile14')->with('success','update password success');
    }

}
