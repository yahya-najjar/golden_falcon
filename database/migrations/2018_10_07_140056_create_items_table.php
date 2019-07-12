<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');

            $table->nestedSet();

            $table->string('code_number')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('home')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->date('date')->nullable();
            $table->text('colors')->nullable();
            $table->text('sizes')->nullable();
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
        Schema::dropIfExists('items');
    }
}
