<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCredential;
use App\Models\UserProjects;
use App\Models\UserEmail;


class homeController extends Controller
{
    public function getHome(){
        $user_info = UserCredential::all()->first()->userInfo;
        $user_links = UserCredential::all()->first()->homeLinkModel;
        $user_projects =  UserProjects::paginate(4)->fragment('projects');

        return view('home')
        ->with('name', $user_info->name)
        ->with('description', $user_info->description)
        ->with('links', $user_links)
        ->with('user_projects', $user_projects); 
    }

    public function postEmail(Request $req){
        try{

            $data = $req->all();
            $clientName = strip_tags($data["clientName"]);
            $email = strip_tags($data["email"]);
            $subject = strip_tags($data["subject"]);
            $comment = strip_tags($data["comment"]);

            // saving to db
            $emailObj = new UserEmail();
            $emailObj->name = $clientName;
            $emailObj->email = $email;
            $emailObj->subject = $subject;
            $emailObj->comment = $comment;
            $emailObj->save();

            return response()->json([
                "status"=>"Success"
            ], 200);
            
        }catch(\Exception $e){
            return $response()->json([
                "status"=>"Failed"
            ],500);
        }
    }
}
