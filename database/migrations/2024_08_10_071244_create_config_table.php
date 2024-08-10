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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('appName');

            $table->integer('price');
            $table->integer('additionalPrice');
            $table->integer('maximumPerson');
            $table->string('openStore');
            $table->string('closeStore');
            $table->string('breakTime');
            $table->integer('duration');

            $table->string('accountSource');
            $table->string('accountNumber');
            $table->string('accountHolder');

            $table->string('whatsapp');
            $table->string('instagram');
            $table->text('address');
            $table->text('map');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config');
    }
};
