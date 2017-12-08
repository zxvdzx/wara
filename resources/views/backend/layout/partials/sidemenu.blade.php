<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <!-- <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div> -->

        <!-- <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div> -->
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        @foreach ($menus as $menu)
            @if ($menu['is_parent'])
                @hasaccess((isset($menu['child_permissions']) ? $menu['child_permissions'] : []), true)
                    <li class="">
                        <a href="#" class="dropdown-toggle" title="{{ $menu['display_name'] }}">
                            <i class="fa fa-{{ $menu['icon'] }}"></i> 
                            <span class="menu-text">{{ $menu['display_name'] }}</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        @if (isset($menu['child']))
                            <ul class="submenu">
                                @foreach($menu['child'] as $child)
                                    @hasaccess($child['name'])
                                        <li{!! (url($child['href']) == Request::url() OR Request::is($child['href'].'/*')) ? ' class="active"' : '' !!}>
                                            <a href="{!! url($child['href']) !!}" title="{{ $child['display_name'] }}">
                                                <i class="menu-icon fa fa-{{ $child['icon'] }}"></i> {{ $child['display_name'] }}
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                    @endhasaccess
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endhasaccess
            @else
                @hasaccess($menu['name'])
                    <li {!! (url($menu['href']) == Request::url() OR Request::is($menu['href'].'/*')) ? ' class="active"' : '' !!}>
                        <a href="{!! url($menu['href']) !!}" title="{!! $menu['display_name'] !!}">
                            <i class="menu-icon fa fa-{{ $menu['icon'] }}"></i>
                            <span class="menu-text"> {{ $menu['display_name'] }} </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endhasaccess
            @endif
        @endforeach

    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>