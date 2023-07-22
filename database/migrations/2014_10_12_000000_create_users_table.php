<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pada migration ini kita akan membuat tabel users.
     * Dimana migrasi ini telah dibuat otomatis oleh laravel.
     * terdiri dari beberapa kolom yaitu :
     * ID : kolom id yang akan menjadi primary key
     * Name : kolom nama
     * Email : kolom email
     * Email_verified_at : kolom verifikasi email
     * Password : kolom password
     * Remember_token : kolom remember token
     * Created_at : kolom tanggal dibuat
     * Updated_at : kolom tanggal diupdate
     * 
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel users.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
