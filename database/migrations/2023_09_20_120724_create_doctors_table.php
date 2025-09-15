<?php

use App\Models\Title;
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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->foreignIdFor(Title::class)->nullable();
            $table->string('name', 50);
            $table->string('alias', 50)->nullable();
            $table->string('registration_no', 20);
            $table->string('designation', 70);
            $table->string('consulting_room')->nullable();
            $table->string('email', 50)->unique()->nullable();
            $table->string('mobile', 12)->nullable();
            $table->string('dob')->nullable();
            $table->string('marriage_date', 20)->nullable();
            $table->decimal('fee')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('qualification')->nullable();
            $table->string('about_doctor')->nullable();
            $table->string('experience')->nullable();
            $table->string('doj', 20)->nullable();
            $table->string('resigned_date', 20)->nullable();

            //for specialization1 & 2 referencing specialization
            $table->foreignId('specialization1')->nullable()->constrained('specializations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('specialization2')->nullable()->constrained('specializations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(\App\Models\CostCenter::class)->constrained();
            $table->foreignIdFor(\App\Models\PaymentType::class)->constrained();
            $table->foreignIdFor(\App\Models\ConsultationType::class)->constrained();
            $table->foreignIdFor(\App\Models\DoctorType::class)->constrained();
            $table->foreignIdFor(\App\Models\ConsultingType::class)->constrained();
            $table->foreignIdFor(\App\Models\Department::class)->constrained();
            $table->foreignIdFor(\App\Models\Unit::class)->constrained();
            //added Latter
            $table->foreignIdFor(\App\Models\Gender::class)->constrained();

            $table->foreignIdFor(\App\Models\Specialization::class)->constrained();
            $table->longText('address')->nullable();
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
        Schema::dropIfExists('doctors');
    }
};
