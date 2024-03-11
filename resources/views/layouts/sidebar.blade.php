<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-default">
    <a href="{{route('home')}}" class="brand-link bg-white border-0">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="margin-left:0px;">
        <span class="brand-text font-weight-light khb" style="color: #0187c1 !important;">Capricorn</span>
    </a>

    <div class="sidebar os-theme-dark">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ activeMenu('home') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            {{__('lb.Home')}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('course.index') }}" @class(['menuActive'=> !!Request::is('course/*'),
                        'nav-link'])>
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            {{__('lb.Courses')}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('video.index') }}" class="nav-link {{ activeMenu('video.index') }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            {{__('lb.Videos')}}
                        </p>
                    </a>
                </li>

                {{--@check("trainner.index")--}}
                <li class="nav-item">
                    <a href="{{ route('document.index') }}" class="nav-link {{ activeMenu('document.index') }}">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            {{__('lb.Documents')}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('trainner.index') }}" class="nav-link {{ activeMenu('trainner.index') }}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>
                            {{__('lb.Trainner')}}
                        </p>
                    </a>
                </li>

                @check("settings")
                <li @class(['menu-open'=> !!Request::is('setting/*'), 'nav-item']) id="operation_setting_menu">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{__('lb.Settings')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setting.user.index') }}"
                                class="nav-link {{activeMenu('setting.user.index')}}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    {{__('lb.User')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.role.index') }}"
                                class="nav-link {{activeMenu('setting.role.index')}}">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>
                                    {{__('lb.Roles')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('setting.course_category.index') }}"
                                class="nav-link {{activeMenu('setting.course_category.index')}}">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>
                                    {{__('lb.Course Category')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('language.greeting_kh') }}"
                                class="nav-link {{activeMenu('language.greeting_kh')}} {{activeMenu('language.greeting_create_en')}}">
                                <i class="fas fa-angle-double-right nav-icon"></i>

                                <p>
                                    {{__('lb.Translation')}}
                                </p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="{{ route('setting.system.index') }}"
                                class="nav-link {{activeMenu('setting.system.index')}}">
                                <i class="nav-icon fas fa-angle-double-right"></i>
                                <p>
                                    ព័ត៌មានប្រព័ន្ធ (System)
                                </p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="{{ route('setting.system_module.index') }}"
                                class="nav-link {{activeMenu('setting.system_module.index')}}">
                                <i class="nav-icon fas fa-angle-double-right"></i>
                                <p>
                                    ម៉ូឌុល (Module)
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcheck
            </ul>
        </nav>
    </div>
</aside>
