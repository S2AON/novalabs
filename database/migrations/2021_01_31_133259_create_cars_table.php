<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 100);
            $table->string('model', 100)->nullable();
            $table->string('chasis', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('transmission', 100)->nullable();
            $table->integer('passenger_capacity')->nullable();
            $table->string('trunk_capacity', 100)->nullable();
            $table->text('features')->nullable();
            $table->text('description');
            $table->decimal('price');
            $table->boolean('status');
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
        Schema::dropIfExists('car');
    }
}
