<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('firstName', 30);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('role')->default('S');
            $table->rememberToken()->default(Str::random(10));
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger('right_id')->default(2);
            $table->foreign('right_id')
                ->references('id')
                ->on('rights')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
