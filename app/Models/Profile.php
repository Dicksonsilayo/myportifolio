<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name',
        'professional_title',
        'short_bio',
        'about',
        'email',
        'phone',
        'location',
        'github_url',
        'linkedin_url',
        'website_url',
        'profile_photo',
        'resume_path',
        'availability_status',
    ];
}