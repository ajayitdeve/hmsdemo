<?php

use App\Models\Ipd\WardTariff;
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
        Schema::create('ward_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WardTariff::class)->nullable(false)->default(null);
            $table->string('code')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->boolean('status')->default(true);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ward_groups');
    }
};
