<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (Auth::user())
                    <li class="sidebar-item user-profile">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            {{-- <img src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/profile.png"
                            alt="user"> --}}
                            <span class="round text-white d-inline-block text-center rounded-circle bg-success">
                                {{ substr(Auth::user()->name, 0, 1) }} {{ substr(Auth::user()->last_name, 0, 1) }}
                            </span>

                            <span class="hide-menu">{{ Auth::user()->name }}
                                {{ Auth::user()->last_name }}</span>
                        </a>

                        <ul aria-expanded="false" class="collapse  first-level">
                            {{-- <li class="sidebar-item">
                                <change_themme></change_themme>
                            </li> --}}
                            <li @click="menu = 5" class="sidebar-item">
                                <a href="#" class="sidebar-link p-0">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu">Perfil </span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="sidebar-link p-0" href="route('logout')"
                                        onclick="event.preventDefault();
                                this.closest('form').submit();"
                                        aria-expanded="false">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Cerrar sesion </span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                {{--  --}}
                @if (Auth::user())
                    <li @click="menu = 0" class="sidebar-item"> <a href="#"
                            class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i
                                data-feather="clock" class="feather-icon"></i>
                            <span class="hide-menu">Check in </span></a>
                    </li>
                    <li @click="menu = 1" class="sidebar-item"> <a href="#"
                            class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                            <i data-feather="users" class="feather-icon"></i>
                            <span class="hide-menu">Clientes</span></a>
                    </li>
                    <li @click="menu = 2" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="dollar-sign" class="feather-icon"></i>
                            <span class="hide-menu">Pagos</span></a>
                    </li>
                    <li @click="menu = 3" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="clipboard" class="feather-icon"></i>
                            <span class="hide-menu">Asistencias</span></a>
                    </li>
                    <li @click="menu = 4" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="award" class="feather-icon"></i>
                            <span class="hide-menu">Membresias</span></a>
                    </li>
                    <li @click="menu = 6" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="user" class="feather-icon"></i>
                            <span class="hide-menu">Usuarios</span></a>
                    </li>
                    <li @click="menu = 7" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="box" class="feather-icon"></i>
                            <span class="hide-menu">Productos</span></a>
                    </li>
                    <li @click="menu = 8" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="shopping-cart" class="feather-icon"></i>
                            <span class="hide-menu">Ventas</span></a>
                    </li>
                    <li @click="menu = 9" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="shopping-bag" class="feather-icon"></i>
                            <span class="hide-menu">Compras</span></a>
                    </li>
                    <li @click="menu = 10" class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i data-feather="package" class="feather-icon"></i>
                            <span class="hide-menu">Almacen</span></a>
                    </li>
                    <li class="sidebar-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="route('logout')"
                                onclick="event.preventDefault();
                         this.closest('form').submit();"
                                aria-expanded="false">
                                <i data-feather="log-out" class="feather-icon"></i>
                                <span class="hide-menu"> Cerrar sesion</span>
                            </a>
                        </form>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
