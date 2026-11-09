<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftingReturnPayment extends Model
{
    use HasFactory;
    protected $fillable = ['lifting_return_id', 'lifting_id', 'amount'];
}
