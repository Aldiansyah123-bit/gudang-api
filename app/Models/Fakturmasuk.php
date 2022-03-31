<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakturmasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'barang_id', 'catbarang_id', 'suplier_id', 'gudang_id', 'qty', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorybarang::class,'id');
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
