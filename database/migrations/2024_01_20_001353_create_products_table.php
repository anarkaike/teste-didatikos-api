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
        Schema::create(table: 'products', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 150);
            $table->float(column: 'price');
            $table->foreignId(column: 'brand_id')->constrained(table: 'brands', indexName: 'products_brand_id');
            $table->float(column: 'stock')->nullable()->default(value: 0);
            $table->foreignId(column: 'city_id')->nullable()->default(value: null)->constrained(table: 'cities', indexName: 'products_city_id');
            $table->foreignId(column: 'created_by')->constrained(table: 'users', indexName: 'products_created_by');
            $table->foreignId(column: 'updated_by')->nullable()->constrained(table: 'users', indexName: 'products_updated_by');
            $table->timestamp(column: 'created_at')->useCurrent();
            $table->timestamp(column: 'updated_at')->useCurrentOnUpdate()->nullable()->default(value: null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'products');
    }
};
