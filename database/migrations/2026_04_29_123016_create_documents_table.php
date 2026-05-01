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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->foreignUuid('event_uid')->constrained('events', 'uid')->onDelete('cascade');
            
            $table->string('name');
            $table->enum('type', ['result', 'schedule', 'certificate', 'invoice', 'other'])->default('other');
            $table->string('file_path')->nullable(); // Lokasi file ekspor
            $table->json('layout_settings')->nullable(); // Menyimpan setting kolom, logo, total harga, dll
            $table->decimal('total_price', 15, 2)->nullable(); // Untuk dokumen hasil/invoice
            $table->boolean('is_public')->default(false);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('logo_left', 255)->nullable();
            $table->string('logo_right', 255)->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
