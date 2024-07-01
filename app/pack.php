<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_num_days', 
        'package_num_listings', 
        'download_resume_quota'
    ];

    // Define other necessary attributes and relationships here
}
