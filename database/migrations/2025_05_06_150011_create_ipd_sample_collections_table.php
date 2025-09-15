<?php

use App\Models\IpServiceBilling;
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
        Schema::create('ipd_sample_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpServiceBilling::class)->constrained();
            $table->string('code', 20)->nullable();
            $table->string('lab_no', 12)->nullable();
            $table->string('sample_entry_date', 30)->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipd_sample_collections');
    }
};
