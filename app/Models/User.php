<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'id'; // Primary key
    protected $keyType = 'string'; // Tipe data primary key
    public $incrementing = false; // Tidak menggunakan incrementing ID
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [  // fill yang tidak boleh di isi
        'id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Mengambil nilai terakhir dari id_biaya
            $lastUser = User::orderBy('id', 'desc')->first();

            // Jika tidak ada id sebelumnya, mulai dengan C-1
            if (!$lastUser) {
                $user->id = 'U-1';
            } else {
                // Jika ada id sebelumnya, ambil nomor terakhir dan tambahkan 1
                $lastNumber = intval(substr($lastUser->id, 2));
                $nextNumber = $lastNumber + 1;
                $user->id = 'U-' . $nextNumber;
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function armada()
    {
        return $this->belongsTo(Armada::class, 'nomor_polisi', 'nomor_polisi');
    }
}
