<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by');
            $table->boolean('type');
            $table->integer('amount');
            $table->integer('account_id')->nullable();
            $table->integer('category_id');
            $table->integer('mode_id');
            $table->date('date');
            $table->time('time');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transcations');
    }
}
