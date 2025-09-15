<?php

use App\Models\Ipd\Bed;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_beds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Ward::class);
            $table->foreignIdFor(Room::class);
            $table->foreignIdFor(Bed::class);

            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->boolean('is_ipd_allocation')->default(false);
            $table->boolean('is_transfer')->default(false);
            $table->string('transfer_narration')->nullable();
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
        Schema::dropIfExists('patient_beds');
    }
};
