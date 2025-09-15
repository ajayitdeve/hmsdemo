<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DiagnosticResultController;
use App\Http\Livewire\Pathology\DiagnosticResult\AllDiagnosticResult;
use App\Http\Livewire\Pathology\DiagnosticResult\DiagnosticResultEntry;
use App\Http\Livewire\Pathology\Format\EditFormat;
use App\Http\Livewire\Pathology\Format\FormatSetUp;
use App\Http\Livewire\Pathology\Organism\EditOrganismMaster;
use App\Http\Livewire\Pathology\Parameter\EditParameter;
use App\Http\Livewire\Pathology\SampleCollection\SampleCollection;
use App\Http\Livewire\Pathology\Template\TemplateSetUp;
use App\Http\Livewire\Pathology\Organism\OrganismMaster;
use App\Http\Livewire\Pathology\Specimen\SpecimenMaster;
use App\Http\Livewire\Pathology\Parameter\ParameterMaster;
use App\Http\Livewire\Pathology\SpecimenSetUp\SpecimenSetUp;
use App\Http\Livewire\Pathology\Vacutainer\VacutainerMaster;
use App\Http\Livewire\Pathology\Antibiotic\AntibiometicMaster;
use App\Http\Livewire\Pathology\DiagnosticResult\AllIpdDiagnosticResult;
use App\Http\Livewire\Pathology\DiagnosticResult\IpdDiagnosticResultEntry;
use App\Http\Livewire\Pathology\Ipd\IpdSampleCollection;
use App\Http\Livewire\Pathology\OrganismAntibiotic\OrganismAntibiotic;

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/parameter-master', ParameterMaster::class)->name('parameter-master');
    //edit parameter
    Route::get('/parameter-master/edit/{id}', EditParameter::class)->name('parameter-master.edit');
    Route::get('/format-setup', FormatSetUp::class)->name('format-setup');
    //edit format
    Route::get('/format-setup/edit/{id}', EditFormat::class)->name('format-setup.edit');
    Route::get('/template-setup', TemplateSetUp::class)->name('template-setup');
    // Route::get('/template-setup', TemplateSetUp::class)->name('template-setup');
    Route::get('/antibiotic-master', AntibiometicMaster::class)->name('antibiotic-master');
    Route::get('/organism-master', OrganismMaster::class)->name('organism-master');
    //edit organism-master
    Route::get('/organism-master/edit/{id}', EditOrganismMaster::class)->name('organism-master.edit');

    Route::get('/organism-antibiotic-setup', OrganismAntibiotic::class)->name('organism-antibiotic-setup');
    Route::get('/specimen-master', SpecimenMaster::class)->name('specimen-master');
    Route::get('/vacutaine-master', VacutainerMaster::class)->name('vacutaine-master');
    Route::get('/specimen-setup', SpecimenSetUp::class)->name('specimen-setup');
    //sample collection
    Route::get('/sample-collection', SampleCollection::class)->name('sample-collection');
    //diagnostic Result Entry
    Route::get('/diagnostic-result-entry', DiagnosticResultEntry::class)->name('diagnostic-result-entry');
    //list of DiagnosticResult
    Route::get('/diagnostic-result-list', AllDiagnosticResult::class)->name('diagnostic-result-list');
    //print diagnostic report
    Route::get('/admin/print-diagnostic-report/{id}', [DiagnosticResultController::class, 'print_report'])->name('print-diagnostic-report');


    Route::prefix("ipd")->name("ipd.")->group(function () {
        Route::get('/sample-collection', IpdSampleCollection::class)->name('sample-collection');
        Route::get('/diagnostic-result-entry', IpdDiagnosticResultEntry::class)->name('diagnostic-result-entry');
        Route::get('/diagnostic-result-list', AllIpdDiagnosticResult::class)->name('diagnostic-result-list');

        Route::get('/admin/print-ipd-diagnostic-report/{id}', [DiagnosticResultController::class, 'print_ipd_diagnostic_report'])->name('print-diagnostic-report');
    });
});
