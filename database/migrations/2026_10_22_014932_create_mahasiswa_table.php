<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->unsignedInteger('angkatan')->nullable();
            $table->string('program_studi', 100)
                ->default('D3 Teknik Informatika');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn([
                'jenis_kelamin',
                'email',
                'angkatan',
                'program_studi',
            ]);
        });
    }
};