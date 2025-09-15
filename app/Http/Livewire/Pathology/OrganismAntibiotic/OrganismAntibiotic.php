<?php

namespace App\Http\Livewire\Pathology\OrganismAntibiotic;

use Livewire\Component;

class OrganismAntibiotic extends Component
{
    public function render()
    {
        return view('livewire.pathology.organism-antibiotic.organism-antibiotic')->extends('layouts.admin')->section('content');
    }
}
