<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Armada extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_armada'; // Primary key
    protected $keyType = 'string'; // Tipe data primary key
    public $incrementing = false; // Tidak menggunakan incrementing ID
    protected $fillable = [
        'nomor_polisi',
        'jenis_armada',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($armada) {
            // Mengambil nilai terakhir dari id_biaya
            $lastArmada = Armada::orderBy('id_armada', 'desc')->first();

            // Jika tidak ada id_armada sebelumnya, mulai dengan C-1
            if (!$lastArmada) {
                $armada->id_armada = 'A-1';
            } else {
                // Jika ada id_armada sebelumnya, ambil nomor terakhir dan tambahkan 1
                $lastNumber = intval(substr($lastArmada->id_armada, 2));
                $nextNumber = $lastNumber + 1;
                $armada->id_armada = 'A-' . $nextNumber;
            }
        });
    }


    public function users()
    {
        return $this->hasMany(User::class, 'nomor_polisi', 'nomor_polisi');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    // Menentukan relasi ke model Cost (satu armada bisa memiliki banyak biaya)
    public function costs()
    {
        return $this->hasMany(Cost::class, 'id_armada');
    }
}
