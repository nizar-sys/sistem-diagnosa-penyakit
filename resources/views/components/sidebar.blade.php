@if (Auth::check())
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon bg-white">
                <img
                    src="{{ asset(setting('logo') ? '/storage/' . setting('logo') : 'https://rskasihibu.com/wp-content/uploads/2022/12/LOGO-RSKI-SURAKARTA-Transparan.png') }}">
            </div>
            <div class="sidebar-brand-text mx-3">Sistem Pakar Diagnosa Tuberkulosis</div>
        </a>
        <hr class="sidebar-divider my-0">

        @can('dashboard')
            <x-nav-link text="Dashboard" icon="th" url="{{ route('admin.dashboard') }}"
                active="{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}" />

            {{-- <hr class="sidebar-divider mt-3 mb-0"> --}}
        @endcan

        @role('Perawat')
            @can('diagnosa')
                <x-nav-link text="Diagnosa" icon="stethoscope" url="{{ route('admin.diagnosa') }}"
                    active="{{ request()->routeIs('admin.diagnosa') ? ' active' : '' }}" />
            @endcan
        @endrole

        @role('Rekam Medis')
            @can('riwayat-list')
                <x-nav-link text="Riwayat Diagnosa " icon="notes-medical" url="{{ route('admin.riwayat.daftar') }}"
                    active="{{ request()->routeIs('admin.riwayat.daftar') ? ' active' : '' }}" />
            @endcan
        @endrole

        @role('Perawat')
            @can('riwayat-list')
                <x-nav-link text="Riwayat Diagnosa" icon="notes-medical" url="{{ route('admin.riwayat.daftar') }}"
                    active="{{ request()->routeIs('admin.riwayat.daftar') ? ' active' : '' }}" />
            @endcan
        @endrole

        {{-- @role('Perawat')
        <li class="nav-item{{ request()->routeIs('admin.print') ? ' active' : '' }} bg-primary rounded-pill mt-4">
            <a class="nav-link bg-primary rounded-pill" href="{{ route('admin.print') }}" target="_blank">
                <i class="fas fa-fw fa-file text-white"></i>
                <span class="text-white">Print Kartu Pasien</span>
            </a>
        </li>
    @endrole --}}

        @can('member-list')
            <hr class="sidebar-divider mt-3 mb-0">

            <x-nav-link text="Daftar User" icon="users" url="{{ route('admin.member') }}"
                active="{{ request()->routeIs('admin.member') ? ' active' : '' }}" />
        @endcan


        @can('gejala-list')
            <x-nav-link text="Daftar Gejala" icon="th-list" url="{{ route('admin.gejala') }}"
                active="{{ request()->routeIs('admin.gejala') ? ' active' : '' }}" />
        @endcan

        @can('rules-list')
            <x-nav-link text="Nilai Gejala" icon="briefcase-medical" url="{{ route('admin.rules', 1) }}"
                active="{{ request()->routeIs('admin.rules') ? ' active' : '' }}" />
        @endcan

        <hr class="sidebar-divider mb-0">

    </ul>
@else
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon bg-white">
                <img
                    src="{{ asset(setting('logo') ? '/storage/' . setting('logo') : 'https://rskasihibu.com/wp-content/uploads/2022/12/LOGO-RSKI-SURAKARTA-Transparan.png') }}">
            </div>
            <div class="sidebar-brand-text mx-3">Sistem Pakar Diagnosa Tuberkulosis</div>
        </a>
        <hr class="sidebar-divider my-0">

        <x-nav-link text="Home" icon="th" url="{{ route('diagnosa') }}"
            active="{{ request()->routeIs('diagnosa') ? ' active' : '' }}" />
    </ul>
@endif
