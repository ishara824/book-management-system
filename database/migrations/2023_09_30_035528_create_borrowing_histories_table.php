<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowing_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reader_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('reservation_id');
            $table->date('borrow_date');
            $table->date('return _date');
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
        Schema::dropIfExists('borrowing_histories');
    }
};
