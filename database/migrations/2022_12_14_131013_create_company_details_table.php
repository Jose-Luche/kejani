<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('brCode')->nullable();
            $table->string('country')->nullable();
            $table->string('cCode')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('city')->nullable();
            $table->string('tel')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phLocation')->nullable();
            $table->string('image')->nullable();
            $table->string('payOptions')->nullable();
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
        Schema::dropIfExists('company_details');
    }
}
