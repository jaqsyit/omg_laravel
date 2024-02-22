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
        Schema::create('questionaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('exam_id')->constrained();
            $table->integer('criterion_1');
            $table->integer('criterion_2');
            $table->integer('criterion_3');
            $table->integer('criterion_4');
            $table->string('criterion_5');
            $table->string('criterion_6');
            $table->integer('criterion_7');
            $table->string('criterion_8');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionaries');
    }
};
