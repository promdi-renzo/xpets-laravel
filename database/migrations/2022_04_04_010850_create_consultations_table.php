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
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments("id");
            $table->string(column:"date");
            $table->string(column:"disease_injury");
            $table->integer(column:"price");
            $table->string(column:"comment");
            $table->integer(column:"personnel_id")->unsigned();
            $table->integer(column:"animal_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("personnel_id")
                ->references("id")
                ->on("personnels")
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
        Schema::dropIfExists('consultations');
    }
};
