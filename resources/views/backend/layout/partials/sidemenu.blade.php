<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li><div class="left-bg"></div></li>
            <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>
                <p class="animated fadeInRight">Sat,October 1st 2029</p>
            </li>
            <li class="active ripple"><a href="{{ route('admin.dashboard') }}"><span class="fa-home fa"></span>Dashboard</a></li>
            <li class="ripple">
                <a class="tree-toggle nav-header"><span class="fa fa-envelope-o"></span> Exercise <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ route('admin.category') }}">Category</a></li>
                    <li><a href="">Question</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>