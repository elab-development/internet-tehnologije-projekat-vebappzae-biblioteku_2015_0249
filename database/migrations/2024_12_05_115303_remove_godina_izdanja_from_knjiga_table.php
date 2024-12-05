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
        Schema::table('knjiga', function (Blueprint $table) {
            $table->dropColumn('godina_izdanja'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('knjiga', function (Blueprint $table) {
            $table->integer('godina_izdanja')->nullable(); 
        });
    }
};
