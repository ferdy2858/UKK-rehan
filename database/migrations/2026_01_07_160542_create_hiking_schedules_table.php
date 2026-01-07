<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hiking_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mountain_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date');
            $table->integer('quota');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hiking_schedules');
    }
};
