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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->enum('province', [
                'Eastern Cape', 
                'Free State', 
                'Gauteng', 
                'KwaZulu-Natal', 
                'Limpopo', 
                'Mpumalanga', 
                'North West', 
                'Northern Cape', 
                'Western Cape'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
