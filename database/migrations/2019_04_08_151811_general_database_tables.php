<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GeneralDatabaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('groups',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('city_id')->nullable();
            $table->text('description');
            $table->text('purpose');
            $table->string('image_path')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('boards',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('boardable_id')->unsigned();
            $table->integer('boardable_type')->unsigned();//morph to users and groups
            $table->timestamps();
        });

        Schema::create('wanted',function (Blueprint $table){
            $table->increments('id');
            $table->text('content');
            $table->dateTime('deadline')->nullable();
            $table->boolean('isResolved')->default(false);
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->timestamps();
        });



        Schema::create('sticks',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('latitude');
            $table->string('altitude');
            $table->float('before_price');
            $table->float('sale_price');
            $table->dateTime('begin_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->bigInteger('sticked_count')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('wanted_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups')->nullable();
            $table->foreign('wanted_id')->references('id')->on('wanted')->nullable();
            $table->timestamps();
        });





        Schema::create('interest_user', function (Blueprint $table) {
            $table->integer('interest_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['interest_id', 'user_id']);
        });

        Schema::create('group_interest', function (Blueprint $table) {
            $table->integer('interest_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->primary(['interest_id', 'group_id']);
        });

        Schema::create('board_interest', function (Blueprint $table) {
            $table->integer('interest_id')->unsigned();
            $table->integer('board_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');

            $table->primary(['interest_id', 'board_id']);
        });

        Schema::create('stick_interest', function (Blueprint $table) {
            $table->integer('interest_id')->unsigned();
            $table->integer('stick_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
            $table->foreign('stick_id')->references('id')->on('sticks')->onDelete('cascade');

            $table->primary(['interest_id', 'stick_id']);
        });

        Schema::create('board_stick', function (Blueprint $table) {
            $table->integer('stick_id')->unsigned();
            $table->integer('board_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('stick_id')->references('id')->on('sticks')->onDelete('cascade');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');

            $table->primary(['stick_id', 'board_id']);
        });

        Schema::create('user_stick', function (Blueprint $table) {
            $table->integer('stick_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('stick_id')->references('id')->on('sticks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['stick_id', 'user_id']);
        });

//        Schema::create('group_stick', function (Blueprint $table) {
//            $table->integer('stick_id')->unsigned();
//            $table->integer('group_id')->unsigned();
//            $table->nullableTimestamps();
//
//            $table->foreign('stick_id')->references('id')->on('sticks')->onDelete('cascade');
//            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
//
//            $table->primary(['stick_id', 'group_id']);
//        });

        Schema::create('group_user', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('is_admin')->default(false);//to resolve wanted ads.
            $table->nullableTimestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['group_id', 'user_id']);
        });

        Schema::create('comments',function (Blueprint $table){
            $table->increments('id');
            $table->text('content');
            $table->integer('user_id')->unsigned();
            $table->integer('stick_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('stick_id')->references('id')->on('sticks');
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
        //
        Schema::dropIfExists('interests');

        Schema::dropIfExists('boards');
        Schema::dropIfExists('sticks');

        Schema::dropIfExists('groups');

        Schema::dropIfExists('interest_user');
        Schema::dropIfExists('group_interest');
        Schema::dropIfExists('board_interest');
        Schema::dropIfExists('stick_interest');
        Schema::dropIfExists('board_stick');
        Schema::dropIfExists('user_stick');
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('wanted');
    }
}
