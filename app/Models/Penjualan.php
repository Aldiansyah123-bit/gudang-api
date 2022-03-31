<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'barang_id', 'catbarang_id', 'minimarket_id', 'qty'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Categorybarang::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorybarang::class,'id');
    }

    public function minimarket()
    {
        return $this->belongsTo(Minimarket::class);
    }
}
