<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pada migration ini kita akan membuat tabel personal_access_tokens.
     * Dimana migrasi ini telah dibuat otomatis oleh laravel.
     * terdiri dari beberapa kolom yaitu :
     * ID : kolom id yang akan menjadi primary key
     * Tokenable_id : kolom tokenable_id
     * Tokenable_type : kolom tokenable_type
     * Name : kolom nama
     * Token : kolom token
     * Abilities : kolom abilities
     * Last_used_at : kolom tanggal terakhir digunakan
     * Expires_at : kolom tanggal expired
     * 
     */
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel personal_access_tokens.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
