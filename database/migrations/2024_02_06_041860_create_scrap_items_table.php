<?php

use App\Models\Grn;
use App\Models\Item;
use App\Models\Scrap;
use App\Models\ScrapType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //'scrap_id','item_id','grn_id','scrap_type_id','batch_no','quantity','unit_sale_price','unit_purchase_price','remarks','created_by_id','updated_by_id'
    public function up(): void
    {
        Schema::create('scrap_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Scrap::class)->constrained();
            $table->foreignIdFor(Item::class)->constrained();
            $table->foreignIdFor(Grn::class)->constrained();
            $table->foreignIdFor(ScrapType::class)->constrained();
            $table->integer('quantity')->default(0);
            $table->decimal('unit_sale_price', 8, 2);
            $table->decimal('unit_purchase_price', 8, 2);
            $table->string('batch_no',20)->nullable();
            $table->text('remarks')->nullable()->default(null);
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
        Schema::dropIfExists('scrap_items');
    }
};
