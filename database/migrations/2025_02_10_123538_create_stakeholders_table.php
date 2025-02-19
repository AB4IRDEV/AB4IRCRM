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
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Funder', 'Implementing Partner','Associate' ]);
            $table->string('contact_person');
            $table->string('email')->unique();
            $table->string('phone');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stakeholders');
    }
};
