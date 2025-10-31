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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Foreign Key to users table (One-to-One relationship)
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete(); // Ensures only one profile per user
            
            // Additional profile fields (e.g., for location, bio)
            $table->text('bio')->nullable();
            $table->string('location')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};