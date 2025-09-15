<?php

use App\Models\Department;
use App\Models\Pathology\Color;
use App\Models\Service\Service;
use App\Models\Pathology\Format;
use App\Models\Pathology\TestType;
use App\Models\Pathology\Vacutainer;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Schema;
use App\Models\Pathology\SpecimenMaster;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('specimen_setups', function (Blueprint $table) {
            $table->id();
            $table->string('code',15);//ex SAM 356
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(ServiceGroup::class);
            //Test Code id the Service Code where main group is as above ; Example if Main Group is BIO then Test Code will all services under BIO
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(SpecimenMaster::class);
            $table->foreignIdFor(Vacutainer::class);
            $table->foreignIdFor(TestType::class);
            $table->foreignIdFor(Color::class)->nullable();
            $table->string('duration',10)->nullable();
            $table->tinyInteger('dosage_qty')->nullable();
            $table->tinyInteger('no_of_barcode')->nullable();
            $table->string('short_name',255)->nullable();
            $table->string('precaution')->nullable();
            $table->string('clinical_history')->nullable();
            $table->boolean('is_applicable_for_others_test')->default(false);
            $table->boolean('is_required_precaution_on_bill')->default(false);
            $table->boolean('is_infection_dieases')->default(false);
            $table->boolean('is_curable')->default(true);
            $table->string('s1_cd')->nullable()->default(null);
            $table->string('s2_cd')->nullable()->default(null);
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('specime_setups');
    }
};
