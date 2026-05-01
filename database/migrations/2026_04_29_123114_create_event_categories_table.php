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
        Schema::create('event_categories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->foreignUuid('event_uid')->constrained('events', 'uid')->onDelete('cascade');
            $table->foreignUuid('category_uid')->nullable()->constrained('categories', 'uid')->onDelete('cascade');
            
            $table->unsignedInteger('acara_number')->nullable(); // e.g., 101
            $table->string('acara_name')->nullable(); // e.g., '50M KICKING BEBAS PUTRA'
            $table->string('age_category')->nullable(); // e.g., 'KU 2017'
            
            $table->decimal('registration_fee', 12, 2)->default(0.00);
            $table->integer('total_series')->default(1); // Jumlah Seri
            
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('location')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_categories');
    }
};
