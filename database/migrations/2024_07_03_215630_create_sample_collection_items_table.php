<?php

use App\Models\OpdBillingItems;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Pathology\SampleCollection;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sample_collection_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SampleCollection::class);
            $table->foreignIdFor(OpdBillingItems::class);
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
        Schema::dropIfExists('sample_collection_items');
    }
};
