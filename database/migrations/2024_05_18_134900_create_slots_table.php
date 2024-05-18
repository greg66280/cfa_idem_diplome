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
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_uid");
            $table->timestamp("start")->nullable();
            $table->timestamp("end")->nullable();
            $table->unsignedBigInteger("taked_by")->nullable();
            $table->timestamps();

            $table->foreign('user_uid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('taked_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
