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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');                            // Program title
            $table->text('description')->nullable();            // Detailed description
            $table->boolean('accredited')->default(false);
            $table->unsignedTinyInteger('nqf_level')->nullable();           // Detailed description
            $table->date('start_date')->nullable();                         // Program start date
            $table->date('end_date')->nullable();               // Program end date (if applicable)
            $table->year('year')->nullable();                   // For filtering programs by year
            $table->decimal('budget', 15, 2)->nullable();         // Budget allocated for the program            // Location or region of the program
            $table->enum('status', [ 'active', 'completed', 'cancelled'])
                  ->default('active');                         // Current status of the program
            $table->foreignId('program_manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedInteger('intended_beneficiaries')->default(0);   // Expected beneficiaries before commencement
            $table->unsignedInteger('completed_beneficiaries')->default(0);    // Actual number of beneficiaries who complete the program
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
        Schema::dropIfExists('projects');
    }
};
