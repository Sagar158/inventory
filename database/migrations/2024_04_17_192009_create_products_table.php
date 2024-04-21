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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['available','not_available'])->default('available');
            $table->string('product_name')->nullable();
            $table->string('product_number')->nullable();
            $table->integer('supplier_id');
            $table->string('category_id')->nullable();
            $table->double('price',11,4)->default(0.0000)->nullable();
            $table->integer('quantity')->default(0);
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
