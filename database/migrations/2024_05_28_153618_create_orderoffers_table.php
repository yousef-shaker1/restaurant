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
        Schema::create('orderoffers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->date('birthdate');
            $table->time('time'); // تحديد اسم العمود
            $table->foreignId('offer_id')->references('id')->on('offers')->cascadeOnDelete();
            $table->integer('count')->default(1);
            $table->string('status')->default('يتم مراجعة الطلب');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderoffers');
    }
};
