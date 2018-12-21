<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('created_by_user_id');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('restrict');

            $table->unsignedInteger('created_for_user_id');
            $table->foreign('created_for_user_id')->references('id')->on('users')->onDelete('restrict');

            $table->date('for_date');
            $table->enum('status', config('project.order_status'))->default('pending');

            $table->string('customer_notes')->nullable()->default(null);
            $table->string('staff_notes')->nullable()->default(null);

            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
