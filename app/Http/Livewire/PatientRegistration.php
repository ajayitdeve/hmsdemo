<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class PatientRegistration extends Component
{

   public $selectedState;
   public $selectedCity;
   public $states=[];
   public $cities=[];

   public $defaultState;
    public function mount()
    {
        $this->states=State::where('country_id',101)->get();

       // dd($this->states);
     }

     public function stateChanged(){
        if($this->selectedState!=-1){
            $this->cities=City::where('state_id',$this->selectedState)->get();
           // dd($this->cities);
        }
     }
    public function render()
    {
        return view('livewire.patient.patient-registration');
    }
}
