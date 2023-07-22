<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pada migration ini kita akan membuat tabel failed_jobs.
     * Dimana migrasi ini telah dibuat otomatis oleh laravel.
     * terdiri dari beberapa kolom yaitu :
     * ID : kolom id yang akan menjadi primary key
     * UUID : kolom uuid
     * Connection : kolom connection
     * Queue : kolom queue
     * Payload : kolom payload
     * Exception : kolom exception
     * Failed_at : kolom tanggal failed
     * 
     */
    public function up(): void
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Hapus tabel failed_jobs.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
