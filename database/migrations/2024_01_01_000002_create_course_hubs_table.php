<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_hubs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained('universities');
            $table->string('name');
            $table->string('course_code');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_hubs');
    }
};
