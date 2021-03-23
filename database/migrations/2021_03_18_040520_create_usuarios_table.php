<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('correo')->nullable();
            $table->string('contrasenia')->nullable();
            $table->boolean('activo')->default(1);
            $table->string('usercreated')->nullable();
            $table->string('usermodified')->nullable();
            $table->timestamps();
        });
        $data = [
            ['nombre'=>'Daniel Flores','correo'=>'diosis123@gmail.com','contrasenia'=>'123456','usercreated'=>'sys@admin.com','usermodified'=>'sys@admin.com'],
            ['nombre'=>'Daniel','correo'=>'daniel@gmail.com','contraseña'=>'654321','usercreated'=>'sys@admin.com','usermodified'=>'sys@admin.com'],
            ['nombre'=>'carlos','correo'=>'carlos@gmail.com','contraseña'=>'123456789','usercreated'=>'sys@admin.com','usermodified'=>'sys@admin.com']
        ];
        DB::table('usuarios')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
