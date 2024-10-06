<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('source_id')->unsigned()->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->unsignedBigInteger('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')->on('authors');

            $table->enum('status', ['Draft', 'Published', 'Deleted'])->default('Draft');
            $table->boolean('features')->default(0);

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();

            $table->boolean('image')->default(0);
            $table->string('image_url')->nullable();
            $table->text('image_caption')->nullable();
            $table->string('image_credits')->nullable();

            $table->boolean('gallery')->default(0);
            $table->string('gallery_url')->nullable();
            $table->text('gallery_caption')->nullable();
            $table->string('gallery_credits')->nullable();

            $table->text('meta_decription')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_author')->nullable();

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
