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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->time('delivery_duration')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled']);

            $table->foreignId('comment_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
