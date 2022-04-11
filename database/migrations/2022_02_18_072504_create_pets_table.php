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
        Schema::create("pets", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column:"animal_name");
            $table->integer(column:"age");
            $table->string(column:"gender");
            $table->string(column:"type");
            $table->string(column:"images");
            $table->integer(column:"customer_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("customer_id")
                ->references("id")
                ->on("customers")
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
        Schema::dropIfExists("pets");
    }
};
