<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSocietasTableAddSponsor extends Migration
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
            $table->string('sponsor_img_link', 255)->after('endorsement_link');
            $table->mediumText('sponsor_img')->after('endorsement_link');
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
            $table->dropColumn('sponsor_img');
            $table->dropColumn('sponsor_img_link');
        });
    }
}
