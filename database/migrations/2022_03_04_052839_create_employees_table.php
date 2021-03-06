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

        Schema::create("employees", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "full_name");
            $table->string(column: "email");
            $table->string(column: "password");
            $table->string(column: "pictures");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("employees");
    }
};
