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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->references("id")->on("products")->cascadeOnDelete();
            $table->float("price")->default(0);
            $table->integer("quantity")->default(1);
            $table->integer("discount")->nullable();
            $table->enum("discount_type", ["amount", "percent"])->nullable();
            $table->float("sub_total")->default(0);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
