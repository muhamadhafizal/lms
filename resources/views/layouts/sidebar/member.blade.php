<li class="">
    <a class="load-spinner" href="{{ route('member.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>
<div class="seperator">Main</div>
    <li class="">
        <a class="load-spinner" href="">
            <div class="sidebar-icon">
                <i class='bx bx-sitemap'></i>
            </div>
            Book
        </a>
    </li>
    <li class="{{ active_check('member/borrowing', true) }}">
        <a class="load-spinner" href="{{ route('member.borrowing.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-buildings'></i>
            </div>
            Borrowing
        </a>
    </li>

