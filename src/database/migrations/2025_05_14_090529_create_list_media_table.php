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
        Schema::create('list_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained()->cascadeOnDelete();
            $table->string('media_id');
            $table->enum('media_type', ['movie', 'tv', 'person']);
            $table->timestamps();
            
            $table->unique(['list_id', 'media_type', 'media_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_media');
    }
};
