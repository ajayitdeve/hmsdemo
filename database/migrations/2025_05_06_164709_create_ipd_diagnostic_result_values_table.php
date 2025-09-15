<?php

use App\Models\Pathology\IpdDiagnosticResult;
use App\Models\Service\Service;
use App\Models\Pathology\Parameter;
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
        Schema::create('ipd_diagnostic_result_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpdDiagnosticResult::class);
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
        Schema::dropIfExists('ipd_diagnostic_result_values');
    }
};
