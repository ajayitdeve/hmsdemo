<?php

use App\Http\Livewire\Master\Location\LocationMaster;
use App\Http\Livewire\Service\Package\PackageMaster;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Service\Teriff\TeriffMaster;
use App\Http\Livewire\Service\Service\ServiceMaster;


use App\Http\Livewire\Service\BillingHead\BillingHeadMaster;
use App\Http\Livewire\Service\ServiceGroup\ServiceGroupMaster;

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
  Route::get('billing-head-master', BillingHeadMaster::class)->name('billing-head-master');
  Route::get('location-master', LocationMaster::class)->name('location-master');
  Route::get('teriff-master', TeriffMaster::class)->name('teriff-master');
  Route::get('service-group-master', ServiceGroupMaster::class)->name('service-group-master');
  Route::get('service-master', ServiceMaster::class)->name('service-master');
  Route::get('package-master', PackageMaster::class)->name('package-master');
});
