<?php

use App\Models\Ipd\Organization;
use App\Models\Ipd\OrganizationTariff;
use App\Models\Service\Teriff;
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
        Schema::create('organization_tariff_priorities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OrganizationTariff::class);
            $table->foreignIdFor(Organization::class);
            $table->foreignIdFor(Teriff::class)->nullable();
            $table->enum('type', ['op', 'ip'])->default('op');
            $table->boolean('is_default')->default(false);
            $table->tinyInteger('priority');
            $table->decimal('discount', 4, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_tariff_priorities');
    }
};
