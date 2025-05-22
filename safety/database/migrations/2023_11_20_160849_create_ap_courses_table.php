<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ap_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('ap_category_id')->references('id')->on('ap_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('duration')->nullable();
            $table->date('lastupdate')->nullable();
            $table->text('requirements')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('status')->default(1);
            $table->text('meta_title')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_des')->nullable();
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
        Schema::dropIfExists('ap_courses');
    }
}
