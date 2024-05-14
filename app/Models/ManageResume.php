<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageResume extends Model
{
    use HasFactory;
    protected $fillable=['resume_id','name','status'];
}
