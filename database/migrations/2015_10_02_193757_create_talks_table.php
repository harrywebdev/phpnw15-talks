<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_talk')->default(0);
            $table->unsignedInteger('speaker_id')->nullable();

            $table->tinyInteger('track')->nullable();
            $table->string('title');
            $table->datetime('starts_at');
            $table->datetime('ends_at')->nullable();

            $table->timestamps();

            $table->foreign('speaker_id')->references('id')->on('speakers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('talks');
    }
}
