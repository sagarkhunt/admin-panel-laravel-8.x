<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();            
            $table->enum('role_id',['1','2'])->comment('1= admin 2= user');
            $table->string('profile_picture')->nullable(); 
            $table->enum('status',['active','deactive','block'])->default('active');
            $table->string('device_id')->nullable();
            $table->enum('device_type',['android','ios'])->nullable();            
            $table->string('device_token')->nullable();   
            $table->rememberToken();
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
}
