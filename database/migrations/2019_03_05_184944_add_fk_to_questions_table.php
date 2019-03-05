<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->integer('answer_id')->unsigned()->nullable()->after('id');
            $table->integer('visitor_id')->unsigned()->nullable()->after('id');
            $table->foreign('answer_id')->references('id')->on('answers');
            $table->foreign('visitor_id')->references('id')->on('visitors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('answer_id');
            $table->dropColumn('visitor_id');
        });
    }
}
