<?php

use App\Models\Ipd\Ipd;
use App\Models\Relation;
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
        Schema::create('attendents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Relation::class)->constrained();
            $table->string('name',30)->nullable();
            $table->string('mobile',12)->nullable();
            $table->string('alt_mobile',12)->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendents');
    }
};
