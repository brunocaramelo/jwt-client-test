<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->text('description');
            $table->integer('immobile_type_id')->unsigned();
            $table->foreign('immobile_type_id')->references('id')->on('immobile_types');
            $table->integer('real_estate_office_id')->unsigned();
            $table->foreign('real_estate_office_id')->references('id')->on('real_estate_offices');
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
        Schema::dropIfExists('immobiles');
    }
}
