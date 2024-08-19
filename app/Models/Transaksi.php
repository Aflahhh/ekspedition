<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaksis';
    protected $primaryKey = 'id'; // Primary key
    protected $keyType = 'string'; // Tipe data primary key
    public $incrementing = false; // Tidak menggunakan incrementing ID


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            // Mengambil nilai terakhir dari id_biaya
            $lastTransaksi = Transaksi::orderBy('id', 'desc')->first();
            $nextId = $lastTransaksi ? intval(substr($lastTransaksi->id, 2)) + 1 : 1;
            $transaksi->id = 'L-' . $nextId;
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function aramada()
    {
        return $this->belongsTo(Armada::class);
    }

    // setiap entitas dalam model Transaksi  terkait dengan satu entitas dalam model Cost
    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }
}
