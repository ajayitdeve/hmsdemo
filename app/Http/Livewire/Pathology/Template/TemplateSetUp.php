<?php

namespace App\Http\Livewire\Pathology\Template;

use Livewire\Component;
use App\Models\Department;
use App\Models\Service\Service;
use App\Models\Pathology\Format;
use App\Models\Pathology\Template;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;

class TemplateSetUp extends Component
{
    public $template_id, $templates = [], $departments = [], $servicegroups = [];
    public $code, $department_id, $service_group_id, $service_id, $format_id, $s1_cd = null, $s2_cd = null, $is_active = true, $created_by_id, $updated_by_id;
    public $services, $formats;

    public function mount()
    {
        $this->templates = Template::latest()->get();
        $this->departments = Department::get();
        $this->servicegroups = ServiceGroup::get();
        $this->services = Service::get();
        $this->formats = Format::get();
    }

    protected function rules()
    {
        return [
            'department_id' => 'required',
            'service_group_id' => 'required',
            'service_id' => 'required',
            'format_id' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $templateMaxId = Template::max('id');
        $templateCode = 'TEM' . $templateMaxId + 1;
        // `code`, `department_id`, `service_group_id`, `service_id`, `format_id`, `s1_cd`, `s2_cd`, `is_active`, `created_by_id`, `updated_by_id`
        $template = Template::create([
            'department_id' => $this->department_id,
            'service_group_id' => $this->service_group_id,
            'service_id' => $this->service_id,
            'format_id' => $this->format_id,
            'code' => $templateCode,
            's1_cd' => $this->s1_cd,
            's2_cd' => $this->s2_cd,
            'is_active' => $this->is_active,
            'created_by_id' => Auth::user()?->id,
            'updatedby_id' => Auth::user()?->id,
        ]);
        if ($template) {
            session()->flash('message', 'Template Added Successfully.');
            $this->resetExcept(['services', 'templates', 'departments', 'servicegroups', 'formats']);
            $this->dispatchBrowserEvent('close-modal');
            $this->templates = Template::latest()->get();
        }
    }

    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }

    public function closeModal()
    {
        $this->resetExcept(['services', 'templates', 'departments', 'servicegroups', 'formats']);
    }

    public function edit($id)
    {
        $this->template_id = $id;
        $template = Template::find($this->template_id);
        if ($template) {
            $this->code = $template->code;
            $this->department_id = $template->department_id;
            $this->service_group_id = $template->service_group_id;
            $this->service_id = $template->service_id;
            $this->format_id = $template->format_id;
            $this->s1_cd = $template->s1_cd;
            $this->s2_cd = $template->s2_cd;
            $this->is_active = $template->is_active;
        }
    }

    public function update()
    {
        $template = Template::find($this->template_id);
        if ($template) {
            $template->update([
                'department_id' => $this->department_id,
                'service_group_id' => $this->service_group_id,
                'service_id' => $this->service_id,
                'format_id' => $this->format_id,
                's1_cd' => $this->s1_cd,
                's2_cd' => $this->s2_cd,
                'is_active' => $this->is_active,
                'updated_by_id' => Auth::user()?->id,
            ]);

            session()->flash('message', 'Template Updated Successfully.');
            $this->resetExcept(['services', 'templates', 'departments', 'servicegroups', 'formats']);
            $this->dispatchBrowserEvent('close-modal');
            $this->templates = Template::latest()->get();
        }
    }

    public function delete($id)
    {
        $this->template_id = $id;
    }

    public function destroy()
    {
        Template::find($this->template_id)->delete();
        session()->flash('message', 'Template deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');
        $this->templates = Template::latest()->get();
    }

    public function render()
    {
        return view('livewire.pathology.template.template-set-up')->extends('layouts.admin')->section('content');
    }
}
