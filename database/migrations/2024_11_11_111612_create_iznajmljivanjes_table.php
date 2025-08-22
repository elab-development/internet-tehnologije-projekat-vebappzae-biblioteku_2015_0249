<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('iznajmljivanja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korisnik_id')->constrained('korisnici')->onDelete('cascade');
            $table->foreignId('knjiga_id')->constrained('knjige')->onDelete('cascade');
            $table->date('pocetak_pretplate');
            $table->date('kraj_pretplate')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pretplatas');
    }
};
