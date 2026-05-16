<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'wa_number', 'bank_name', 'bank_account', 'bank_owner',
        'dana_number', 'dana_owner', 'gopay_number', 'gopay_owner'
    ];
}
