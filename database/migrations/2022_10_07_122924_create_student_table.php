<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
*   student table that hold general student table
*/
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id('unique_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->Integer('program_id')->unsigned()->index();
            $table->bigInteger('created_by')->unsigned()->index();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
            
            // set foreign key for user and program table
            $table->foreign('created_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('program_id')
            ->references('id')
            ->on('programs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
};
