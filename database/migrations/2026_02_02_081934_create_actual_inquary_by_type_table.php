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
        Schema::create('actual_inquary_by_type', function (Blueprint $table) {
            $table->id();

            // enum mobil_type
           $table->enum('mobil_type', [
                'NEW CARRY',
                'APV',
                'ERTIGA',
                'XL7',
                'SPRESO',
                'BALENO',
                'GRAND VITARA',
                'JIMNY 3D',
                'JIMNY 5D',
                'FRONX',
            ])->nullable();

            $table->year('tahun');

            // loop bulan
            $months = [
                'jan', 'feb', 'mar', 'apr', 'mei', 'jun',
                'jul', 'agu', 'sep', 'okt', 'nov', 'des'
            ];

            foreach ($months as $month) {
                $table->integer($month)->default(0);
            }

            $table->integer('total')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actual_inquary_by_type');
    }
};
