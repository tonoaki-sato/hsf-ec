<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropRowDataFromMlMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ml_mails', function (Blueprint $table) {
            //
            $table->dropColumn('row_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ml_mails', function (Blueprint $table) {
            //
            $table->string('row_data')->after('h_subject');
        });
    }
}
