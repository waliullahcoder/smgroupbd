<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'faq_title', 'white_faq_name', 'black_faq_name', 'white_faq_description', 'black_faq_description', 'social_work_heading', 'social_work_title', 'social_work_description', 'link'];
}
