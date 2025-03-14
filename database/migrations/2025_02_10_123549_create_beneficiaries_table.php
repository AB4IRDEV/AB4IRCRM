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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->dateTime('dob');
            $table->integer('age');
            $table->string('id_number', 13)->unique(); // Ensure 13-digit ID numbers are stored
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('gender', [
                'male', 'female'
            ]);
            $table->foreignId('location_id')->nullable()->constrained();
            $table->string('highest_qualification')->nullable();
            $table->foreignId('next_of_kin_id')->nullable()->constrained('next_of_kin')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
