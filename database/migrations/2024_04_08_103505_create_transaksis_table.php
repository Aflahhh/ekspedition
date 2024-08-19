<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi'); // Primary Key
            $table->foreignId('user_id');
            $table->dateTime('tanggal_muat');
            $table->decimal('fo', 10, 3);
            $table->decimal('fu', 10, 3);
            $table->string('nomor_polisi');
            $table->string('driver');
            $table->string('jenis_armada');
            $table->string('nama_customer');
            $table->string('alamat_kirim');
            $table->decimal('ongkos_angkut', 10, 3);
            $table->decimal('biaya_rcf', 10, 3);
            $table->decimal('biaya_return', 10, 3);
            $table->decimal('biaya_inap', 10, 3);
            $table->decimal('multi_drop', 10, 3);
            $table->decimal('tob', 10, 3);
            $table->decimal('total_biaya', 10, 3);
            $table->string('image');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('id_armada');
            $table->foreignId('id_customer');
            $table->foreignId('id_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
