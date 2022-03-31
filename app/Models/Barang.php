<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'suplier_id', 'gudang_id', 'name', 'stock', 'note_jual',
        'note_beli', 'expla'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorybarang::class);
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
