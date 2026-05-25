<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kurir_id', 'nama_pelanggan', 'no_wa', 'alamat', 'ongkir', 'total_harga', 'status', 'metode_pembayaran', 'snap_token', 'payment_status', 'bukti_pengiriman'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
