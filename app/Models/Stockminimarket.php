<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockminimarket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','barang_id', 'catbarang_id', 'minimarket_id', 'gudang_id', 'stock', 'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorybarang::class,'id');
    }

    public function minimarket()
    {
        return $this->belongsTo(Minimarket::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
