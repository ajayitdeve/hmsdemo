<?php

namespace App\Http\Livewire\Patient;

use App\Models\PatientVisit;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ConsultationList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "";

    public $consultation_id, $reason, $approved_by;
    public $users = [];

    public function mount()
    {
        $this->users = User::all();
    }

    public function view_cancel_consultation($id)
    {
        $this->reset(['consultation_id', 'reason', 'approved_by']);
        $this->consultation_id = $id;
        $patientvisit = PatientVisit::find($id);
        if ($patientvisit) {
            $this->reason = $patientvisit->cancelled_reason;
            $this->approved_by = $patientvisit->cancelled_approve_by_id;

            $this->dispatchBrowserEvent('show-cancel-modal');
        }
    }

    public function cancel()
    {
        $this->validate([
            'reason' => 'required',
            'approved_by' => 'required',
        ]);

        $patientvisit = PatientVisit::find($this->consultation_id);
        if ($patientvisit) {
            $patientvisit->cancelled_reason = $this->reason;
            $patientvisit->cancelled_approve_by_id = $this->approved_by;
            $patientvisit->cancelled_by_id = auth()->user()?->id;
            $patientvisit->save();

            $patientvisit->delete();

            session()->flash('message', 'Consultation cancel successfully.');
            $this->dispatchBrowserEvent('hide-cancel-modal');
        }
    }

    public function render()
    {
        $today = request()->query('today');

        $patientvisits = PatientVisit::orderBy('id', 'DESC')
            ->when($today, function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->get();

        return view('livewire.patient.consultation-list', ['patientvisits' => $patientvisits])->extends('layouts.admin')->section('content');
    }
}
