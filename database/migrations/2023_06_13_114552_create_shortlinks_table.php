<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pada migration ini kita akan membuat tabel shortlinks.
     * Dimana hanya table ini yang akan kita buat secara manual.
     * 
     * Fungsi dari tabel ini adalah untuk menyimpan data shortlink yang telah dibuat.
     * terdiri dari beberapa kolom yaitu :
     * ID : kolom id yang akan menjadi primary key
     * Shorturl : kolom untuk menyimpan shorturl atau url pendek
     * Longurl : kolom untuk menyimpan longurl atau url panjang yang asli
     * Clicks : kolom untuk menyimpan jumlah klik untuk shortlink tersebut
     * Active : kolom untuk menyimpan status aktif atau tidaknya shortlink tersebut
     * User_id : kolom untuk menyimpan id user yang membuat shortlink tersebut
     * Expired : kolom untuk menyimpan tanggal expired shortlink tersebut
     * Created_at : kolom tanggal dibuat
     * Updated_at : kolom tanggal diupdate
     * deleted_at : kolom tanggal dihapus (soft delete)
     * 
     * Pada table ini kita akan menggunakan soft delete, dimana data yang dihapus tidak akan benar-benar dihapus dari database.
     * untuk User_id kita akan menggunakan unsignedBigInteger karena kita akan menggunakan relasi pada tabel ini dengan tabel users.
     */
    public function up(): void
    {
        Schema::create('shortlinks', function (Blueprint $table) {
            $table->id();
            $table->string('shorturl')->unique();
            $table->text('longurl');
            $table->integer('clicks')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('expired')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel shortlinks.
     */
    public function down(): void
    {
        Schema::dropIfExists('shortlinks');
    }
};
