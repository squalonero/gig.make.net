<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSocietasTableAddWidths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('societas', function (Blueprint $table) {
            $table->integer('logo_width')->after('logo');
            $table->integer('endorsement_width')->after('endorsement');
            $table->integer('sponsor_width')->after('sponsor_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('societas', function (Blueprint $table) {
            $table->dropColumn('logo_width');
            $table->dropColumn('endorsement_width');
            $table->dropColumn('sponsor_width');
        });
    }
}
