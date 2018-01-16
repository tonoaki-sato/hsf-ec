<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('h_message_id', 100);
            $table->dateTime('h_date');
            $table->string('h_from');
            $table->string('h_subject');
            $table->text('row_data');
            $table->text('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_mails');
    }
}
