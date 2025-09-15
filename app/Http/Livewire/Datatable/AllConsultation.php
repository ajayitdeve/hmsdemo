<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;
use Livewire\WithPagination;

class AllConsultation extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 20;
    public $search = '';


    public $sortDirection = 'DESC';
    public $sortColumn = 'name';
    //for date filter
    public $from = null, $to = null, $isDateSerch = false, $isNormalSearch = false;

    public function doSort($column)
    {
        if ($this->sortColumn = $column) {
            $this->sortDirection = ($this->sortDirection == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';

    }

    //life cycle hooks
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->search = null;
        $this->isDateSerch = true;
    }

    public function clearFilter()
    {
        $this->to = null;
        $this->from = null;
        $this->search = null;
        $this->isDateSerch = false;
    }

    public function searchTextChanged()
    {
        $this->isNormalSearch = true;
    }

    public function render()
    {
        if ($this->isDateSerch == false && $this->isNormalSearch == false) {
            return view('livewire.datatable.all-consultation', [
                'patientVisits' => \App\Models\PatientVisit::Search($this->search)
                    ->orderBy($this->sortColumn, $this->sortDirection)
                    ->paginate($this->perPage)
            ])->extends('layouts.admin')->section('content');
        } else {
            if ($this->isDateSerch == true) {
                return view('livewire.datatable.all-consultation', [
                    'patientVisits' => \App\Models\PatientVisit::Filter($this->from, $this->to)
                        ->orderBy($this->sortColumn, $this->sortDirection)
                        ->paginate($this->perPage)
                ])->extends('layouts.admin')->section('content');

            } else {
                return view('livewire.datatable.all-consultation', [
                    'patientVisits' => \App\Models\PatientVisit::Search($this->search)
                        ->orderBy($this->sortColumn, $this->sortDirection)
                        ->paginate($this->perPage)
                ])->extends('layouts.admin')->section('content');
            }
        }


    }

}
