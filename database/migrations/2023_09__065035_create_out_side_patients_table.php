<?php

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
        Schema::create('out_side_patients', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no', 20)->nullable();
            //$table->string('name',30)->nullable()->fulltext()->comment('full name of the patient');
            $table->string('name', 30)->nullable()->comment('full name of the patient');
            $table->string('mobile', 12)->nullable()->default(null);
            $table->string('age', 100)->nullable()->default(null);
            $table->string('address')->nullable()->default(null);;
            $table->foreignIdFor(\App\Models\Title::class)->constrained();
            $table->foreignIdFor(\App\Models\Gender::class)->constrained();
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
        Schema::dropIfExists('out_side_patients');
    }
};
