<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionData extends Model
{
    use HasFactory;
    protected $fillable = ['collection_id', 'sales_id', 'amount'];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }
}
