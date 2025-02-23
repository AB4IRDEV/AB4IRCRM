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
        Schema::table('stakeholders', function (Blueprint $table) {
            //
                $table->string('logo')->nullable()->after('address'); // Adding a new column for the logo
            });
        }
    
        public function down()
        {
            Schema::table('stakeholders', function (Blueprint $table) {
                $table->dropColumn('logo'); // Rollback in case of migration reversal
            });
        }
};
