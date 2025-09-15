<?php

use App\Models\Abnormal;
use App\Models\AbnormalEntry;
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
        Schema::create('abnormal_entry_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AbnormalEntry::class);
            $table->foreignIdFor(Abnormal::class);
            $table->timestamp("date_time");
            $table->string("temperature")->nullable();
            $table->string("remarks")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abnormal_entry_items');
    }
};
