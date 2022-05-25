<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashNav;
use App\Models\UserCredential;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use App\Models\UserEmail;
use App\Mail\SendEmail;
use App\Models\UserProjects;
use Illuminate\Support\Facades\Mail;
use Storage;

class dashController extends Controller
{

    public function __construct(){
       $this->middleware('idChecker');
    }

    public function dashNav(){
        return DashNav::all();
    }

    public function logout(Request $req){
        $req->session()->forget('id');
        return redirect()->route('login');
    }

    // -------------------------------------------------------------

    //                     Dashboard edit

    // -------------------------------------------------------------

    public function getDashboard(Request $req){
        $userCredential = UserCredential::all()->first();
        return view('dashboard')
        ->with('links', $this->dashNav())
        ->with('userCredential', $userCredential);
    }

    public function updateProfile(Request $req){
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

    // -------------------------------------------------------------

    //                     Message

    // -------------------------------------------------------------

    public function getMessages(){
        // newer messages first
        $email = UserEmail::orderByDesc('id')->paginate(10);
        $totalNewMessages = UserEmail::where('seen', 0)->count();
        return view('messages')
        ->with('links', $this->dashNav())
        ->with('email', $email)
        ->with('totalNewMessages', $totalNewMessages);
    }

    // Get new messages
    public function getNewMessages(){
        $email = UserEmail::where('seen', 0)->orderByDesc('id')->paginate(10);
        $totalNewMessages = UserEmail::where('seen', 0)->count();
        return view('messages')
        ->with('links', $this->dashNav())
        ->with('email', $email)
        ->with('totalNewMessages', $totalNewMessages);
    }

    // Delete all messages
    public function deleteAllMessages(Request $req){
        UserEmail::truncate();
        return redirect()->route('messages');
    }

    // Delete one message
    public function dltOneMsg($id){
        UserEmail::where('id', decrypt($id))->delete();
        return redirect()->route('messages');
    }

    // View one message
    public function viewOneMsg($id){
        $mailID = decrypt($id);
        $mailInfo = UserEmail::where('id', $mailID)->first();
        UserEmail::where('id', $mailID)->update(['seen'=>1]);
        return view('viewOneMessage')
        ->with('links', $this->dashNav())
        ->with('mailInfo', $mailInfo);
    }

    // send mail
    public function sendMail(Request $req){
        $subject = $req->subject;
        $body = $req->body;
        $mailTo = $req->mailTo;

        if(Mail::to("$mailTo")->send(new SendEmail($subject, $body))){
            $req->session()->flash('emailed', 'successful');
            return back();
        }else{
            $req->session()->flash('emailed', 'failed');
            return back();
        }

    }

    // -------------------------------------------------------------

    //                     Project

    // -------------------------------------------------------------

    // get project
    public function getProjects(Request $req){
        $projects = UserProjects::orderByDesc('id')->paginate(10);
        $totalProjects = UserProjects::all()->count();
        return view('projects')
        ->with('links', $this->dashNav())
        ->with('projects', $projects)
        ->with('total_projects', $totalProjects);
    } 

    // get edit project
    public function editProject($id){
        $projects = UserProjects::where('id', decrypt($id))->first();
        return view('editProject')
        ->with('links', $this->dashNav())
        ->with('projects', $projects);
    }

    // delete project
    public function deleteProject($id){
        $projectID = decrypt($id);
        UserProjects::where('id', $projectID)->delete();
        return back();
    }

    // add new project
    public function addNewProject(){
        return view('newProject')
        ->with('links', $this->dashNav());
    }

    // put edit project
    public function putEditProject(Request $req, $id){
        try{
            UserProjects::where('id', decrypt($id))
            ->update(['name'=>$req->projName, 'link'=>$req->projLink]);
            $req->session()->flash('editProj', 'successful');
            return back();
        }catch(\Exception $e){
            $req->session()->flash('editProj', 'failed');
            return back();
        }
        
    }

    // add new project
    public function postNewProject(Request $req){
        try{
            $user_project = new UserProjects();
            $user_project->name = $req->projName;
            $user_project->link = $req->projLink;
            $user_project->uc_id = $req->session()->get('id');
            $user_project->save();
            return redirect()->route('projects');
        }catch(\Exception $e){
            $req->session()->flash('editProj', 'failed');
            return back();
        }
    }

}
