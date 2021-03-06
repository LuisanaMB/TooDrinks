<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandaDistribuidorTable extends Migration
{
    public function up()
    {
        Schema::create('demanda_distribuidor', function (Blueprint $table){
        	$table->increments('id');
          	$table->string('tipo_creador');
        	$table->integer('creador_id');
        	$table->integer('marca_id');
        	$table->integer('provincia_region_id');
         	$table->boolean('status');
         	$table->date('fecha');
         	$table->integer('cantidad_visitas');
         	$table->integer('cantidad_contactos');
         	$table->timestamps();

            $table->foreign('marca_id')
                  ->references('id')->on('marca')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('provincia_region_id')
                  ->references('id')->on('provincia_region')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('demanda_distribuidor');
    }
}
