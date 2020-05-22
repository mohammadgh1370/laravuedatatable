<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .9;background-color:white;">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{auth()->guard('admin')->user()->avatar}}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->guard('admin')->user()->full_name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}"
                           class="nav-link @routeis('dashboard') active @endrouteis">
                            <i class="nav-icon fas fa-tachometer-alt faa-float @routeis('admin.dashboard') animated @endrouteis"></i>
                            <p>
                                داشبورد
                            </p>
                        </a>
                    </li>
                    @canany(['admin_index','user_index'],'admin')
                        <li class="nav-item has-treeview @routeis('admin.*','user.*') menu-open @endrouteis">
                            <a href="#"
                               class="nav-link @routeis('admin.*','user.*') active @endrouteis">
                                <i class="nav-icon fas fa-users faa-tada @routeis('admin.*','user.*') animated @endrouteis"></i>
                                <p>
                                    کاربران
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin_index','admin')
                                    <li class="nav-item">
                                        <a href="{{route('admin.admin.index')}}"
                                           class="nav-link @routeis('admin.*') active @endrouteis">
                                            <i class="fas fa-user-secret nav-icon faa-horizontal @routeis('admin.*') animated @endrouteis"></i>
                                            <p>
                                                ادمین ها
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('user_index','admin')
                                    <li class="nav-item">
                                        <a href="{{route('admin.user.index')}}"
                                           class="nav-link @routeis('user.*') active @endrouteis">
                                            <i class="fas fa-user nav-icon faa-horizontal @routeis('user.*') animated @endrouteis"></i>
                                            <p>
                                                کاربران
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @role('admin','admin')
                    <li class="nav-item has-treeview @routeis('role.*','permission.*') menu-open @endrouteis">
                        <a href="#" class="nav-link @routeis('role.*','permission.*') active @endrouteis">
                            <i class="nav-icon fas fa-ban faa-tada @routeis('role.*','permission.*') animated @endrouteis"></i>
                            <p>
                                سطح دسترسی
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview @routeis('role.*') menu-open @endrouteis">
                                <a href="{{route('admin.role.index')}}"
                                   class="nav-link @routeis('role.*') active @endrouteis">
                                    <i class="fas fa-key nav-icon faa-horizontal @routeis('role.*') animated @endrouteis"></i>
                                    <p>
                                        نقش ها
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview @routeis('permission.*') menu-open @endrouteis">
                                <a href="{{route('admin.permission.index')}}"
                                   class="nav-link @routeis('permission.*') active @endrouteis">
                                    <i class="fas fa-unlock-alt nav-icon faa-horizontal @routeis('permission.*') animated @endrouteis"></i>
                                    <p>
                                        مجوزها
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endrole

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
