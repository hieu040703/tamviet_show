<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTargetIconToMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            if (!Schema::hasColumn('menu_items', 'target')) {
                $table->string('target')->default('_self')->after('url');
            }
            if (!Schema::hasColumn('menu_items', 'icon')) {
                $table->string('icon')->nullable()->after('target');
            }
            if (!Schema::hasColumn('menu_items', 'parent_id')) {
                $table->integer('parent_id')->default(0);
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            if (Schema::hasColumn('menu_items', 'icon')) {
                $table->dropColumn('icon');
            }
            if (Schema::hasColumn('menu_items', 'target')) {
                $table->dropColumn('target');
            }
            if (Schema::hasColumn('menu_items', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
        });
    }
}
