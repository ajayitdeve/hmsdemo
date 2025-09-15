<?php

use App\Models\Village;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no', 20)->nullable();
            $table->string('password');
            $table->date('registration_date')->nullable();
            $table->string('name', 30)->nullable()->comment('full name of the patient');
            //$table->string('name',30)->nullable()->fulltext()->comment('full name of the patient');
            $table->string('email', 30)->nullable()->default(null);
            $table->string('mobile', 12)->nullable()->default(null);
            $table->date('dob')->nullable()->comment('numbers only');
            $table->string('age', 100)->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('country_id')->nullable()->default(null);
            $table->bigInteger('state_id')->nullable()->default(null);
            $table->bigInteger('district_id')->nullable()->default(null);
            $table->bigInteger('block_id')->nullable()->default(null);
            $table->bigInteger('village_id')->nullable()->default(null);
            $table->string('pincode', 10)->nullable()->default(null);

            $table->string('father_name', 30)->nullable()->default(null);
            $table->string('mother_name', 30)->nullable()->default(null);



            //foreign keys
            //$table->foreignIdFor(\App\Models\Referral::class)->constrained();
            $table->foreignIdFor(\App\Models\PatientType::class)->constrained();


            $table->foreignIdFor(\App\Models\Title::class)->constrained();
            $table->foreignIdFor(\App\Models\Gender::class)->constrained();
            $table->foreignIdFor(\App\Models\Marital::class)->constrained();
            $table->foreignIdFor(\App\Models\Bloodgroup::class)->nullable();
            $table->foreignIdFor(\App\Models\Religion::class)->constrained();
            $table->foreignIdFor(\App\Models\Occupation::class)->constrained();
            $table->foreignIdFor(\App\Models\Nationality::class)->constrained();
            $table->foreignIdFor(\App\Models\Relation::class)->constrained();
            //added later for id
            $table->foreignIdFor(\App\Models\IdType::class)->nullable()->constrained();
            //added later rural/urban for reporting purpose
            $table->boolean('is_rural')->default(false);
            //remarks
            $table->string('remarks')->nullable()->default(null);
            $table->string('identification_no', 100)->nullable()->default(null);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('id_type_id')->nullable()->constrained('id_types')->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
