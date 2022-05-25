<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserCredential;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function getLogin(Request $req){
        if($req->session()->has('id')){
            return redirect()->route('dashboard');
        }
        
        return view('login');
    }

    public function postLogin(Request $req){
        $validator = Validator::make($req->all(),[
            'email'=>'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
            'password'=>'required'
        ]);

        if($validator->fails()){
            $req->session()->flash('validationFailedStatus', 'Failed');
            return back();
        }

        $email = strip_tags($req->email);
        $password = strip_tags($req->password);
        
        // Check if the user matches
        $user = UserCredential::where('email', $email)->first();

        if(!($user && Hash::check($password, $user->password))){
            $req->session()->flash('loginFailedStatus', 'Failed');
            return back();
        }

        $req->session()->put('id', $user->id);
        return redirect()->route('dashboard');
    }
}
