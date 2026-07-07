<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            if (!Schema::hasColumn('pets', 'species_id')) {
                $table->foreignId('species_id')
                    ->nullable()
                    ->after('owner_id')
                    ->constrained('species')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('pets', 'breed_id')) {
                $table->foreignId('breed_id')
                    ->nullable()
                    ->after('species_id')
                    ->constrained('breeds')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('pets', 'date_of_birth')) {
                $table->date('date_of_birth')
                    ->nullable()
                    ->after('gender');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            if (Schema::hasColumn('pets', 'species_id')) {
                $table->dropForeign(['species_id']);
            }

            if (Schema::hasColumn('pets', 'breed_id')) {
                $table->dropForeign(['breed_id']);
            }

            if (Schema::hasColumn('pets', 'species_id')) {
                $table->dropColumn('species_id');
            }

            if (Schema::hasColumn('pets', 'breed_id')) {
                $table->dropColumn('breed_id');
            }

            if (Schema::hasColumn('pets', 'date_of_birth')) {
                $table->dropColumn('date_of_birth');
            }
        });
    }
};