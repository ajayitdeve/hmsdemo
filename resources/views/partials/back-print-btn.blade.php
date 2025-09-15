<style>
    .noPrint {
        width: {{ $width ?? '80%' }};
        display: flex;
        justify-content: space-between;
        margin: 10px auto;
    }

    @media print {
        .noPrint {
            display: none;
        }
    }
</style>
<div class="noPrint">
    <a href="{{ $back_url }}">
        <img style="text-align:center; width:30px;" src="{{ asset('assets/img/back.png') }}" />
    </a>

    <a href="javascript:void(0);" onClick="window.print()">
        <img style="text-align:center; width:30px;" src="{{ asset('assets/img/print.png') }}" />
    </a>
</div>
