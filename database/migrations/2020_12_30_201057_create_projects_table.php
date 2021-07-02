<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name');
            $table->mediumText('project_summary')->nullable();
            $table->date('start_date');
            $table->date('deadline');
            $table->longText('notes')->nullable();
            $table->enum('status', ['not started', 'in progress', 'on hold', 'canceled', 'finished']);
            $table->integer('submitted_by')->unsigned();
            $table->foreign('submitted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('project_category')->onDelete('set null')->onUpdate('cascade');
            $table->integer('progress_percent')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
