<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('sku')->nullable();
            $table->string('qr_code')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('image')->nullable();

            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->json('album')->nullable();

            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('canonical')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('category_id');
            $table->index('brand_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
