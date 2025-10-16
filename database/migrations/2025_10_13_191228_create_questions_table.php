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
        Schema::create('questions', function (Blueprint $table) {
            $table->id()->comment('Unique question ID');

            $table->foreignId("category_id")->comment('ID of the category this question belongs to')->constrained("categories")->onDelete("cascade");
            $table->foreignId("user_id")->comment('ID of the user who created this question')->constrained("users")->onDelete("cascade");

            $table->string("title")->comment('Question title');
            $table->string('slug')->unique();
            $table->text("description")->comment('Detailed description of the question');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
