<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('converts', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('email');
            $table->string('plan');
            // $table->string('plan1');
            // $table->string('plan2');
            // $table->string('plan3');
            $table->string('appname');
            $table->string('icon');
            $table->string('fullscreen');
            $table->string('primarycolor');
            $table->string('packagename');
            $table->string('admob');
            $table->string('admobID');
            $table->string('status')->default('0');
            $table->string('reference_code');
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
        Schema::dropIfExists('converts');
    }
}
