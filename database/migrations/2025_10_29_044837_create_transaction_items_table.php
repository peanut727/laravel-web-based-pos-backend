<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')
                ->constrained('transactions')
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained('products');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->decimal('cost', 10, 2)->nullable();
            $table->integer('qty');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

    }


    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
