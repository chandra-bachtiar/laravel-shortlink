<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pada migration ini kita akan membuat tabel password_reset_tokens.
     * Dimana migrasi ini telah dibuat otomatis oleh laravel.
     * terdiri dari beberapa kolom yaitu :
     * Email : kolom email yang akan menjadi primary key
     * Token : kolom token
     * Created_at : kolom tanggal dibuat
     */
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Hapus tabel password_reset_tokens.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
