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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('num')->default(1);
            $table->string('unidad')->nullable();
            $table->string('categoria')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado')->nullable();
             // solicitado/cotizado
         
             $table->string('cantidadrecibo')->nullable();
             $table->string('detallerecibo')->nullable();
             $table->decimal('preciorecibo',20,2)->default(0);
             $table->decimal('subtotalrecibo',20,2)->default(0);
             
             //facturado
             
             $table->string('cantidadfactura')->nullable();
             $table->string('detallefactura')->nullable();
             $table->decimal('preciofactura',20,2)->default(0);
             $table->decimal('subtotalfactura',20,2)->default(0);

           
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
        Schema::dropIfExists('detalles');
    }
};
