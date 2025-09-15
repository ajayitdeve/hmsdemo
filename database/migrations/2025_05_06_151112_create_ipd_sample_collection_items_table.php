<?php

use App\Models\IpServiceBillingItem;
use App\Models\Pathology\IpdSampleCollection;
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
        Schema::create('ipd_sample_collection_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpdSampleCollection::class);
            $table->foreignIdFor(IpServiceBillingItem::class);
            $table->boolean('sample_done')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipd_sample_collection_items');
    }
};
