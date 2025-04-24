<li class="">
    <a class="load-spinner" href="{{ route('member.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>
<div class="seperator">Main</div>
    <li class="{{ active_check('member.book.index', true) }}">
        <a class="load-spinner" href="{{ route('member.book.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-sitemap'></i>
            </div>
            Book
        </a>
    </li>
    <li class="{{ active_check('superadmin/company', true) }}">
        <a class="load-spinner" href="{{}}">
            <div class="sidebar-icon">
                <i class='bx bx-buildings'></i>
            </div>
            Borrowing
        </a>
    </li>

