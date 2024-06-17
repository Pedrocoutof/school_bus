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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('zip_code');
            $table->string('public_place');
            $table->string('state');
            $table->string('neighborhood');
            $table->string('complement')->nullable();
            $table->string('city');
            $table->string('number');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
