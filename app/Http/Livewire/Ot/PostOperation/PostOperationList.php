<?php

namespace App\Http\Livewire\Ot\PostOperation;

use App\Models\OtPostOperation;
use Livewire\Component;

class PostOperationList extends Component
{
    public $post_operations = [];

    public function mount()
    {
        $this->post_operations = OtPostOperation::latest()->get();
    }

    public function render()
    {
        return view('livewire.ot.post-operation.post-operation-list')->extends('layouts.admin')->section('content');
    }
}
