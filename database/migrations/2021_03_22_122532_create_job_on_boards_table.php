<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOnBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'job_on_boards', function (Blueprint $table){
            $table->id();
            $table->integer('application');
            $table->date('joining_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('convert_to_employee')->default(0);
            $table->integer('created_by');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_on_boards');
    }
}
