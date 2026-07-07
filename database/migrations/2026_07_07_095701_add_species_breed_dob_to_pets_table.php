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
    Schema::table('pets', function (Blueprint $table) {
        $table->foreignId('species_id')->nullable()->after('owner_id')->constrained('species')->nullOnDelete();
        $table->foreignId('breed_id')->nullable()->after('species_id')->constrained('breeds')->nullOnDelete();
        $table->date('date_of_birth')->nullable()->after('gender');
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('pets', function (Blueprint $table) {
        $table->dropForeign(['species_id']);
        $table->dropForeign(['breed_id']);
        $table->dropColumn(['species_id', 'breed_id', 'date_of_birth']);
    });
}
};
