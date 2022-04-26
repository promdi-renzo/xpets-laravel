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
        Schema::create('carts', function (Blueprint $table) {
            $table->increments("id");
            $table->string(column:"comment");
            $table->integer(column:"customer_id")->unsigned();
            $table->integer(column:"service_id")->unsigned();
            $table->integer(column:"animal_id")->unsigned();
            $table->integer(column:"quantity")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("customer_id")
                ->references("id")
                ->on("customers")
                ->onDelete("cascade");
            $table
                ->foreign("service_id")
                ->references("id")
                ->on("services")
                ->onDelete("cascade");
            $table
                ->foreign("animal_id")
                ->references("id")
                ->on("pets")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
