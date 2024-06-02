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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->date('birthdate');
            $table->time('time'); // تحديد اسم العمود
            $table->foreignId('prodect_id')->references('id')->on('prodects')->cascadeOnDelete();
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
        Schema::dropIfExists('orders');
    }
};
