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
        Schema::create('green_listings', function (Blueprint $table) {
            $table->id();
            //foreign - иностранный, constrained - ограниченный
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('company');
            $table->string('tags');
            $table->string('location');
            $table->string('description');
            $table->string('email');
            $table->string('website');
            $table->string('logo')->nullable();
            $table->integer('votes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('green_listings');
    }
};
