<?php

use App\Models\Department;
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
        Schema::create('organisms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class);
            //Test Main Group is Service Group ; Here all Service group for PATHALOGY Despartment will be Service Group
            $table->foreignIdFor(ServiceGroup::class);
            $table->string('code');//ex. ORG1
            $table->string('name');
            $table->boolean('default_organism')->default(false);
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
        Schema::dropIfExists('organisms');
    }
};
