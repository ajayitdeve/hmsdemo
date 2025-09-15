@if ($expired_medicine_list->count())
    <div class="alert alert-danger alert-dismissible">
        <h4 class="alert-heading">Warning medicine expiry!</h4>

        @foreach ($expired_medicine_list as $expired_medicine)
            <hr class="my-2">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ $expired_medicine?->item?->description }}</span>
                <span>{{ $expired_medicine?->exd }}</span>
            </div>
        @endforeach

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
