<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_skill', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')
                ->references('id')
                ->on('skills')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_skill');
    }
}
