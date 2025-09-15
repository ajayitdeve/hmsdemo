<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;

use Livewire\WithPagination;
class User extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage=10;
    public $search='';

    public $sortDirection='ASC';
    public $sortColumn= 'name';
    public function doSort($column){
        if($this->sortColumn=$column){
            $this->sortDirection=($this->sortDirection=='ASC')?'DESC': 'ASC';
            return ;
        }
        $this->sortColumn=$column;
        $this->sortDirection='ASC';

    }
    //life cycle hooks
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.datatable.user',[
            'users'=>\App\Models\User::Search($this->search)
            ->orderBy($this->sortColumn,$this->sortDirection)
            ->paginate($this->perPage)
        ])->extends('layouts.admin')->section('content');
    }
   
}
