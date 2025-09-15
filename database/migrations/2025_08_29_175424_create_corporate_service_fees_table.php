<?php

use App\Models\Service\Service;
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
        Schema::create('corporate_service_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class)->constrained()->onDelete('cascade');
            $table->string('code', 30)->nullable();
            $table->string('name', 150)->nullable();
            $table->decimal('charge', 10, 2)->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporate_service_fees');
    }
};
