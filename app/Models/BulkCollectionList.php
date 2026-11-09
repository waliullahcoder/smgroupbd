<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkCollectionList extends Model
{
    use HasFactory;
    protected $fillable = ['bulk_collection_id', 'collection_id', 'client_id', 'sales_id', 'invoice_amount', 'paid_amount', 'money_receipt'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id')->withTrashed();
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }
}
