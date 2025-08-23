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
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // povezuje sa users tabelom
        $table->foreignId('book_id')->constrained()->onDelete('cascade'); // povezuje sa books tabelom
        $table->date('rented_at'); // datum iznajmljivanja
        $table->date('returned_at')->nullable(); // datum vraćanja
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
