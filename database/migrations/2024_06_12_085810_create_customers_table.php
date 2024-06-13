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
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('customer_id')->nullable()->unique();
            $table->string('identity')->unique();
            $table->string('phone');
            $table->string('address');
            $table->date('last_payment')->nullable();
            $table->string('location_name')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('acc')->default(false);
            $table->date('due_date')->nullable();
            $table->string('house_image_path');
            $table->string('ktp_image_path');
            $table->boolean('paid')->default(false);
            $table->unsignedBigInteger('internet_package_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('internet_package_id')->references('id')->on('internet_packages')->onDelete('cascade');
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
