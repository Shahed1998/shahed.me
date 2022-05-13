<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashNav;
use App\Models\UserCredential;
use App\Models\Gallery;
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
            
            // Image upload
            $image = $req->file('image');
            if($image){
                $img_name = $image->hashName();
                $path = $image->storeAs('public/profile_pic', $img_name);
                Gallery::where('selected', 1)->update(['selected'=>0]);
                $new_saved_image = new Gallery();
                $new_saved_image->image_name = $path;
                $new_saved_image->selected = 1;
                $new_saved_image->save();
                return back();
            }
        }

        return redirect()->route('logout');
        
        
        
    }
}
