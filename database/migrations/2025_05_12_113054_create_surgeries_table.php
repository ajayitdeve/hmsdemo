<?php

use App\Models\Department;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use App\Models\Service\Teriff;
use App\Models\SurgeryType;
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
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Teriff::class)->constrained();
            $table->foreignIdFor(Service::class)->constrained();
            $table->foreignIdFor(ServiceGroup::class)->constrained();
            $table->foreignIdFor(SurgeryType::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->string('code', 150);
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('duration', 50)->nullable();
            $table->date('effect_from')->nullable();
            $table->date('effect_to')->nullable();
            $table->longText('description')->nullable();
            $table->string('s1')->nullable();
            $table->string('s2')->nullable();

            $table->string('payment_on', 150)->nullable();
            $table->decimal('general_ward_amount', 10, 2)->nullable();
            $table->decimal('semi_private_amount', 10, 2)->nullable();
            $table->decimal('private_amount', 10, 2)->nullable();
            $table->decimal('delux_amount', 10, 2)->nullable();
            $table->decimal('triplesharing_amount', 10, 2)->nullable();
            $table->decimal('iccu_amount', 10, 2)->nullable();

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgeries');
    }
};
