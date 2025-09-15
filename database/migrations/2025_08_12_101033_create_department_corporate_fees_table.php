<?php

use App\Models\Department;
use App\Models\Ipd\Organization;
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
        Schema::create('department_corporate_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Organization::class)->constrained();
            $table->decimal('fee', 10, 2);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_corporate_fees');
    }
};
