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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('given_id')->unique()->nullable();
            $table->string('name');
            $table->string('identity')->unique();
            $table->string('identity_image_path')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('location_image_path')->nullable();
            $table->date('last_payment')->nullable();
            $table->string('due_date')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('paid')->default(false);
            $table->boolean('in_arrears')->default(false);
            $table->boolean('acc')->default(false);
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
