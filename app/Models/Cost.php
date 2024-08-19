<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_biaya';
    protected $keyType = 'string'; // Tipe data primary key
    public $incrementing = false; // Tidak menggunakan incrementing ID
    protected $fillable = [
        'jenis_armada',
        'alamat_kirim',
        'ongkos_angkut',
        'id_armada',
        'id_customer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cost) {
            // Mengambil nilai terakhir dari id_biaya
            $lastCost = Cost::orderBy('id_biaya', 'desc')->first();

            // Jika tidak ada id_biaya sebelumnya, mulai dengan C-1
            if (!$lastCost) {
                $cost->id_biaya = 'C-1';
            } else {
                // Jika ada id_biaya sebelumnya, ambil nomor terakhir dan tambahkan 1
                $lastNumber = intval(substr($lastCost->id_biaya, 2));
                $nextNumber = $lastNumber + 1;
                $cost->id_biaya = 'C-' . $nextNumber;
            }
        });
    }

    public function armada()
    {
        return $this->belongsTo(Armada::class, 'id_armada');
    }

    // Menentukan relasi ke model Customer melalui Armada (satu biaya terkait dengan satu customer)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    // (satu biaya terkait dengan banyak transaksi)
    public function Post()
    {
        return $this->hasMany(Transaksi::class, 'id_biaya');
    }
}
