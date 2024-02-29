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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 45)->unique();
            $table->string('name_kh', 255);
            $table->string('name_en', 255);
            $table->string('short_description', 255);
            $table->text('description');
            $table->string('total_hours', 55);
            $table->float('price');
            $table->integer('status')->default(1);
            $table->integer('trainer_id');
            $table->integer('course_category_id');
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
