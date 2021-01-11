<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('for_date');
            $table->date('to_date');
            $table->unsignedBigInteger('basic_id');
            $table->foreign('basic_id')->references('id')->on('basic_pays')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('allowances')->nullable();
            $table->integer('deductions')->nullable();
            $table->integer('overtimes')->nullable();
            $table->integer('others')->nullable();
            $table->enum('payment', ['cash', 'transfer']);
            $table->enum('status', ['paid off','in progress','cancel'])->default('in progress');
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
        Schema::dropIfExists('payslips');
    }
}
