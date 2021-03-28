<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rights', function (Blueprint $table) {
            $table->id();
            $table->boolean('SFx1');
            $table->boolean('SFx2');
            $table->boolean('SFx3');
            $table->boolean('SFx4');
            $table->boolean('SFx5');
            $table->boolean('SFx6');
            $table->boolean('SFx7');
            $table->boolean('SFx8');
            $table->boolean('SFx9');
            $table->boolean('SFx10');
            $table->boolean('SFx11');
            $table->boolean('SFx12');
            $table->boolean('SFx13');
            $table->boolean('SFx14');
            $table->boolean('SFx15');
            $table->boolean('SFx16');
            $table->boolean('SFx17');
            $table->boolean('SFx18');
            $table->boolean('SFx19');
            $table->boolean('SFx20');
            $table->boolean('SFx21');
            $table->boolean('SFx22');
            $table->boolean('SFx23');
            $table->boolean('SFx24');
            $table->boolean('SFx25');
            $table->boolean('SFx26');
            $table->boolean('SFx27');
            $table->boolean('SFx28');
            $table->boolean('SFx29');
            $table->boolean('SFx30');
            $table->boolean('SFx31');
            $table->boolean('SFx32');
            $table->boolean('SFx33');
            $table->boolean('SFx34');
            $table->boolean('SFx35');
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
        Schema::dropIfExists('rights');
    }
}
