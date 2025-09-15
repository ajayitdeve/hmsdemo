<?php

use App\Models\Department;
use App\Models\Pathology\Format;
use App\Models\Service\Service;
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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('code',15);//ex FMT001
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(ServiceGroup::class);
            //Test Code id the Service Code where main group is as above ; Example if Main Group is BIO then Test Code will all services under BIO
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(Format::class);

            $table->string('s1_cd')->nullable()->default(null);
            $table->string('s2_cd')->nullable()->default(null);
            $table->boolean('is_active')->nullable()->default(true);


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
        Schema::dropIfExists('templates');
    }
};
