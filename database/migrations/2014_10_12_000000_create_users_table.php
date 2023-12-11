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
        // Schema::create('roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('rolename')->unique();
        //     $table->timestamps();
        // });
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('userid');
        //     $table->unsignedBigInteger('role_id')->nullable();
        //     $table->string('name')->nullable();
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->string('userdesignation')->nullable();
        //     $table->rememberToken();
        //     $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        //     $table->timestamps();
           
        // });
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
};
