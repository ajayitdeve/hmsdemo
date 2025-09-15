<form>
    <div class="row">
        <div class="col-md4">

        </div>
        <div class="col-md4">
            
        </div>
        <div class="col-md4">
            
        </div>
    </div>
    <div class="form-group">
        <label for="state" >State</label>
        <select wire:model="selectedState" name="state" wire:change="stateChanged" class="form-control">
            <option value="-1">Select State</option>
            @foreach ($states as $state )
                <option value="{{$state->id}}" @if($state->name=='Bihar') selected @endif>{{$state->name}}</option>
            @endforeach
        </select>
    </div>
    <div wire:loading>
loading..
    </div>
    <div class="form-group">
        <label for="state">City</label>
        <select class="form-control">
            <option value="-1">Select City</option>
          
            @foreach ($cities as $city )
                <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
          
        </select>
    </div>
</form>