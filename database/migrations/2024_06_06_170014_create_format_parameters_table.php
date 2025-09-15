<?php

use App\Models\Pathology\Format;
use App\Models\Pathology\Parameter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('format_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Format::class);
            $table->foreignIdFor(Parameter::class);
            $table->string('sub_title');
            $table->tinyInteger('sequence')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format_parameters');
    }
};
