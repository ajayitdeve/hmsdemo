<?php

use App\Models\Ipd\Ipd;
use App\Models\Ipd\NurseStation;
use App\Models\Patient;
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
        Schema::create('diet_indent_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->string('code')->unique();
            $table->date('diet_indent_date');
            $table->time('diet_indent_time');
            $table->string('height')->nullable();
            $table->string("weight")->nullable();
            $table->string('bmi')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->string('diet_type')->nullable();
            $table->string('diet_category')->nullable();
            $table->string('meal')->nullable();
            $table->longText('note')->nullable();
            $table->foreignIdFor(NurseStation::class);
            $table->unsignedBigInteger("created_by_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_indent_entries');
    }
};
