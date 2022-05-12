<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashNav;
use App\Models\UserCredential;
use Illuminate\Support\Facades\Hash;

class dashController extends Controller
{

    public function __construct(){
       $this->middleware('idChecker');
    }

    public function getDashboard(Request $req){
        $links = DashNav::all();
        // return UserCredential::all()->first();
        $userCredential = UserCredential::all()->first();
        return view('dashboard')
        ->with('links', $links)
        ->with('userCredential', $userCredential);
    }

    public function logout(Request $req){
        $req->session()->forget('id');
        return redirect()->route('login');
    }

    public function postDashboard(Request $req){
        // return $req->file('image');
        // checks if the password matches
        // $password = $req->password;
        // UserCredential::where('id', 1)->update(['password'=>Hash::make($password)]);
        // $savePassword->email = $req->email;
        // $savePassword->password = Hash::make($password);
        // $savePassword->save();
        // ------------------------------- initial saved password: qwerty1@3 
        $password = $req->password;
        $uid = $req->session()->get('id');
        $userCredential = UserCredential::where('id', $uid)->first();
        if(Hash::check($password, $userCredential->password)){
            return "matched";
            // Continue...
        }

        return redirect()->route('logout');
        
        
        
    }
}
