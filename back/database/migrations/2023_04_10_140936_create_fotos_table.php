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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->string('items')->nullable();
            $table->string('numero')->nullable();
            $table->string('razon')->nullable();
            $table->string('nit')->nullable();
            $table->string('empresa')->nullable();
            $table->string('observacion')->nullable();
            $table->string('foto_url')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->decimal('total',20,2)->default(0);
            $table->decimal('subtotal',20,2)->default(0);
            $table->string('literal')->nullable();
             // pedido
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
        Schema::dropIfExists('fotos');
    }
};
