<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconToMultiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('image');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('image');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('image');
        });
        Schema::table('post_catalogues', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('image');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        Schema::table('post_catalogues', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
}
