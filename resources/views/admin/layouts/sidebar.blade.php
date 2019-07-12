<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">


                <li class="nav-small-cap">الإعدادات</li>
                <li><a class="waves-effect waves-dark" href="{{ action('Admin\SettingController@index') }}"
                       aria-expanded="false"><i
                                class="mdi mdi-settings"></i>
                        <span class="hide-menu">
                        إعدادات الموقع
                    </span></a>
                </li>

                <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                class="mdi mdi-account-multiple"></i>
                        <span class="hide-menu">
                        المستخدمين
                    </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ action('Admin\UserController@index') }}">الكل </a></li>
                        <li><a href="{{ action('Admin\UserController@create') }}">جديد </a></li>
                    </ul>
                </li>

                <li class="nav-devider"></li>

                <li class="nav-small-cap">إدارة محتوى الموقع</li>

                @include('admin.layouts.custom_actions')

                <li><a class="waves-effect waves-dark" href="/admin/translations" aria-expanded="false"><i
                                class="mdi mdi-google-translate"></i>
                        <span class="hide-menu">
                        الكلمات الثابتة
                        </span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
