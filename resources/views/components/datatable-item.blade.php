<div class="text-center">
    {{ucfirst($columnName)}}
    @if($sortColumn!==$columnName)
    <!-- up and down -->
    <x-heroicon-o-chevron-up-down style="height:25px;"/>
    @elseif($sortDirection==='ASC')
    <!-- down -->
    <x-heroicon-o-chevron-down style="height:15px;"/>
    @elseif($sortDirection==='DESC')
    <!-- up -->
    <x-heroicon-o-chevron-up style="height:15px;"/>
    @endif
</div>