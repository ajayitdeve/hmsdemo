<?php

use App\Models\OtPostOperation;
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
        Schema::create('ot_post_operation_sample_collection_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPostOperation::class);
            $table->longText('oper_notes')->nullable();
            $table->longText('sample_collection')->nullable();
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
        Schema::dropIfExists('ot_post_operation_sample_collection_notes');
    }
};
