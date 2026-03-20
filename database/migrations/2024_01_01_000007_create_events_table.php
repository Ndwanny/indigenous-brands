<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('location')->nullable();
            $table->string('venue')->nullable();
            $table->date('event_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->boolean('is_free')->default(true);
            $table->enum('event_type', ['Coffee Date', 'Bootcamp', 'Workshop', 'Showcase', 'Networking Event'])->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'past', 'cancelled'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
