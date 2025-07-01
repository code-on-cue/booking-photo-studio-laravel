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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('typeId')->references('id')->on('types');
            $table->foreignId('userId')->references('id')->on('users');
            $table->string('trxId');
            $table->string('name');
            $table->string('phone');
            $table->integer('numberOfPerson');
            $table->date('date');
            $table->time('time')->nullable();
            $table->integer('basedPerson');
            $table->integer('basedPrice');
            $table->integer('additionalPrice');
            $table->integer('totalPrice');
            $table->integer('downPayment');
            $table->text('linkDrive')->nullable();
            $table->string('snapToken')->nullable();
            $table->enum('status', ['pending', 'process', 'success', 'failed']);

            $table->json('moreDetails')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
