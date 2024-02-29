<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainners', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 255);
            $table->string('name', 255);
            $table->integer('gender');
            $table->string('phone_number', 20);
            $table->string('email');
            $table->text('skills');
            $table->longText('description');
            $table->integer('year_experience');
            $table->integer('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('trainners');
    }
};
