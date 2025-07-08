<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <img src="{{asset('/images/imagenes/la_victoria.png')}}" alt="Tu Logo" style="width: 150px; height: auto; display: block; margin: 0 auto;">
                </a>
            </li>
            <br>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            {{-- <li class="nav-item">
                <a class="d-flex align-items-center" href="{{route('fiscalizador.index')}}"><i data-feather='camera'></i><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Fiscalizador</span></a>
            </li> --}}



            <li class="nav-item">
                {{-- <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('administrado.multa.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Roles">Multas</span></a></li>
                </ul>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('administrado.multa.historial') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Roles">Historial</span></a></li>
                </ul> --}}
            </li>

            <li class="nav-item" @if(!auth()->user()->can('ver-usuario') && !auth()->user()->can('ver-rol') && !auth()->user()->can('ver-modulo')) style="display: none;" @endif>
                <a class="d-flex align-items-center" href="#"><i data-feather='lock'></i><span class="menu-title text-truncate" data-i18n="eCommerce">Administrador</span></a>
                <ul class="menu-content">
                    @can('ver-usuario')
                        <li>
                            <a class="d-flex align-items-center" href="{{ url('/usuarios') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Usuario</span></a>
                        </li>
                    @endcan
                    @can('ver-rol')
                        <li>
                            <a class="d-flex align-items-center" href="{{ url('/roles') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Details">Roles</span></a>
                        </li>
                    @endcan
                    @can('ver-modulo')
                        <li>
                            <a class="d-flex align-items-center" href="{{ url('/modules') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Modulo</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#"><i data-feather='file-text'></i><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Generador</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ url('/generador') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Roles">QR</span></a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
