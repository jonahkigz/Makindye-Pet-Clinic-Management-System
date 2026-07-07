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
    if (!Schema::hasTable('breeds')) {
        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('species_id')->constrained('species')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });
    }
}

public function down(): void
{
    Schema::dropIfExists('breeds');
}
};
