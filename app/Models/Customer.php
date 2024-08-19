<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_customer';
    protected $keyType = 'string'; // Tipe data primary key
    public $incrementing = false; // Tidak menggunakan incrementing ID
    protected $fillable = [
        'nama_customer',
        'alamat_kirim',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            // Mengambil nilai terakhir dari id_biaya
            $lastCustomer = Customer::orderBy('id_customer', 'desc')->first();
            $nextId = $lastCustomer ? intval(substr($lastCustomer->id_customer, 2)) + 1 : 1;
            $customer->id_customer = 'P-' . $nextId;
        });
    }

    public function orders()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function armadas()
    {
        return $this->hasMany(Armada::class, 'id_customer');
    }
    public function costs()
    {
        return $this->hasMany(Cost::class);
    }
}
