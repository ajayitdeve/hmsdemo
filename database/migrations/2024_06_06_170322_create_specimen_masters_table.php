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
        Schema::create('specimen_masters', function (Blueprint $table) {
            $table->id();
            $table->string('code');//ex. SPC1
            $table->string('name');
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
        Schema::dropIfExists('specimen_masters');
    }
};
