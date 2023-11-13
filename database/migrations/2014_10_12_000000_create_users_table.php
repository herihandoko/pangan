<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('role_id')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('status')->nullable();
            $table->string('job_title', 255);
            $table->string('avatar', 255);
            $table->integer('deleted_by')->nullable();
            $table->string('mobile_no', 18)->nullable();
            $table->string('home_no', 18)->nullable();
            $table->string('office_no', 18)->nullable();
            $table->string('about_me', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('gender', 18)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('nik', 32)->nullable();
        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@rctiplus.com',
                'password' => Hash::make('admin1234'),
                'role_id' => 1,
                'status' => 1,
                'job_title' => 'Software Engineer',
                'avatar' => 'avatar.png'
            ]
        ]);
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
