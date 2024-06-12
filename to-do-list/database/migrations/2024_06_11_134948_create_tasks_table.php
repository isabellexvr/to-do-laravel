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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 100);

            // Add description column
            $table->text('description');

            // Add userId column as foreign key
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            // Add endsAt column
            $table->timestamp('endsAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
