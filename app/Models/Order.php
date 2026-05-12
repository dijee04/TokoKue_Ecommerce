<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pelanggan', 'no_wa', 'alamat', 'total_harga', 'status', 'metode_pembayaran'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
