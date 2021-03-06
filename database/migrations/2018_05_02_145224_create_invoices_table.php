<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('created_by_user_id');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('restrict');

            $table->unsignedInteger('created_for_user_id');
            $table->foreign('created_for_user_id')->references('id')->on('users')->onDelete('restrict');

            // Storing whole date but consider month and year only
            $table->date('for_month');
            $table->decimal('amount', 10, 2);
            $table->enum('status', config('project.invoice_status'))->default('unpaid');

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
        Schema::dropIfExists('invoices');
    }
}
