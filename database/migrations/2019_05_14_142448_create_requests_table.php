<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->smallInteger('status')->default(0);
            $table->boolean('cover');
            $table->text('description');
            $table->time('deadline')->nullable();
            $table->string('journal')->nullable();
            $table->string('kfs');
            $table->unsignedBigInteger('requestee');
            $table->unsignedBigInteger('illustrator')->nullable();
            $table->foreign('requestee')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('illustrator')
                ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
