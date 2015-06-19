<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRdvsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned()->index();
            $table->integer('guest_id')->unsigned()->nullable()->index();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->integer('duration')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->string('body')->nullable();
            $table->char('color', 6)->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('updated_by')->unsigned()->index();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rdvs');
    }

}
