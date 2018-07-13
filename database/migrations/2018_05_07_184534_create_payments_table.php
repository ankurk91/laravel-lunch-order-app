<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('created_by_user_id');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            $table->decimal('amount', 10, 2);

            $table->string('customer_notes')->nullable()->default(NULL);
            $table->string('staff_notes')->nullable()->default(NULL);

            $table->enum('method', config('project.payment_methods'))->default('online');
            $table->enum('status', config('project.payment_status'))->default('pending');

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
        Schema::dropIfExists('payments');
    }
}
