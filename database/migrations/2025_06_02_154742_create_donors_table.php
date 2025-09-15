<?php

use App\Models\Ipd\Ipd;
use App\Models\Patient;
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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->nullable();
            $table->foreignIdFor(Ipd::class)->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->foreignIdFor(\App\Models\Title::class)->constrained();
            $table->string('name', 150)->nullable()->comment('full name of the donor');
            $table->date('dob')->nullable()->comment('numbers only');
            $table->string('age', 100)->nullable();
            $table->foreignIdFor(\App\Models\Gender::class)->constrained();
            $table->foreignIdFor(\App\Models\Marital::class)->constrained();
            $table->foreignIdFor(\App\Models\Bloodgroup::class)->nullable();
            $table->string('email', 100)->nullable()->default(null);
            $table->string('mobile', 12)->nullable()->default(null);
            $table->bigInteger('village_id')->nullable()->default(null);
            $table->foreignIdFor(\App\Models\Religion::class)->constrained();
            $table->foreignIdFor(\App\Models\Occupation::class)->constrained();
            $table->string('address')->nullable();
            $table->string('pincode', 10)->nullable()->default(null);
            $table->foreignIdFor(\App\Models\Nationality::class)->constrained();
            $table->foreignIdFor(\App\Models\Relation::class)->constrained();
            $table->string('father_name', 30)->nullable()->default(null);
            $table->string('mother_name', 30)->nullable()->default(null);
            $table->foreignIdFor(\App\Models\IdType::class)->nullable()->constrained();
            $table->string('identification_no', 20)->nullable()->default(null);
            $table->string('remarks')->nullable()->default(null);
            $table->string('pulse', 50)->nullable();
            $table->string('bp', 50)->nullable();
            $table->string('hb', 50)->nullable();
            $table->string('weight', 50)->nullable();
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
        Schema::dropIfExists('donors');
    }
};
