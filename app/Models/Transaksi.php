<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'total',
        'bayar',
        'kembalian'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}