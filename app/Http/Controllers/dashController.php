<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashNav;

class dashController extends Controller
{

    public function __construct(){
       $this->middleware('idChecker');
    }

    public function getDashboard(Request $req){
        $links = DashNav::all();
        return view('dashboard')->with('links', $links);
    }

    public function logout(Request $req){
        $req->session()->forget('id');
        return redirect()->route('login');
    }
}
