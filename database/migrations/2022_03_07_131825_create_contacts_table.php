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
        Schema::create("contacts", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "name");
            $table->string(column: "email");
            $table->string(column: "phone_number");
            $table->string(column: "review");
            $table->integer(column: "service_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("service_id")
                ->references("id")
                ->on("services")
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
        Schema::dropIfExists("contacts");
    }
};
