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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            // Pas de cascade : un ordinateur déjà commandé ne peut pas être supprimé.
            $table->foreignId('computer_id')->constrained();
            $table->unsignedInteger('quantity');
            // Prix de l'ordinateur au moment de la commande.
            $table->decimal('unit_price', 8, 2);

            $table->unique(['order_id', 'computer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
