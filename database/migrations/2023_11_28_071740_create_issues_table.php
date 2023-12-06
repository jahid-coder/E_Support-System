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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('issue_title');
            $table->string('issue_description')->nullable();
            $table->binary('issue_attachment')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('issue_catagory_id');
            $table->unsignedBigInteger('issue_priority_id');
            $table->unsignedBigInteger('issue_status_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('issue_catagory_id')->references('id')->on('issuecategory')->onDelete('cascade');
            $table->foreign('issue_priority_id')->references('id')->on('issuepriority')->onDelete('cascade');
            $table->foreign('issue_status_id')->references('id')->on('issuestatus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
