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
            $table->string('title', 100);
            $table->text('short_des');
            $table->string('price');
            $table->boolean('discount')->default(0);
            $table->string('discount_price', 10);
            $table->string('image', 100);
            $table->boolean('stock')->default(1);
            $table->double('star');
            $table->enum('remark', ['hot', 'normal', 'best-selling']);

            // F - K
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            // Relationship
            $table->foreign('category_id')->references('id')->on('categories')
            ->restrictOnDelete()
            ->restrictOnUpdate();

            $table->foreign('brand_id')->references('id')->on('brands')
            ->restrictOnDelete()
            ->restrictOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
