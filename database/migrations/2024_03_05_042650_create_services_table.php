<?php

use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Service\BillingHead;
use App\Models\Service\Location;
use App\Models\Service\ServiceGroup;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Teriff::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(ServiceGroup::class)->constrained();
            $table->foreignIdFor(BillingHead::class)->constrained();
            $table->foreignIdFor(CostCenter::class)->constrained();
            $table->foreignIdFor(Location::class)->constrained();
            $table->string('code', 30);
            $table->string('name', 150);
            $table->decimal('charge', 10, 2)->nullable();
            $table->decimal('emergency_charge', 10, 2)->nullable();
            $table->enum('type', ['S', 'I', 'M', 'P']); //S: Servie, I: Investigation, M: Mislenious, P: Procedure
            $table->boolean('isactive')->default(false);
            $table->integer('hospital_percent')->nullable()->default(0);
            $table->integer('doctor_percent')->nullable()->default(0);
            $table->decimal('hospital_amount', 10, 2)->nullable()->default(0.0);
            $table->decimal('doctor_amount', 10, 2)->nullable()->default(0.0);
            $table->boolean('ispackage')->default(false);
            $table->boolean('isprocedure')->default(false);
            $table->boolean('isoutside')->default(false);
            $table->boolean('issampleneeded')->default(false);
            $table->boolean('isdiet')->default(false);
            $table->longText('remarks')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('modified_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
