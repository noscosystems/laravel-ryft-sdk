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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->bigInteger('user_id')->unsigned();
            $table->string('type', 30);
            $table->string('name')->nullable();
            $table->string('scheme', 32);
            $table->string('last_four', 4);
            $table->unsignedSmallInteger('expiry_month');
            $table->unsignedInteger('expiry_year');
            $table->timestamp('defaulted_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
