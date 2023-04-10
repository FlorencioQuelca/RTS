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
        Schema::create('depositos', function (Blueprint $table) {
            $table->id();

            //deposito para el pedido
            $table->string('reembolso')->nullable();
            $table->string('glosa')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('moneda')->nullable();
            $table->decimal('montotrasferido',20,2)->default(0);
            $table->string('literaltrasferido')->nullable();
            $table->string('cuentadestino')->nullable();
            $table->string('nombredestino')->nullable();
            $table->string('cuentaorigen')->nullable();
            $table->string('nombreorigen')->nullable();
            $table->date('fechaaprobado')->nullable();
            $table->time('horaaprobado')->nullable();
            $table->string('numerodocumento')->nullable();
            $table->string('foto_url')->nullable();
             // usuarios 
             $table->unsignedBigInteger("pedido_id")->nullable();
             $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('set null')->onUpdate('cascade');
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depositos');
    }
};
