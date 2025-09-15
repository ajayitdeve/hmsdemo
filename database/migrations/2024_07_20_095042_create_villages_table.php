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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->foreignIdFor(\App\Models\Country::class)->constrained();
            $table->foreignIdFor(\App\Models\State::class)->constrained();
            $table->foreignIdFor(\App\Models\District::class)->constrained();
            $table->foreignIdFor(\App\Models\Block::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
