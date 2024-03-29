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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string("academic_grade");
            $table->string("school_name")->nullable();
            $table->string("state");
            $table->date("birthdate");
            $table->boolean("active")->default(1);
            $table->boolean("is_admin")->default(0);
            $table->text("description")->nullable();

            $table->rememberToken();
            // $table->foreignId('current_team_id')->nullable();
            $table->foreignId('level_id')->default(1)->constrained();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
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
};
