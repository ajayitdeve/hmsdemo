<div>
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
    <!-- Page Content -->
    <div class="content container-fluid bg-white " >

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Referral</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Referral</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add Title</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Alias</th>
                                <th>OPD %</th>
                                <th>IPD %</th>
                                <th>Inv. %</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($referrals as $referral)
                            <tr>
                                <td>{{$referral->ReferralType->name}}</td>
                                 <td>{{$referral->name}}</td>
                                 <td>{{$referral->code}}</td>
                                 <td>{{$referral->alias}}</td>
                                 <td>{{$referral->ipdpercent}}</td>
                                 <td>{{$referral->opdpercent}}</td>
                                 <td>{{$referral->investigationpercent}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button wire:click="edit({{$referral->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                            <button wire:click="deleteTitle({{$referral->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{ $referrals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.master.referral.modal')
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


