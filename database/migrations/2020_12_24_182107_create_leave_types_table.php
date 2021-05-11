<?php

use App\Models\LeaveType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_name');
            $table->string('color')->nullable();
            $table->timestamps();
        });

        $category = new LeaveType();
        $category->type_name = 'Casual';
        $category->color = 'success';
        $category->save();

        $category = new LeaveType();
        $category->type_name = 'Sick';
        $category->color = 'danger';
        $category->save();

        $category = new LeaveType();
        $category->type_name = 'Earned';
        $category->color = 'info';
        $category->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}
