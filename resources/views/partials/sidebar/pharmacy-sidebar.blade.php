<div id="sidebar-menu" class="sidebar-menu">
    <ul>

        <li class="menu-title">
            <span>Central Pharmacy</span>
        </li>
        <li class="submenu">
            <a href="#"><i class="la la-capsules"></i> <span> Pharmacy Master</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a class="@if (request()->routeIs('admin.pharmacy.type-master')) active @endif"
                        href="{{ route('admin.pharmacy.type-master') }}">Type Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.stock-point-master')) active @endif"
                        href="{{ route('admin.pharmacy.stock-point-master') }}">Stock Point Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-group-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-group-master') }}">Item Group Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.generic-master')) active @endif"
                        href="{{ route('admin.pharmacy.generic-master') }}">Generic Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.form-master')) active @endif"
                        href="{{ route('admin.pharmacy.form-master') }}">Form (UOM) Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.category-master')) active @endif"
                        href="{{ route('admin.pharmacy.category-master') }}">Category Master</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-specialization-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-specialization-master') }}">Specialization</a>
                </li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.manufacturer-master')) active @endif"
                        href="{{ route('admin.pharmacy.manufacturer-master') }}">Manufacturer</a></li>
                <li><a class="@if (request()->routeIs('admin.pharmacy.item-master')) active @endif"
                        href="{{ route('admin.pharmacy.item-master') }}">Add Item</a></li>

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
        <li class="submenu">
            <a href="#"><i class="la la-shopping-cart"></i><span>Purchase & Issue</span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">

                <li><a class="@if (request()->routeIs('admin.pharmacy.vendor-registration')) active @endif"
                        href="{{ route('admin.pharmacy.vendor-registration') }}">Add Vendor</a></li>
                        <li><a class="@if (request()->routeIs('admin.mrq.list-mrq')) active @endif" href="{{route('admin.mrq.list-mrq')}}">All MRQ</a></li>
                <li><a class="@if (request()->routeIs('admin.po.create-purchase-indent')) active @endif"
                        href="{{ route('admin.po.create-purchase-indent') }}">Purchase Indent</a></li>
                <li><a class="@if (request()->routeIs('admin.po.list-purchase-order')) active @endif"
                        href="{{ route('admin.po.list-purchase-order') }}">Purchase Order</a></li>
                <li><a class="@if (request()->routeIs('admin.grn.create-grn')) active @endif"
                        href="{{ route('admin.grn.create-grn') }}">Goods Receipt Notes</a></li>
                <li><a class="@if (request()->routeIs('admin.gin.create-gin')) active @endif"
                        href="{{ route('admin.gin.create-gin') }}">GIN</a></li>
                <li><a class="@if (request()->routeIs('admin.inventory.index')) active @endif"
                        href="{{ route('admin.inventory.index') }}">Inventory</a></li>
                        <li><a class="@if (request()->routeIs('admin.pharmacy.medicine-purchase-report')) active @endif"
                            href="{{ route('admin.pharmacy.medicine-purchase-report') }}">Purchase Report</a></li>
                            <li><a class="@if (request()->routeIs('admin.pharmacy.pharmacy-cancle-receipt')) active @endif"
                                href="{{ route('admin.pharmacy.pharmacy-cancle-receipt') }}">All Cancle Receipts</a></li>
            </ul>
        </li>
    </ul>
</div>
