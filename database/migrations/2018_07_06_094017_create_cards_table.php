<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('customer_id');
            $table->string('number', 26);
            $table->timestamps();

            $table->foreign('account_id', 'fk_accounts')
                ->references('id')->on('accounts')
                ->onDelete('cascade');

            $table->foreign('customer_id', 'fk_customers')
                ->references('id')->on('customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
