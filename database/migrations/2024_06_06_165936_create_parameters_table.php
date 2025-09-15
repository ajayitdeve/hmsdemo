<?php

use App\Models\Department;
use App\Models\Pathology\ParameterUnit;
use App\Models\Service\ServiceGroup;
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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class);
            //Test Main Group is Service Group ; Here all Service group for PATHALOGY Despartment will be Service Group
            $table->foreignIdFor(ServiceGroup::class);
            $table->string('code',15);//ex LPR001
            $table->string('name');
            $table->string('short_name',50)->nullable();
            $table->string('method')->nullable();
            $table->enum('display_type',['S','B'])->comment('S=>Side B=>Beneath');
            $table->enum('text_size',['S','B'])->comment('S=>small B=>Big');
            $table->boolean('normal_range')->default(false);//if Yes then Push Data in ParameterValue table
            $table->boolean('antibiotic_needed')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('uom_unit')->default(false); // If uom_unit is Yes then fill unit in following Unit Column
            $table->foreignIdFor(ParameterUnit::class)->nullable();
            $table->boolean('multiple_values')->default(false); //if yes then create a key:value pair of json and push in column multivalue
            $table->text('multiple_value_json')->nullable();
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
        Schema::dropIfExists('parameters');
    }
};
