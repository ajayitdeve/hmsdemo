<?php

use App\Models\Pathology\Parameter;
use App\Models\Pathology\ParameterUnit;
use App\Models\Pathology\Symbol;
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
        Schema::create('parameter_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Parameter::class);
            $table->foreignIdFor(ParameterUnit::class)->default(null);
            $table->foreignIdFor(Symbol::class)->default(null);


            $table->string('gender',10)->nullable()->default(null);
            $table->string('min_age',2)->nullable()->default(null);
            $table->string('min_age_uom',100)->nullable()->default(null);
            $table->string('max_age',2)->nullable()->default(null);
            $table->string('max_age_uom',100)->nullable()->default(null);

            $table->string('min_range',5)->nullable()->default(null);
            $table->string('max_range',5)->nullable()->default(null);
            $table->string('normal_range',50)->nullable()->default(null);
            $table->string('min_critical',50)->nullable()->default(null);
            $table->string('max_critical',50)->nullable()->default(null);
            // $table->string('unit',50)->nullable();
            $table->string('description')->nullable()->default(null);



            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_values');
    }
};
