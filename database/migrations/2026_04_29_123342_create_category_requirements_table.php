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
        Schema::create('category_requirements', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->foreignUuid('event_category_uid')->constrained('event_categories', 'uid')->onDelete('cascade');
            
            $table->string('parameter_name', 255);
            $table->string('parameter_type', 50)->default('string');
            $table->json('parameter_value')->nullable();
            $table->string('operator', 50)->default('=');
            $table->boolean('is_required')->default(true);
            $table->integer('priority')->default(1);
            $table->text('error_message')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_requirements');
    }
};
