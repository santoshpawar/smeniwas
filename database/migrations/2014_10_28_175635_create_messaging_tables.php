<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')->unsigned()->nullable();
            $table->string('subject');
            $table->integer('is_replied')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();

            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });

        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('from_user_id');
            $table->integer('user_id');
            $table->text('body');
            $table->timestamp('last_read');
            $table->text('source');
            $table->string('upload_file');
            $table->integer('from_user_delete')->nullable();
            $table->string('to_user_delete')->nullable();
            $table->timestamps();

            $table->foreign('thread_id')->references('id')->on('threads');
//            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE `'.DB::getTablePrefix().'participants` CHANGE COLUMN `last_read` `last_read` timestamp NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `'.DB::getTablePrefix().'participants` CHANGE COLUMN `last_read` `last_read` timestamp NULL DEFAULT NULL;');


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('participants');
        Schema::drop('messages');
        Schema::drop('threads');
    }
}
