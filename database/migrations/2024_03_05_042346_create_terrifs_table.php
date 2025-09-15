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
        Schema::create('teriffs', function (Blueprint $table) {
            $table->id();
            $table->string('code',100);
            $table->string('name');
            // $table->string('contact_person');
            //contact_person column deleted and created_by_id added
            $table->date('from');//efected from
            $table->date('to');//effected to
            $table->boolean('isneverexpired')->default(false);
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
        Schema::dropIfExists('terrifs');
    }
};
