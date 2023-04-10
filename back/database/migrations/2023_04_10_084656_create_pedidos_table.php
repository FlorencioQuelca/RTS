<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->nullable();
            $table->integer('codigoliral')->nullable();
            $table->string('lugar')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('proyecto')->nullable();
            $table->string('solicitante')->nullable();
            $table->text('justificacion')->nullable();
            $table->decimal('precio',20,2)->default(0);
            $table->decimal('total',20,2)->default(0);
            $table->string('literal')->nullable();
            $table->string('autorizado')->nullable();
            $table->string('vistoBueno')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado')->nullable();
            $table->string('etapa')->nullable();
            $table->string('activo')->default('ACTIVO');
            
            //saldo
            $table->decimal('saldo',20,2)->default(0);
            $table->decimal('diferencia',20,2)->default(0);
         
            
             // usuarios 
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
