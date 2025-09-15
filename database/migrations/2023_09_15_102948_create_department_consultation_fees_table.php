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
        Schema::create('department_consultation_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Department::class)->constrained();
            $table->decimal('fee', 6, 2);
            $table->string('doc')->nullable();//doc date of change
            $table->boolean('is_active')->default(true);// only one charge will be active for a department, when fee changed existing entry 'is_active' will be false
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('remarks')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_consultation_fees');
    }
};
