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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->text('introduction')->nullable();

            $table->string('mission_title')->nullable();
            $table->text('mission_content')->nullable();

            $table->string('teaching_title')->nullable();
            $table->text('teaching_content')->nullable();

            $table->string('audience_title')->nullable();
            $table->text('audience_content')->nullable();

            $table->string('why_learn_title')->nullable();
            $table->text('why_learn_content')->nullable();

            $table->string('cta_title')->nullable();
            $table->text('cta_content')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
