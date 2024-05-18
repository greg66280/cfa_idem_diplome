<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Custom models
use App\Models\User;

class AuthController extends Controller
{
    protected function register(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "conf_password" => "required|same:password"
        ]);

        $datas = $request->all();

        $hasUser = User::where("email", $datas["email"])->first();
        
        if ($hasUser) {
            return back();
        }
        
        try {
            
            $user = User::create([
                "name" => $datas["name"],
                "email" => $datas["email"],
                "password" => bcrypt($datas["password"])
            ]);
            
            auth()->login($user);
            
            return redirect()->route("dashboard.index");

        } catch(\Exception $e) {
            
            dd($e->getMessage());

        }
    }

    protected function login(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $datas = $request->all();
        
        if (Auth::attempt(["email" => $datas["email"], "password" => $datas["password"]])) {
            $request->session()->regenerate();
 
            return redirect()->route("dashboard.index");
        } else {
            return redirect()->route("auth.login");
        }

    }

    protected function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route("auth.login");
    }
}
