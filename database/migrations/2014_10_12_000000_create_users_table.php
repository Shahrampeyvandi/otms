<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('client_id');
            $table->string('client_en_name')->nullable();
            $table->string('client_fa_name')->nullable();
            $table->string('tel')->nullable();
            $table->string('mob')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('economic_code')->nullable();
            $table->string('national_idcode')->nullable();
            $table->text('addressen')->nullable();
            $table->text('addressfa')->nullable();

            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
       

       DB::table('users')->insert(
            array(
                'client_id'=>1234,
                'client_en_name'=>'admin',
                'client_fa_name'=>'ادمین',
                'tel'=>'09381699949',
                'mob'=>'09381699949',
                'fax'=>'09381699949',
                'password'=>Hash::make('123456'),
                'email'=>'test@gmail.com',
                'remember_token'=>null

                )
        );
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
