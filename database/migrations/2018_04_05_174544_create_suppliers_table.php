<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('primary_phone')->nullable()->default(null);
            $table->string('alternate_phone')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);

            $table->unsignedInteger('created_by_user_id');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('restrict');

            // is available for new orders
            $table->boolean('active')->default(false)->unsigned();

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
        Schema::dropIfExists('suppliers');
    }
}
