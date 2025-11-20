<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoutersUniqueBack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routers', function (Blueprint $table) {
            $table->dropUnique('routers_canonical_module_unique');
            $table->unique('canonical', 'routers_canonical_unique');
        });
    }

    public function down()
    {
        Schema::table('routers', function (Blueprint $table) {
            $table->dropUnique('routers_canonical_unique');
            $table->unique(['canonical', 'module'], 'routers_canonical_module_unique');
        });
    }
}
