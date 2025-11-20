<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCataloguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_catalogues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();

            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('level')->default(0);
            $table->integer('order')->default(0);
            $table->integer('parent_id')->default(0);

            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('canonical')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_catalogues');
    }
}
