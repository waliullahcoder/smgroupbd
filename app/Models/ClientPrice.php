<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPrice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['client_id', 'product_id', 'default_price', 'client_price', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->with(['company'])->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with(['category'])->withTrashed();
    }
}
