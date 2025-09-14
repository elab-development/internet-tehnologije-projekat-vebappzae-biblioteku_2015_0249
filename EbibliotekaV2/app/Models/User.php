<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('first_name'); // first name
            $table->string('last_name');  // last name
            $table->string('email')->unique(); // unique email
            $table->timestamp('email_verified_at')->nullable(); // email verification
            $table->string('password'); // password
            $table->date('birth_date')->nullable(); // date of birth (optional)
            $table->rememberToken(); // remember me token
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
