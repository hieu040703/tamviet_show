<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('router_id')->nullable(); // liên kết bảng routers
            $table->string('name')->nullable();                  // text hiển thị
            $table->string('url')->nullable();                   // canonical hoặc link custom
            $table->string('type')->nullable();                  // category, product, custom...
            $table->unsignedBigInteger('parent_id')->default(0);

            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('level')->nullable();

            $table->integer('sort_order')->default(0);
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('router_id')->references('id')->on('routers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
