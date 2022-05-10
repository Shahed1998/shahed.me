<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserInfo;
use App\Models\HomeLinkModel;
use App\Models\userProjects;

class UserCredential extends Model
{
    use HasFactory;
    protected $table = "admin_credential";
    public $timestamps = false;

    public function userInfo(){
        return $this->hasOne(UserInfo::class, 'uc_id');
    }

    public function homeLinkModel(){
        return $this->hasMany(HomeLinkModel::class, 'uc_id');
    }

    public function userProjects(){
        return $this->hasMany(UserProjects::class, 'uc_id');
    }
}
