<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashNav extends Model
{
    use HasFactory;
    protected $table = "dashboard_links";
    public $timestamps = false;
}
