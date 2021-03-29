<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->decimal('wage', $precision = 4, $scale = 2); 
            $table->string('comment', 1000);
            $table->date('start');
            $table->date('end');
            $table->tinyInteger('seat');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('locality_id');
            $table->foreign('locality_id')
                ->references('id')
                ->on('localities')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
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
        Schema::dropIfExists('offers');
    }
}