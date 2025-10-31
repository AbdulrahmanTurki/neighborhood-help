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
        Schema::create('help_requests', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Author of the post
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete(); // Category for the post

            // Post content
            $table->string('title');
            $table->text('body');
            
            // Post metadata: 'request' (need help) or 'offer' (offering help)
            $table->enum('type', ['request', 'offer']); 
            
            // Status: 'open', 'in_progress', 'completed', 'closed'
            $table->enum('status', ['open', 'in_progress', 'completed', 'closed'])->default('open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_requests');
    }
};