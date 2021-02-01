<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_order', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('extention_days')->default(0);
            $table->decimal('cost_per_day');
            $table->decimal('subtotal');
            $table->decimal('itbms');
            $table->decimal('total');
            $table->text('payment');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('rental_order');
    }
}
