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
            $table->string('deposito')->default("NO");
            $table->string('glosa')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('moneda')->nullable();
            $table->decimal('monto',20,2)->default(0);
            $table->string('literaltrasferido')->nullable();
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('numerodocumento')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado')->nullable();
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
