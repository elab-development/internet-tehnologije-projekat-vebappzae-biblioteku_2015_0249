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
        Schema::table('pretplata', function (Blueprint $table) {
                // Dodavanje stranih ključeva za korisnik_id i knjiga_id
                $table->foreign('korisnik_id')->references('id')->on('korisnik')->onDelete('cascade');
                $table->foreign('knjiga_id')->references('id')->on('knjiga')->onDelete('cascade');
    
                // Dodavanje provere za datum izdavanja i datum vraćanja
                $table->date('datum_izdavanja')->nullable(false)->change(); // Datum izdavanja ne može biti null
                $table->date('kraj_pretplate')->nullable(); // Datum vraćanja može biti null, ali može imati dodatno logičko ograničenje
    
                // Logičko ograničenje za datume (ako koristite MySQL sa check constraints)
                $table->check('kraj_pretplate >= datum_izdavanja'); // Datum vraćanja mora biti posle datuma izdavanja
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pretplata', function (Blueprint $table) {
            // Uklanjanje stranih ključeva
            $table->dropForeign(['korisnik_id']);
            $table->dropForeign(['knjiga_id']);

            // Uklanjanje logičkog ograničenja (ako postoji)
            $table->dropCheck('kraj_pretplate >= datum_izdavanja');
        });
    }
};
