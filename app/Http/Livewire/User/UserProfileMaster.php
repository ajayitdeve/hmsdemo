<?php

namespace App\Http\Livewire\User;

use App\Models\Department;
use App\Models\Team;
use App\Models\UserGroup;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserProfileMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $team_id, $department_id, $user_group_id, $name, $code;
    public $departments = [];
    public $user_groups = [];
    public $role_list = [];
    public $roles = [];

    public function mount()
    {
        $this->departments = Department::get();
        $this->user_groups = UserGroup::get();
        $this->role_list = Role::whereNotIn('name', config('app.hidden_roles'))->get();
    }

    protected function rules()
    {
        return [
            'department_id' => ['required'],
            'user_group_id' => ['required'],
            'name' => [
                'required',
                Rule::unique('teams')->ignore($this->team_id),
            ],
            'code' => [
                'required',
                Rule::unique('teams')->ignore($this->team_id),
            ],
            'roles' => ['required', 'array'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        Team::create([
            'department_id' => $this->department_id,
            'user_group_id' => $this->user_group_id,
            'name' => $this->name,
            'code' => $this->code,
            'roles' => $this->roles,
            'is_active' => 1,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'User Profile Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $team = Team::find($id);
        if ($team) {
            $roles = Role::whereIn('name', $team->roles)->pluck("name")->toArray();

            $this->team_id = $team->id;
            $this->department_id = $team->department_id;
            $this->user_group_id = $team->user_group_id;
            $this->name = $team->name;
            $this->code = $team->code;
            $this->roles = $roles;
        }
    }

    public function update()
    {
        $this->validate();

        $team = Team::find($this->team_id);
        if ($team) {
            $team->update([
                'department_id' => $this->department_id,
                'user_group_id' => $this->user_group_id,
                'name' => $this->name,
                'code' => $this->code,
                'roles' => $this->roles,
            ]);
        }

        session()->flash('message', 'User Profile Updated Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $this->team_id = $id;
    }

    public function destroy()
    {
        Team::where('id', $this->team_id)->delete();
        session()->flash('message', 'User Profile Deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $teams = Team::latest()->paginate(10);

        return view('livewire.user.user-profile-master', compact('teams'))->extends('layouts.admin')->section('content');
    }
}
