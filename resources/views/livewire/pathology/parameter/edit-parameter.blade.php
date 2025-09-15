<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Parameter</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Parameter</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->
           <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
                @push('page-css')
<style>
    .form-control{
        font-size: 13px;
        height: 30px !important;
    }
    label {
    display: inline-block;
     margin-bottom: 0px;
     font-size: 13px;
}
    </style>
@endpush


 <!-- Edit  Modal -->

                <form wire:submit.prevent='update'>
                   <div class="row">
                       <div class="col-md-8">
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label>Department <span class="text-danger">*</span></label>
                                       <select wire:model='department_id' class="form-control" wire:change='departmentChanged'>
                                           <option value="">Select </option>
                                           @foreach ($departments as $department)
                                               <option value="{{ $department->id }}" {{$department->id==$department_id?'selected':null}}>{{ $department->name }}
                                               </option>
                                           @endforeach
                                       </select>
                                       @error('department_id')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label>Service Group <span class="text-danger">*</span></label>
                                       <select wire:model='service_group_id' class="form-control">
                                           <option value="">Select </option>
                                           @foreach ($servicegroups as $servicegroup)
                                               <option value="{{ $servicegroup->id }}" {{$servicegroup->id==$service_group_id?'selected':null}}>{{ $servicegroup->name }}
                                               </option>
                                           @endforeach
                                       </select>
                                       @error('service_group_id')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label>Name</label>
                                       <input type="text" class="form-control" wire:model='name' />
                                       @error('name')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label>Short Name</label>
                                       <input type="text" class="form-control" wire:model='short_name' />
                                       @error('short_name')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label>Method</label>
                                       <input type="text" class="form-control" wire:model='method' />
                                       @error('method')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label >Display Type {{$text_size}}</label>
                                       <div class="d-flex">
                                           <div class="form-check form-check-inline">
                                               <input class="form-check-input" type="radio" wire:model="text_size" value="S" {{$text_size=='S'?'selected':null}}  >
                                               <label class="form-check-label">Small </label>
                                           </div>
                                           <div class="form-check form-check-inline">
                                               <input class="form-check-input" type="radio" wire:model="text_size" value="B" {{$text_size=='B'?'selected':null}}>
                                               <label class="form-check-label text-nowrap">Big</label>
                                           </div>

                                       </div>
                                   </div>
                               </div>

                            </div>
                            <div class="row">
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <div class="d-flex">
                                           <label> Include in Antibiotic</label>
                                      &nbsp;&nbsp; <input type="checkbox" class="form-check-input" wire:model='antibiotic_needed'>
                                       </div>
                                        @error('antibiotic_needed')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <div class="d-flex">
                                           <label> Units Only</label>
                                       <input type="checkbox" class="form-check-input" wire:model='uom_unit'  >
                                       </div>
                                       @if($uom_unit)
                                       <select wire:model='parameter_unit_id' class="form-control">
                                           <option value="">Pramaeter Unit </option>
                                           @foreach ($parameterunits as $parameterunit)
                                               <option value="{{ $parameterunit->id }}">{{ $parameterunit->name }}
                                               </option>
                                           @endforeach
                                       </select>
                                       @endif
                                       @error('parameter_unit_id')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-3">

                                   <div class="d-flex">
                                       <label> Normal Range {{$normal_range}}</label>
                                   <input type="checkbox" class="form-check-input" wire:model='normal_range'>
                                   </div>

                               </div>
                               <div class="col-md-3">
                                   <label > Parameter Display {{$display_type}}</label>
                                   <div class="d-flex">
                                       <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" wire:model="display_type" value="S"  checked >
                                           <label class="form-check-label">Side</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" wire:model="display_type" value="B">
                                           <label class="form-check-label text-nowrap">Beneath</label>
                                       </div>

                                   </div>
                               </div>



                           </div>


                       </div>
                       <div class="col-md-4">

                           <div class="card">
                               <div class="card-header">
                                 Multiple Values
                               </div>
                               <div class="card-body">
                                   <div class="d-flex">
                                       <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" wire:model="multiple_values" value='1'  {{$multiple_values==1?'checked':null}}>
                                           <label class="form-check-label">Yes</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" wire:model="multiple_values" value='0' {{$multiple_values==0?'checked':null}}>
                                           <label class="form-check-label text-nowrap">No</label>
                                       </div>

                                   </div>
                                   <hr/>
                                   @if($multiple_values)
                                  <?php
                                //   echo "<pre>";
                                //     print_r(json_decode($multiple_value_json));
                                //     echo "</pre>";
                                  ?>
                                     <div class="form-group row">
                                       <div class="col-md-10">
                                           <input type="text" class="form-control" wire:model='multipleName'/>
                                       </div>
                                       <div class="col-md-2">
                                           <button type="button" class="btn btn-primary btn-sm d-block " wire:click="addMultipleValues" @if($multipleName==null)disabled @endif>Add</button>
                                       </div>

                                     </div>

                                     <div class="table-responsive">
                                       <table class="table table-striped custom-table mb-0">

                                           <tbody>

                                               @foreach ($multiValuesArr as $values)
                                               <tr>

                                                   <td>{{$values['name']}}</td>

                                                   <td style="float:right;">     <button type="button" class="btn-primary" wire:click="deleteMultipleValues({{$values['id']}})"><i class="fa fa-trash"></i></button></td>

                                               </tr>
                                               @endforeach


                                           </tbody>
                                       </table>
                                       <div>

                                       </div>
                                   </div>

                                   @endif
                               </div>
                             </div>


                       </div>
                   </div>

                        {{-- existing parameters --}}
                        @if($normal_range==1)
                        @if($selectedParameter!=null)
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Existing Normal Range Values</h4>
                                <div class="card-header">
                                    <div class="table-responsive">
                                        <table class="table table-bordered custom-table mb-0">
                                            <thead>
                                                <tr style="font-size: 12px;">


                                                    <th>Id</th>
                                                    <th>Gender</th>
                                                    <th>Min Age</th>
                                                    <th>UOM</th>
                                                    <th>Max Age</th>
                                                    <th>UOM</th>
                                                    <th>Description</th>
                                                    <th>Symbole</th>
                                                    <th>Min Range</th>
                                                    <th>Max Range</th>
                                                    <th>Unit</th>
                                                    <th>Nr. Range</th>
                                                    <th>Min Crit</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($selectedParameter->parameterValues as $parameterValue)

                                                <tr>
                                                    <td>{{$parameterValue->id}}</td>
                                                    <td>{{$parameterValue->gender}}</td>
                                                    <td>{{$parameterValue->min_age}}</td>
                                                    <td>{{$parameterValue->min_age_uom}}</td>
                                                    <td>{{$parameterValue->max_age}}</td>
                                                    <td>{{$parameterValue->max_age_uom}}</td>
                                                    <td>{{$parameterValue->description}}</td>
                                                    <td>{{$parameterValue->symbol_id}}</td>
                                                    <td>{{$parameterValue->min_range}}</td>
                                                    <td>{{$parameterValue->max_range}}</td>
                                                    <td>{{$parameterValue->parameter_unit_id}}</td>
                                                    <td>{{$parameterValue->normal_range_value}}</td>
                                                    <td>{{$parameterValue->min_critical}}</td>
                                                    <td> <a wire:click="delete({{$parameterValue->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></td>


                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        {{-- end of existing parameters --}}


                   {{-- Parameter Values  --}}
                   @if($normal_range==1)
                   <div class="card">
                       <div class="card-header">
                           <div class="table-responsive">
                               <table class="table table-bordered custom-table mb-0">
                                   <thead>
                                       <tr style="font-size: 12px;">


                                           <th>Id</th>
                                           <th>Gender</th>
                                           <th>Min Age</th>
                                           <th>UOM</th>
                                           <th>Max Age</th>
                                           <th>UOM</th>
                                           <th>Description</th>
                                           <th>Symbole</th>
                                           <th>Min Range</th>
                                           <th>Max Range</th>
                                           <th>Unit</th>
                                           <th>Nr. Range</th>
                                           <th>Min Crit</th>

                                       </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($parameterValuesArr as $parameterValue)

                                       <tr>
                                           <td>{{$parameterValue['id']}} <button type="button" class="btn-primary" wire:click="deleteCart({{$parameterValue['id']}})"><i class="fa fa-trash"></i></button></td>
                                           <td>{{$parameterValue['gender']}}</td>
                                           <td>{{$parameterValue['min_age']}}</td>
                                           <td>{{$parameterValue['min_age_uom']}}</td>
                                           <td>{{$parameterValue['max_age']}}</td>
                                           <td>{{$parameterValue['max_age_uom']}}</td>
                                           <td>{{$parameterValue['description']}}</td>
                                           <td>{{$parameterValue['symbol_id']}}</td>
                                           <td>{{$parameterValue['min_range']}}</td>
                                           <td>{{$parameterValue['max_range']}}</td>
                                           <td>{{$parameterValue['parameter_unit_id']}}</td>
                                           <td>{{$parameterValue['normal_range_value']}}</td>
                                           <td>{{$parameterValue['min_critical']}}</td>


                                       </tr>
                                       @endforeach
                                   </tbody>
                               </table>
                               <div>

                               </div>
                           </div>
                       </div>
                       <div class="card-body">
                           <div class="row mb-0 pb-0">

                               <div class="col-md-2">
                                   <div class="form-group">
                                       <label>Gender</label>
                                       <select wire:model='gender' class="form-control">
                                           <option value="">Select </option>
                                           <option value="Male">Male</option>
                                           <option value="Male">Female</option>
                                       </select>
                                       @error('gender')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                                   </div>
                               </div>
                               <div class="col-md-1">
                                   <div class="form-group">
                                       <label>Min Age</label>
                                       <input type="number" class="form-control" wire:model='min_age' />
                                       @error('min_age')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-2">
                                   <div class="form-group">
                                       <label>UOM</label>
                                       <select wire:model='min_age_uom' class="form-control">
                                           <option value="">Select </option>
                                           <option value="1">Year</option>
                                           <option value="2">Month</option>
                                           <option value="3">Day</option>
                                           <option value="4">Hour</option>
                                           <option value="5">Minute</option>
                                           <option value="6">Second</option>
                                       </select>
                                       @error('min_age_uom')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-1">
                                   <div class="form-group">
                                       <label>Max Age</label>
                                       <input type="number" class="form-control" wire:model='max_age' />
                                       @error('max_age')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-2">
                                   <div class="form-group">
                                       <label>UOM</label>
                                       <select wire:model='max_age_uom' class="form-control">
                                           <option value="">Select </option>
                                           <option value="1">Year</option>
                                           <option value="2">Month</option>
                                           <option value="3">Day</option>
                                           <option value="4">Hour</option>
                                           <option value="5">Minute</option>
                                           <option value="6">Second</option>
                                       </select>
                                       @error('max_age_uom')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-2">
                                   <div class="form-group">
                                       <label>Desc.</label>
                                       <input type="text" class="form-control" wire:model='description' />
                                       @error('description')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>
                               <div class="col-md-2">
                                   <div class="form-group">
                                       <label>Symbol</label>
                                       <select wire:model='symbol_id' class="form-control">
                                           <option value="">Select </option>
                                           @foreach ($symbols as $symbol)
                                               <option value="{{ $symbol->id }}">{{ $symbol->name }}
                                               </option>
                                           @endforeach
                                       </select>
                                       @error('symbol_id')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>


                       </div>
                       <div class="row mt-0 pt-0">
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Min Range</label>
                                   <input type="text" class="form-control" wire:model='min_range' />
                                   @error('min_range')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Max Range</label>
                                   <input type="text" class="form-control" wire:model='max_range' />
                                   @error('max_range')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Units</label>
                                   <select wire:model='parameter_unit_id' class="form-control">
                                       <option value="">Select </option>
                                       @foreach ($parameterunits as $parameterunit)
                                           <option value="{{ $parameterunit->id }}">{{ $parameterunit->name }}
                                           </option>
                                       @endforeach
                                   </select>
                                   @error('parameter_unit_id')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Normal Range</label>
                                   <input type="text" class="form-control" wire:model='normal_range_value' />
                                   @error('normal_range_value')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Min Critical</label>
                                   <input type="text" class="form-control" wire:model='min_critical' />
                                   @error('min_critical')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Max critical</label>
                                   <input type="text" class="form-control" wire:model='max_critical' />
                                   @error('min_critical')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                           </div>



                       </div>
                                <div class="row m-0 p-0">
                                <div class="col-md-12 text-center">
                                    <div class="col-md- text-center">

                                        <button style="float:right" type="button" class="btn btn-primary btn-sm d-block "  wire:click="addToCart">Add</button>

                                    </div>
                                </div>
                                </div>
                       </div>
                   </div>
                    @endif
                   {{-- End Parameter Values --}}






                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
  <!-- Delete  Modal -->
  <div wire:ignore.self class="modal custom-modgal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent='destroy'>
                    <div class="form-header">
                        <h3>Delete </h3>
                        <p>Are you sure want to delete ?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn btn-block">Delete</>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <!-- /Delete  Modal -->



 @push('page-script')
 <script>


     window.addEventListener('close-modal', event => {
        $("#add").modal('hide');
        $("#edit").modal('hide');
        $("#delete").modal('hide');
     })
     </script>
 @endpush
</div>
