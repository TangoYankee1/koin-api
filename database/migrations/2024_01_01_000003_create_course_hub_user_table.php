<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_hub_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('course_hub_id')->constrained('course_hubs');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_hub_user');
    }
};
