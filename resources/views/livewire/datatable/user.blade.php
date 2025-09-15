<div>
  <div class="row">
    <div class="col-md-12">
        <h1>JAi Mata Di</h1>
    </div>
  </div>
  <hr/>
  <div class="row m-4">
    <div class="col-md-3">
    <input type="text" class="form-control" placeholder="Search" required="" wire:model.live.debounce.300ms="search" />
    </div>
  </div>
  <div class="row m-4">
    <div class="col-md-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th wire:click="doSort('name')">
            <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="name" />
        </th>
        <th wire:click="doSort('email')">
        <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="email" />
        </th>
       
       
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
        <td> {{$user->name}}</td>
        <td>{{$user->email}}</td>
       
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
            <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>
    </div>
    <div class="col-md-9">
        {{$users->links()}}
    </div>
  </div>
</div>
