<?php

use App\Models\Pathology\Organism;
use App\Models\Pathology\Antibiotic;
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
        Schema::create('antibiotic_organisms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organism::class);
            $table->foreignIdFor(Antibiotic::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antibiotic_organisms');
    }
};
