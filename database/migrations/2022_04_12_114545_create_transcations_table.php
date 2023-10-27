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
            $table->enum('type', [0, 1])->default(0);
            $table->float('amount', 8, 2);
            $table->integer('account_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('mode_id')->nullable();
            $table->date('date');
            $table->string('time')->nullable();
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
