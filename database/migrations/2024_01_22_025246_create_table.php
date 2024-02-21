<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('social_media_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('social_media_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('social_media_accounts');
    }
};
