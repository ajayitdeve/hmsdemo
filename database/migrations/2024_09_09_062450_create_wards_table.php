<?php


use App\Models\Ipd\WardGroup;
use App\Models\Ipd\WardTariff;
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
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WardGroup::class)->constrained();
            $table->foreignIdFor(WardTariff::class)->nullable(false)->default(null);
            $table->string('code', 20)->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('display_name')->nullable()->default(null);
            $table->tinyInteger('priority')->nullable()->default(null);
            $table->boolean('is_casuality')->default(false);
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
        Schema::dropIfExists('wards');
    }
};
