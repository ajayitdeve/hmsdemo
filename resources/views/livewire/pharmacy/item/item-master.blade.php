<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Item</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Item</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" wire:click="resetInput()" class="btn add-btn" data-toggle="modal"
                        data-target="#add"><i class="fa fa-plus"></i> Add Item </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table datatable table-striped table-bordered custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Code</th>
                                <th>HSN</th>
                                <th>IGST</th>
                                <th>CGST</th>
                                <th>SGST</th>
                                <th>Type</th>
                                <th>Group</th>
                                <th style="max-width: 100px">Generic</th>
                                <th>Form</th>
                                <th>Category</th>
                                <th>Specialization</th>
                                <th>Manufacturer</th>
                                <th>Purchase UOM</th>
                                <th>Issue UOM</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td><a wire:click="edit({{ $item->id }})" href="#" data-toggle="modal"
                                            data-target="#edit">{{ $item->description }}</a></th>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->hsn }}</td>
                                    <td>{{ $item->igst }}</td>
                                    <td>{{ $item->cgst }}</td>
                                    <td>{{ $item->sgst }}</td>
                                    <td>{{ $item?->type?->name }}</td>
                                    <td>{{ $item?->itemgroup?->name }}</td>
                                    <td class="wrap-text">{{ $item?->generic?->name }}</td>
                                    <td>{{ $item?->form?->name }}</td>
                                    <td>{{ $item?->category?->name }}</td>
                                    <td>{{ $item?->itemspecialization?->name }}</td>
                                    <td>{{ $item?->manufacturer?->name }}</td>
                                    <td>{{ $item?->purchaseuom?->name }}</td>
                                    <td>{{ $item?->issueuom?->name }}</td>


                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $item->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $item->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $items->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.pharmacy.item.modal')

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
