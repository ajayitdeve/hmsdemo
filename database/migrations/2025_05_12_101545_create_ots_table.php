<?php

use App\Models\CostCenter;
use App\Models\OtType;
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
        Schema::create('ots', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->unique();
            $table->string('code', 100)->unique();
            $table->foreignIdFor(OtType::class);
            $table->enum('is_active', [0, 1]);
            $table->foreignIdFor(CostCenter::class);
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ots');
    }
};
