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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId("question_id")->comment("ID of the question this answer belongs to")->constrained("questions")->onDelete("cascade");
            $table->foreignId("user_id")->comment("ID of the user who created this answer")->constrained("users")->onDelete("cascade");

            $table->text("content")->comment("Content of the answer");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};