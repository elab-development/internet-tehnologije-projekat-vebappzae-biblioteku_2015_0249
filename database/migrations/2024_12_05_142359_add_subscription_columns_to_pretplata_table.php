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
            $table->date('pocetak_pretplate');  // Datum početka pretplate
            $table->date('kraj_pretplate');     // Datum završetka pretplate
            $table->enum('status_pretplate', ['nedeljna', 'mesecna', 'godisnja', 'istekla', 'nema_pretplatu'])->default('nema_pretplatu'); // Status pretplate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pretplata', function (Blueprint $table) {
            //
        });
    }
};
