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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->comment('Unique post ID');
            $table->foreignId("user_id")->comment("ID of the user who created this post")->constrained("users")->onDelete("cascade");
            $table->string("title")->comment("Title of the post");
            $table->text("content")->comment("Content of the post");
            $table->string("image")->comment("Image of the post(optional)")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
