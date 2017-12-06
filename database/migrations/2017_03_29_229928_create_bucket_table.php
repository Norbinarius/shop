<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')
                  ->unsigned();
            $table->foreign('device_id')
                  ->references('id')
                  ->on('devices')
                  ->onDelete('CASCADE')
                  ->onUpdate('RESTRICT');
            $table->boolean('ordered')->default(false);
            $table->integer('user_id')
                ->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('CASCADE')
                  ->onUpdate('RESTRICT');

            $table->integer('order_id')
                ->nullable()->unsigned();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
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
        Schema::dropIfExists('bucket');
    }
}
