<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator', function (Blueprint $table) {
            $table->id();
            $table->string('document_no');
            $table->string('sampler');
            $table->string('testing_parameter');
            $table->date('recieved_date');
            $table->integer('sample_count');
            $table->date('test_start_date');
            $table->date('test_end_date');
            $table->string('sample_no');
            $table->integer('parameter_and_values');
            $table->string('specification');
            $table->string('note');
            $table->string('ttd_operator')->nullable();
            $table->string('ttd_staff')->nullable();
            $table->string('ttd_supervisor')->nullable();
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
        Schema::dropIfExists('operator');
    }
}
