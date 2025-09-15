<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Consultation List</h3>
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Consultation List</li>
                    </ul>
                </div>

            </div>
        </div>

  <div class="row ">
    <div class="col-md-3">
    <input type="text" class="form-control" placeholder="Search" required="" wire:model.live.debounce.300ms="search" wire:change="searchTextChanged" />
    </div>

    <div class="col-md-3">
    <form wire:submit.prevent='searchByDate'>

        <div class="row form-group">
            <label for="" class="col-md-4">From </label>
            <input type="date" class="form-control col-md-8" wire:model="from">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group row">
            <label for="" class="col-md-4">To </label>
            <input type="date" class="form-control col-md-8" wire:model="to">
        </div>

    </div>
    <div class="col-md-2">
    <button class="btn btn-success btn-block">Search</button>

    </form>
    </div>
    <div class="col-md-1">

    <button class="btn btn-primary btn-block" wire:click="clearFilter">Clear</button>
    </div>


  </div>
  <div class="row">
    <div class="col-md-12">
    <table class="table table-stripped mb-0 dataTable no-footer">
    <thead>
      <tr>
        <th wire:click="doSort('name')">
            <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="name" />
        </th>
        <th wire:click="doSort('registration_no')">
        <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="UMR" />
        </th>
        <th wire:click="doSort('visit_no')">
        <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="Consultation No" />
        </th>
        <th>Visit Type</th>
        <th>Visit Date</th>
        <th>Unit</th>
        <th>Doctor</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>
        @php
        $visitType=['Normal','Emergency','Revisit'];
        $unit=\App\Models\Unit::get();
        @endphp
        @foreach ($patientVisits as $patientVisit)
        <tr>
        <td> {{$patientVisit->name}}</td>
        <td>{{$patientVisit->registration_no}}</td>
        <td>{{$patientVisit->visit_no}}</td>
        <td>{{ $patientVisit->visit_type_id!=null?$visitType[$patientVisit->visit_type_id-1]:null}}</td>
        <td>{{$patientVisit->visit_date}}</td>
        <td>{{$unit->find($patientVisit->unit_id)->name}}</td>
        <td>

            @if($patientVisit->doctor_id!=null){{$patientVisit->doctor->name}}@else    <button wire:click="assignDoctor({{$patientVisit->id}})"  class="btn btn-white btn-sm m-t-10" href="#" data-toggle="modal" data-target="#assignDoctor"><i class="fa fa-plus m-r-5"></i>Assign Doctor</button> @endif

        </td>
        <td>
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <button wire:click="assignDoctor({{$patientVisit->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#assignDoctor"><i class="fa fa-pencil m-r-5"></i>Assign Doctor</button>
                    <button wire:click="view({{$patientVisit->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#view"><i class="fa fa-eye m-r-5"></i> View</button>
                </div>
        </td>
      </tr>
        @endforeach


    </tbody>
  </table>
    </div>
  </div>

  <div class="row m-4">
    <div class="col-md-3">
        <div class="form-group">
            <label > Per Page</label>
            <select wire:model.live="perPage">

                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="100">100</option>

            </select>
        </div>
    </div>
    <div class="col-md-9">
        {{$patientVisits->links()}}
    </div>
  </div>
  @include('livewire.opd-coordinator.modal')
@push('page-script')
    <script>


        window.addEventListener('close-modal', event => {
           $("#assignDoctor").modal('hide');

        })
        </script>
    @endpush
</div>
