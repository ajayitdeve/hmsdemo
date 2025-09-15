<?php

use App\Models\Service\Service;
use App\Models\Pathology\Parameter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Pathology\DiagnosticResult;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnostic_result_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DiagnosticResult::class);
            $table->foreignIdFor(Parameter::class);
            $table->foreignIdFor(Service::class);
            $table->string('result_value', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_result_values');
    }
};
