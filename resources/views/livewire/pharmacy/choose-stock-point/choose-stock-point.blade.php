<div>
    @include('partials.alert-message')

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="nurse-station">Stock Point <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="stock_point" wire:model="stock_point"
                                data-placeholder="Select Stock Point">
                                <option value=""></option>
                                @foreach ($stock_points as $stock_point)
                                    <option value="{{ $stock_point->id }}">{{ $stock_point->name }}</option>
                                @endforeach
                            </select>

                            @error('stock_point')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });
        </script>
    @endpush
</div>
