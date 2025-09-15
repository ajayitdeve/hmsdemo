<?php

namespace App\Http\Livewire\Scrap;

use App\Models\ScrapItem;
use Livewire\Component;

class ListScrapItem extends Component
{

    public $scrapItems=[];
    public function mount($scrap_id){
        $this->scrapItems=ScrapItem::where('scrap_id',$scrap_id)->get();
    }
    public function render()
    {
        return view('livewire.scrap.list-scrap-item')->extends('layouts.admin')->section('content');
    }
}
