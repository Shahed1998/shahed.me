<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashNav;
use App\Models\UserCredential;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Storage;
use App\Models\UserEmail;

class dashController extends Controller
{

    public function __construct(){
       $this->middleware('idChecker');
    }

    public function getDashboard(Request $req){
        $links = DashNav::all();
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
        // ------------------------------- initial saved password: qwerty1@3 
        $password = $req->password;
        $uid = $req->session()->get('id');
        $userCredential = UserCredential::where('id', $uid)->first();
        if($userCredential && Hash::check($password, $userCredential->password)){
            try{
                // Image upload
                $image = $req->file('image');
                if($image){
                    $img_name = $image->hashName();
                    $db_image = UserInfo::where('uc_id', $uid)->first()->image;
                    if($db_image){
                        Storage::delete("$db_image");
                    }
                    $path = $image->storeAs('public/uploads', $img_name);
                    UserInfo::where('uc_id', $uid)->update(['image'=>$path]);
                }

                // CV upload
                $cv = $req->file('cv');
                if($cv){
                    $cv_name = $cv->hashName();
                    $db_cv = UserInfo::where('uc_id', $uid)->first()->cv;
                    if($db_cv){
                        Storage::delete("$db_cv");
                    }
                    $path = $cv->storeAs('public/uploads', $cv_name);
                    UserInfo::where('uc_id', $uid)->update(['cv'=>$path]);
                }

                // Update name, email, description
                $uname = $req->uname;
                $email = $req->email;
                $description = $req->description;
                UserCredential::where('id', $uid)->update(['email'=>$email]);
                UserInfo::where('uc_id', $uid)->update(['name'=>$uname, 'description'=>$description]);

                // update new password
                $newPass = $req->new_password;
                if($newPass){
                    UserCredential::where('id', $uid)->update(['password'=>Hash::make($newPass)]);
                }
                
                $req->session()->flash('status', 'successful');
                return back();

            }catch(\Exception $e){
                $req->session()->flash('status', 'failed');
                return back();
            }
        }

        return redirect()->route('logout');
    }

    // Get messages
    public function getMessages(){
        // newer messages first
        $email = UserEmail::orderByDesc('id')->paginate(10);
        $links = DashNav::all();
        return view('messages')
        ->with('links', $links)
        ->with('email', $email);
    }
}
