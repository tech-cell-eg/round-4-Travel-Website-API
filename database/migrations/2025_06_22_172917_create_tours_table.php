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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');

            $table->string('title');
            $table->text('overview')->nullable();
            $table->unsignedTinyInteger('duration_days')->nullable();
            $table->unsignedTinyInteger('group_size')->nullable();

            $table->json('age')->nullable();
            $table->json('languages')->nullable();

            $table->json('highlights')->nullable();
            $table->json('included')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('notes')->nullable();

            $table->decimal('price_adult', 10, 2)->nullable();
            $table->decimal('price_youth', 10, 2)->nullable();
            $table->decimal('price_child', 10, 2)->nullable();
            $table->decimal('extra_service_booking', 10, 2)->nullable();
            $table->decimal('extra_service_adult', 10, 2)->nullable();
            $table->decimal('extra_service_youth', 10, 2)->nullable();

            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();

            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('review_count')->default(0);

            $table->string('slug')->unique();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
