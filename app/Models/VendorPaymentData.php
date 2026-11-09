<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPaymentData extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_payment_id', 'lifting_id', 'paid'];

    public function lifting()
    {
        return $this->belongsTo(Lifting::class, 'lifting_id');
    }

    public function payment()
    {
        return $this->belongsTo(VendorPayment::class, 'vendor_payment_id');
    }
}
