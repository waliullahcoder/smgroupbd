<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;
    protected $fillable = ['logo', 'favicon', 'title', 'footer_text', 
    'template_status',
    'body_bg',
    'card_bg',
    'title_bg',
    'primary_color', 
    'secondary_color', 
    'primary_bg', 
    'secondary_bg',
    'text1_color',
    'text2_color',  
    'store_id', 'accounting', 'invest_value', 'facebook', 'twitter', 'linkedin', 'whatsapp', 'google'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
