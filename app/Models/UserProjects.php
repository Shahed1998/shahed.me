<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserCredential;

class UserProjects extends Model
{
    use HasFactory;
    protected $table = "admin_projects";
    public $timestamps = false;

    public function userCredential(){
        return $this->belongsTo(UserCredential::class, 'uc_id');
    }

}
