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
        Schema::create('health_coordinators', function (Blueprint $table) {
            $table->id();
            $table->string('code',20)->nullable();;
            $table->string('name',50)->nullable();;
            $table->string('father_name',50)->nullable();;
            $table->string('email',50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('mobile',12)->nullable();
            $table->string('dob')->nullable();;
            $table->string('address')->nullable();;
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
        Schema::dropIfExists('health_coordinators');
    }
};
