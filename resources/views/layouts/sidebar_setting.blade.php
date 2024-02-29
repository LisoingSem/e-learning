<aside class="main-sidebar elevation-4 sidebar-light-lightblue">
    <a href="{{route('home')}}" class="brand-link tpg_bg" >
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="margin-left:0px;">
        <span class="brand-text font-weight-light text-white">AHMS</span>
    </a>

    <div class="sidebar os-theme-dark">
        <nav class="mt-2">
            <ul class="nav nav-flat nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('setting.dashboard') }}" class="nav-link ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            ទំព័រដើម
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting.user.index') }}" class="nav-link {{activeMenu('setting.user.index')}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            អ្នកប្រើប្រាស់
                        </p>
                    </a>
                </li>
                @check('setting.role.index')
                <li class="nav-item">
                    <a href="{{ route('setting.role.index') }}" class="nav-link {{activeMenu('setting.role.index')}}">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            តួនាទី និងសិទ្ធ
                        </p>
                    </a>
                </li>
                @endcheck
                @check('setting.system.index')
                <li class="nav-item">
                    <a href="{{ route('setting.system.index') }}" class="nav-link {{activeMenu('setting.system.index')}}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            ព័ត៌មានប្រព័ន្ធ (System)
                        </p>
                    </a>
                </li>
                @endcheck
                @check('setting.system_module.index')
                <li class="nav-item">
                    <a href="{{ route('setting.system_module.index') }}" class="nav-link {{activeMenu('setting.system_module.index')}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            ម៉ូឌុល (Module)
                        </p>
                    </a>
                </li>
                @endcheck
                <li class="nav-item" id="operation_setting_menu">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-medical-alt"></i>
                        <p>
                        Operation Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('setting.organization.index')}}" class="nav-link {{activeMenu('setting.organization.index')}} {{activeMenu('setting.position.index')}} {{activeMenu('setting.section.index')}} {{activeMenu('setting.department.index')}}" >
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>អង្គភាព/សាខា (Org)</p>
                            </a>
                        </li>
                    </ul>
                </li>
               
            </ul>
        </nav>
    </div>
</aside>