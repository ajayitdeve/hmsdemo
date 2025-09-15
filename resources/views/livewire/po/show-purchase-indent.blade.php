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
<div>
<div class="card p-2">
    <h5 class="card-title">Purchase Intent</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3"> Indent Code : {{$purchaseIndent->code}}</div>
            <div class="col-md-3">Stock Point : {{$purchaseIndent->stockpoint->name}}</div>
            <div class="col-md-3">Vendor : {{$purchaseIndent->vendor->name}}</div>
            <div class="col-md-3">Type : {{$purchaseIndent->type->name}}</div>
        </div>
        <div class="row pt-2">
            <div class="col-md-3"> Request Date : {{$purchaseIndent->request_date}} </div>
            <div class="col-md-3"> Status : {{$purchaseIndent->status==0?'Pending':'Approved'}}</div>
            <div class="col-md-3"> Remarks : {{$purchaseIndent->remarks}}</div>
    
        </div>
    
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
           <table class="table table-striped custom-table mb-0">
               
												<thead>
													<tr>
														<th>Item Code</th>
                                                        <th>Item Description</th>
														<th>Qunatity</th>
														
													</tr>
												</thead>
												<tbody>
                                                    @foreach ($purchaseIndent->indentitems as $purchaseIndentItem )
                                                        <tr>
                                                            <td>{{$purchaseIndentItem->item->code}}</td>
                                                            <td>{{$purchaseIndentItem->item->description}}</td>
                                                            <td>{{$purchaseIndentItem->quantity}}</td>
                                                        </tr>
                                                    @endforeach
												</tbody>
            </table>
            <div>
                {{-- {{ $grns->links() }} --}}
            </div>
        </div>
    </div>
</div>



