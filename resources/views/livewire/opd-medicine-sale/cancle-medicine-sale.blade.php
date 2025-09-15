<div>
    @push('page-css')
        <style>
            .form-control {
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
        <form wire:submit.prevent='cancle'>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2>Cancle Medicine Sale</h2>
                    </div>

                </div>
            </div>


            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="text" class="form-control" wire:model="bill_no"
                                        wire:change="billNoChanged" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Patient's Name</label>
                                            <input type="text" class="form-control" readonly wire:model="name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">UMR</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="registration_no">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="address">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

     <div class="row mb-5">
        <div class="col-md-12">
            <div class="table-responsive">
               <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>


                           <th>Id</th>
                            <th>Item Id</th>
                            <th>Batch No</th>
                            <th>Qunatity</th>
                            <th>Unit Sale Price</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Taxable Amount</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($opdMedicineTransacrions as $opdMedicineTransacrion)
                             <tr>
                                <td>{{$opdMedicineTransacrion->id}}</td>
                                <td>{{$opdMedicineTransacrion->item->description}}</td>
                                <td>{{$opdMedicineTransacrion->batch_no}}</td>
                                <td>{{$opdMedicineTransacrion->quantity}}</td>
                                <td>{{$opdMedicineTransacrion->unit_sale_price}}</td>
                                <td>{{$opdMedicineTransacrion->amount}}</td>
                                <td>{{$opdMedicineTransacrion->discount}}</td>
                                <td>{{$opdMedicineTransacrion->taxable_amount}}</td>
                                <td>{{$opdMedicineTransacrion->total}}</td>


                             </tr>
                             @endforeach
                             <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>{{ $opdPatientReceipt!=null?$opdPatientReceipt->opdmedicinetransactions->sum('total'):null}}</strong></td>


                            </tr>
                    </tbody>
                </table>
                <div>

                </div>
            </div>
        </div>

            <div class="col-md-12 text-center">
                @if($opdPatientReceipt!=null)
                <button type="submit"  class="btn btn-primary  "  > Cancle</button>
                @endif
            </div>


    </div>






        </form>







</div>
