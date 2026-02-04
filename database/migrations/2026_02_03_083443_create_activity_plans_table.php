<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('activity_plans', function (Blueprint $table) {

            $table->id();

            // JENIS ACTIVITY (Dropdown)
            $table->enum('jenis_activity', [
                'Offline',
                'Online'
            ]);

            // ACTIVITY (Dropdown 8 pilihan)
            $table->enum('activity', [
                'D_MARKETING',
                'EXHIBITION',
                'MOVING_EXHIBITION',
                'SHOWROOM_EVENT',
                'GROUP_PRESENTATION',
                'EVENT_TEST_DRIVE',
                'OPEN_TABLE',
                'CETAK_FLYER'
            ]);

            // PLATFORM / LOKASI
            $table->string('platform_lokasi')->required();


            // Jenis Unit (Dropdown)
            $table->enum('jenis_unit', [
                'Commercial',
                'Passenger'
            ])->required();

            // Type Unit (Dropdown 8 pilihan)
            $table->enum('type_unit', [
                'CARRY_PU',
                'CARRY_BOX',
                'CARRY_BV',
                'CARRY_MOKO',
                'CARRY_AMBULANCE',
                'CARRY_TOWING',
                'APV_MB',
                'APV_AMBULANCE',
                'ERTIGA',
                'ERTIGA_HYBRID',
                'XL7',
                'XL7_HYBRID',
                'S_PRESSO',
                'IGNIS',
                'BALENO',
                'GRAND_VITARA',
                'JIMNY'
            ])->required();

            // WAKTU PELAKSANAAN
            $table->date('tanggal')->required();
            $table->time('jam')->required();

            // PIC
            $table->string('pic')->required();

            // JML SALES PER SHIFT
            $table->string('jml_sales_shift')->required();

            // TARGET
            $table->integer('target_p')->default(0);
            $table->integer('target_hp')->default(0);
            $table->integer('target_spk')->default(0);

            // ACTUAL SD AKHIR BULAN
            $table->integer('actual_p')->default(0);
            $table->integer('actual_hp')->default(0);
            $table->integer('actual_spk')->default(0);
            $table->integer('actual_do')->default(0);

            // COST
            $table->decimal('total_cost', 15, 2)->default(0);

            $table->decimal('cost_p', 15, 2)->default(0);
            $table->decimal('cost_spk', 15, 2)->default(0);
            $table->decimal('cost_do', 15, 2)->default(0);

            // KETERANGAN
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_plans');
    }
};
