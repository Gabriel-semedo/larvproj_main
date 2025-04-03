<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('plate'); 
            $table->unsignedBigInteger('company'); 
            $table->unsignedBigInteger('user'); 
            $table->timestamp('entry'); 
            $table->dateTime('exit')->nullable(); 
            

            
            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
