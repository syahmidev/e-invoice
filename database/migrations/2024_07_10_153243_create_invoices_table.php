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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no');
            $table->date('invoice_date');
            $table->string('order_number')->nullable();
            $table->string('currency');
            $table->longText('notes')->nullable();
            $table->date('due_date');
            $table->string('status');
            $table->integer('sellers_id');
            $table->integer('buyers_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
