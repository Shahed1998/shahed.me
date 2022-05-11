<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashNav;
use App\Models\UserCredential;

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
}
