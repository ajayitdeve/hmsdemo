<?php

use App\Models\BinItem;
use App\Exports\InventoryExport;
use App\Models\OpdMedicineReceipt;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Scrap\ListScrap;
use App\Models\OpdMedicineTransaction;
use App\Http\Livewire\Scrap\ListScrapItem;
use App\Http\Livewire\Scrap\ScrapTransfer;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\IpBillingController;
use App\Http\Controllers\SaleStoreController;
use App\Http\Livewire\Pharmacy\Bin\BinMaster;
use App\Http\Livewire\OpdMedicineSale\PharmacyReturn;
use App\Http\Livewire\Pharmacy\BinItem\BinItemMaster;
use App\Http\Controllers\OpdMedicineReceiptController;
use App\Http\Livewire\Pharmacy\BinGroup\BinGroupMaster;
use App\Http\Livewire\OpdMedicineSale\CancleMedicineSale;
use App\Http\Livewire\OpdMedicineSale\PharmacyReturnList;
use App\Http\Livewire\Pharmacy\Vendor\VendorRegistration;
use App\Http\Controllers\OpdMedicineTransactionController;
use App\Http\Livewire\OpdMedicineSale\PharmacyCancleReceipt;
use App\Http\Livewire\PharmacyReport\MedicinePurchaseReport;
use App\Http\Livewire\OpdMedicineSale\PharmacyReturnItemList;
use App\Http\Livewire\OpdMedicineSale\PharmacyCancleTransaction;
use App\Http\Livewire\Pharmacy\ChooseStockPoint\ChooseStockPoint;
use App\Http\Livewire\PharmacyInternalTransfer\InternalTransferGin;
use App\Http\Livewire\PharmacyInternalTransfer\PharmacyInternalTransfer;
use App\Http\Livewire\Pharmacy\Issues\IpPharmacyBilling\IpPharmacyBilling;
use App\Http\Livewire\Pharmacy\Issues\IpPharmacyBilling\IpPharmacyBillingCreate;

//Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/stock-point', ChooseStockPoint::class)->name('stock-point');

    //pharmacy Route : livewire
    Route::get('/pharmacy/type-master', App\Http\Livewire\Pharmacy\Type\TypeMaster::class)->name('pharmacy.type-master');
    Route::get('/pharmacy/stock-point-master', App\Http\Livewire\Pharmacy\StockPoint\StockPointMaster::class)->name('pharmacy.stock-point-master');
    Route::get('/pharmacy/item-group-master', App\Http\Livewire\Pharmacy\ItemGroup\ItemGroupMaster::class)->name('pharmacy.item-group-master');
    Route::get('/pharmacy/generic-master', App\Http\Livewire\Pharmacy\Generic\GenericMaster::class)->name('pharmacy.generic-master');
    Route::get('/pharmacy/form-master', App\Http\Livewire\Pharmacy\Form\FormMaster::class)->name('pharmacy.form-master');
    Route::get('/pharmacy/category-master', App\Http\Livewire\Pharmacy\Category\CategoryMaster::class)->name('pharmacy.category-master');
    Route::get('/pharmacy/item-specialization-master', App\Http\Livewire\Pharmacy\ItemSpecialization\ItemSpecializationMaster::class)->name('pharmacy.item-specialization-master');
    Route::get('/pharmacy/manufacturer-master', App\Http\Livewire\Pharmacy\Manufacturer\ManufacturerMaster::class)->name('pharmacy.manufacturer-master');
    Route::get('/pharmacy/item-master', App\Http\Livewire\Pharmacy\Item\ItemMaster::class)->name('pharmacy.item-master');

    //pharmacy-vendor registration
    Route::get('/pharmacy/vendor-registration', VendorRegistration::class)->name('pharmacy.vendor-registration');

    //Bin Routes
    Route::get('/pharmacy/bin-group-master', BinGroupMaster::class)->name('pharmacy.bin-group-master');
    Route::get('/pharmacy/bin-master', BinMaster::class)->name('pharmacy.bin-master');
    Route::get('/pharmacy/bin-item', BinItemMaster::class)->name('pharmacy.bin-item');

    //po
    Route::get('/po/create-purchase-indent', App\Http\Livewire\Po\CreatePurchaseIndent::class)->name('po.create-purchase-indent');

    Route::get('/po/list-purchase-indent', App\Http\Livewire\Po\ListPurchaseIndent::class)->name('po.list-purchase-indent');
    Route::get('/po/list-purchase-order', App\Http\Livewire\Po\ListPurchaseOrder::class)->name('po.list-purchase-order');
    Route::get('/po/show-purchase-indent/{purchase_indent_id}', App\Http\Livewire\Po\ShowPurchaseIndent::class)->name('po.show-purchase-indent');
    Route::get('/po/create-po/{purchase_indent_id}', App\Http\Livewire\Po\CreatePo::class)->name('po.create-po');

    //26-2-2024 Creating PO with items selected in purchase indent
    Route::get('/po/create-po-new/{purchase_indent_id}', App\Http\Livewire\Po\CreatePoNew::class)->name('po.create-po-new');

    Route::get('po/print/{purchase_order_id}', [\App\Http\Controllers\PurchaseOrderController::class, 'print'])->name('po.print');


    //Good Receive Notes
    Route::get('/grn/create-grn', App\Http\Livewire\Grn\CreateGrn::class)->name('grn.create-grn');
    Route::get('/grn/add-grn-items/{grn_id}', App\Http\Livewire\Grn\AddGrnItems::class)->name('grn.add-grn-items');
    Route::get('/grn/add-grn-items-new/{grn_id}', App\Http\Livewire\Grn\AddGrnItemsNew::class)->name('grn.add-grn-items-new');
    //Rates
    Route::get('/rate/add-rate', App\Http\Livewire\Rate\AddRate::class)->name('rate.add-rate');

    //MRQ
    Route::get('/mrq/create-mrq', App\Http\Livewire\Mrq\CreateMrq::class)->name('mrq.create-mrq');
    Route::get('/mrq/list-mrq', App\Http\Livewire\Mrq\ListMrq::class)->name('mrq.list-mrq');
    Route::get('/mrq/show-mrq/{mrq_id}', App\Http\Livewire\Mrq\ShowMrq::class)->name('mrq.show-mrq');
    Route::get('/mrq/add-mrq-items/{mrq_id}', App\Http\Livewire\Mrq\AddMrqItems::class)->name('mrq.add-mrq-items');

    //MRQ For Store
    Route::get('/mrq/list-store-mrq', App\Http\Livewire\Mrq\ListStoreMrq::class)->name('mrq.list-store-mrq');

    //print GIN
    Route::get('mrq/print/{mrq_id}', [\App\Http\Controllers\MrqController::class, 'print'])->name('mrq.print');

    //GIN
    Route::get('/gin/create-gin', App\Http\Livewire\Gin\CreateGin::class)->name('gin.create-gin');
    Route::post('/gin/store-gin', [\App\Http\Controllers\GinController::class, 'createGin'])->name('gin.store-gin');

    //GIN Items
    Route::get('/gin/create-gin-items/{gin_id}', App\Http\Livewire\Gin\CreateGinItem::class)->name('gin.create-gin-items');

    //print GIN
    Route::get('gin/print/{gin_id}', [\App\Http\Controllers\GinController::class, 'print'])->name('gin.print');

    //SaleStore
    Route::get('/sale-store/list-sale-store', \App\Http\Livewire\SaleStore\ListSaleStore::class)->name('sale-store.list-sale-store');
    Route::get('/sale-store/list-sale-store-by-stock-point', \App\Http\Livewire\SaleStore\ListSaleStoreByStockPoint::class)->name('sale-store.list-sale-store-by-stock-point');
    Route::get('/sale-store/new-gin', \App\Http\Livewire\SaleStore\NewGin::class)->name('sale-store.new-gin');

    //inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/stock', [InventoryController::class, 'stock'])->name('inventory.stock');

    //salestore
    Route::get('/salestore', [SaleStoreController::class, 'index'])->name('salestore.index');

    //OpdMedicineReceipt and OpdMedicineTransaction
    Route::get('/opd-medicine-sale/sale', \App\Http\Livewire\OpdMedicineSale\OpdMedicineSale::class)->name('opd-medicine-sale.sale');
    Route::get('opd_medicine_receipt_print/{opd_medicine_receipt_id}', [OpdMedicineReceiptController::class, 'print'])->name('opd_medicine_receipt_print');

    //medicine receipt for OutSidePatient
    Route::get('osp_medicine_receipt_print/{opd_medicine_receipt_id}', [OpdMedicineReceiptController::class, 'print_osp'])->name('osp_medicine_receipt_print');
    Route::get('/opd-medicine-receipt-list', [OpdMedicineReceiptController::class, 'index'])->name('opd-medicine-receipt-list');

    //Out Side Patient Medicine Sale new
    Route::get('/osp-medicine-sale/sale', \App\Http\Livewire\OpdMedicineSale\OutSidePatientMedicineSale::class)->name('osp-medicine-sale.sale');

    //cancle Medicine Sale new
    Route::get('/cancle-medicine-sale', CancleMedicineSale::class)->name('pharmacy.cancle-medicine-sale');

    //Pharmacy cancle medicine list
    Route::get('/pharmacy-cancle-receipt', PharmacyCancleReceipt::class)->name('pharmacy.pharmacy-cancle-receipt');
    Route::get('/pharmacy-cancle-transaction/{id}', PharmacyCancleTransaction::class)->name('pharmacy.pharmacy-cancle-transaction');

    //return medicine/pharmacy new
    Route::get('/pharmacy-return', PharmacyReturn::class)->name('pharmacy.pharmacy-return');
    Route::get('/pharmacy-return-list', PharmacyReturnList::class)->name('pharmacy.pharmacy-return-list');
    Route::get('/pharmacy-return-list-items/{id}', PharmacyReturnItemList::class)->name('pharmacy.pharmacy-return-list-items');

    //Pharmacy Internal Transfer : gins
    Route::get('/pharmacy-internal-transfer-gin', InternalTransferGin::class)->name('pharmacy.pharmacy-internal-transfer-gin');

    //for internal :gin_items
    Route::get('/pharmacy-internal-transfer-gin-items/{gin_id}', PharmacyInternalTransfer::class)->name('pharmacy.pharmacy-internal-transfer-gin-items');

    //Scrap Transfer
    Route::get('/scrap/scrape-transfer', ScrapTransfer::class)->name('pharmacy.scrap.scrap-transfer');

    //List Scrap
    Route::get('/scrap/list-scrap', ListScrap::class)->name('pharmacy.scrap.list-scrap');

    //list scrap item
    Route::get('/scrap/list-scrap-item/{scrap_id}', ListScrapItem::class)->name('pharmacy.scrap.list-scrap-item');

    /** Item Purchase report */
    Route::get('/pharmacy/medicine-purchase-report', MedicinePurchaseReport::class)->name('pharmacy.medicine-purchase-report');


    // pharmacy issues ip pharmacy billing
    Route::group(['prefix' => "pharmacy/issues/ip-pharmacy-billing"], function () {
        Route::get('/create', IpPharmacyBillingCreate::class)->name('pharmacy.issues.ip-pharmacy-billing.create');
        Route::get('/', IpPharmacyBilling::class)->name('pharmacy.issues.ip-pharmacy-billing');
        Route::get('/print/{bill_id}', [IpBillingController::class, 'print'])->name('pharmacy.issues.ip-pharmacy-billing.print');
    });
});
