<div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="nurse-station">Nurse Station</label>
                            <select class="form-control select2" name="nurse_station" wire:model="nurse_station"
                                data-placeholder="Select Nurse Station">
                                <option value=""></option>
                                @foreach ($nurse_stations as $nurse_station)
                                    <option value="{{ $nurse_station->id }}">{{ $nurse_station->name }}</option>
                                @endforeach
                            </select>

                            @error('nurse_station')
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
