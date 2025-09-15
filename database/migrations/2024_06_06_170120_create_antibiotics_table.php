<?php

use App\Models\Service\ServiceGroup;
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
        Schema::create('antibiotics', function (Blueprint $table) {
            $table->id();
            $table->string('code');//ex. ATB1
            $table->string('name');


            $table->string('senstive');
            $table->string('moderate');
            $table->string('resistance');

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
        Schema::dropIfExists('antibiotics');
    }
};
