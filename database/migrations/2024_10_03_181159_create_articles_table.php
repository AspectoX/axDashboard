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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('source_id')->unsigned()->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->unsignedBigInteger('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')->on('authors');

            $table->enum('status',['Draft','Published','Deleted'])->nullable();
            $table->boolean('features')->default(0);

            $table->string('title',150);
            $table->string('slug',150)->unique();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();

            $table->boolean('imageintro')->default(0);
            $table->text('imageintro_title')->nullable();
            $table->string('imageintro_url')->nullable();
            $table->text('imageintro_caption')->nullable();
            $table->string('imageintro_credits')->nullable();

            $table->boolean('image')->default(0);
            $table->string('image_url')->nullable();
            $table->text('image_caption')->nullable();
            $table->string('image_credits')->nullable();

            $table->boolean('gallery')->default(0);
            $table->string('gallery_url')->nullable();
            $table->text('gallery_caption')->nullable();
            $table->string('gallery_credits')->nullable();

            $table->boolean('video')->default(0);
            $table->string('video_url')->nullable();
            $table->text('video_caption')->nullable();
            $table->string('video_credits')->nullable();

            $table->boolean('audio')->default(0);
            $table->string('audio_url')->nullable();
            $table->text('audio_caption')->nullable();
            $table->string('audio_credits')->nullable();

            $table->dateTime('publish_up')->nullable();
            $table->dateTime('publish_down')->nullable();

            $table->text('meta_decription')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_author')->nullable();

            $table->boolean('trash')->default(0);
            $table->integer('access')->default(0);
            $table->integer('order')->default(0);
            $table->integer('hits')->default(0);
            $table->integer('featured_ordering')->default(0);
            $table->string('updated_by')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
