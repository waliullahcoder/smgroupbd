<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryList extends Model
{
    use HasFactory;
    protected $fillable = ['delivery_id', 'client_id', 'sales_id', 'product_id', 'rate', 'qty', 'amount', 'sales_list_id'];

    public function sales_item()
    {
        return $this->belongsTo(SalesList::class, 'sales_list_id')->with(['client', 'product']);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id')->with(['vehicle'])->withTrashed();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client')->withTrashed();
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id')->with(['client'])->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with(['attribute']);
    }
}
