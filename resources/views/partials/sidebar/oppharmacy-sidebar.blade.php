<div id="sidebar-menu" class="sidebar-menu">
    <ul>

        <li class="menu-title">
            <span>{{ strtoupper(Auth::user()->roles->pluck('name')[0]) }}</span>
        </li>

        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> MRQ </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="{{$route=='admin.mrq.list-store-mrq' ?'active':''}}" href="{{route('admin.mrq.list-store-mrq')}}">All MRQ</a></li>
                <li><a class="{{$route=='admin.mrq.create-mrq' ?'active':''}}" href="{{route('admin.mrq.create-mrq')}}">Create MRQ</a></li>

            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Internal Transfer (GIN) </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="{{$route=='admin.pharmacy.pharmacy-internal-transfer-gin' ?'active':''}}" href="{{route('admin.pharmacy.pharmacy-internal-transfer-gin')}}">ALL GIN</a></li>


            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Scrap Transfer </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="{{$route=='admin.pharmacy.scrap.scrap-transfer' ?'active':''}}" href="{{route('admin.pharmacy.scrap.scrap-transfer')}}">Scrap Transfer</a></li>
                <li><a class="{{$route=='admin.pharmacy.scrap.list-scrap' ?'active':''}}" href="{{route('admin.pharmacy.scrap.list-scrap')}}">Scrap Transfer List</a></li>


            </ul>
        </li>

        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Inventory </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="{{$route=='admin.sale-store.new-gin' ?'active':''}}" href="{{route('admin.sale-store.new-gin')}}">New Issued Iteams </a></li>
                <li><a class="{{$route=='admin.sale-store.list-sale-store-by-stock-point' ?'active':''}}" href="{{route('admin.sale-store.list-sale-store-by-stock-point')}}">All Items</a></li>

            </ul>
        </li>

        <li class="{{$route=='admin.opd-medicine-sale.sale' ?'active':''}}">
            <a href="{{route('admin.opd-medicine-sale.sale')}}"><i class="la la-capsules"></i> <span>Medicine Sale</span></a>
        </li>

        <li class="{{$route=='admin.pharmacy.cancle-medicine-sale' ?'active':''}}">
            <a href="{{route('admin.pharmacy.cancle-medicine-sale')}}"><i class="fa fa-close"></i> <span>Cancle Medicine Sale</span></a>
        </li>
        <li><a class="@if (request()->routeIs('admin.pharmacy.pharmacy-cancle-receipt')) active @endif"
            href="{{ route('admin.pharmacy.pharmacy-cancle-receipt') }}"><i class="fa fa-close"></i><span>All Cancle Receipts</span></a></li>
        <li class="{{$route=='admin.pharmacy.pharmacy-return' ?'active':''}}">
            <a href="{{route('admin.pharmacy.pharmacy-return')}}"><i class="fa fa-undo"></i> <span>Return  Medicine Sale</span></a>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-dashboard"></i> <span> Receipt & Transaction </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="{{$route=='' ?'active':''}}" href="{{route('admin.mrq.list-mrq')}}">Receipts </a></li>
                <li><a class="{{$route=='' ?'active':''}}" href="{{route('admin.mrq.create-mrq')}}">Transactions</a></li>

            </ul>
        </li>

        <li class="submenu">
            <a href="#"><i class="la la-shopping-basket"></i> <span> Bin</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.pharmacy.bin-group-master')) active @endif"
                        href="{{ route('admin.pharmacy.bin-group-master') }}">Bin Group</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.bin-master')) active @endif"
                        href="{{ route('admin.pharmacy.bin-master') }}">Bin</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-group-master')) active @endif"
                        href="{{ route('admin.pharmacy.bin-item') }}">Add Item to Bin</a></li>
            </ul>
        </li>

    </ul>
</div>
