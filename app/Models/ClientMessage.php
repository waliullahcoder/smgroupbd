<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMessage extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'address', 'message', 'status', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with(['attribute', 'vendor'])->withTrashed();
    }
}
