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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->foreignId('org_id')->constrained();
            $table->string('phone')->nullable();
            $table->string('job');
            $table->foreignId('crust_id')->constrained();

            $table->index('surname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
