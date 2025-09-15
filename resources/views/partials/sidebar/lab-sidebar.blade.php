<div id="sidebar-menu" class="sidebar-menu">
    <ul>


        {{-- pathology --}}
        <li class="submenu">
            <a href="#"><i class="fa fa-flask"></i><span>Central Lab </span> <span
                    class="menu-arrow"></span></a>
            <ul style="display: none;">


                <li><a class="@if (request()->routeIs('admin.sample-collection')) active @endif"
                    href="{{ route('admin.sample-collection') }}">Sample Collection</a></li>
                    <li><a class="@if (request()->routeIs('admin.diagnostic-result-entry')) active @endif"
                        href="{{ route('admin.diagnostic-result-entry') }}">Diagnostic Result Entry</a></li>

                        <li><a class="@if (request()->routeIs('admin.diagnostic-result-list')) active @endif"
                        href="{{ route('admin.diagnostic-result-list') }}">Diagnostic Result List</a></li>


            </ul>
        </li>

    </ul>
</div>
