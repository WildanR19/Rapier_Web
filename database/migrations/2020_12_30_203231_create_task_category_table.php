<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->timestamps();
        });
        Schema::table('tasks', function(Blueprint $table){
            $table->integer('task_category_id')->unsigned()->nullable()->default(null)->after('project_id');
            $table->foreign('task_category_id')->references('id')->on('task_category')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_category');
        Schema::table('tasks', function(Blueprint $table){
            $table->dropForeign(['task_category_id']);
        });
    }
}
