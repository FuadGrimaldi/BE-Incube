<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable = [
        'id_cus', 'transaction_type_id', 'payment_method_id',
        'id_product', 'amount', 'transaction_code', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_cus');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_product', 'id');
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
