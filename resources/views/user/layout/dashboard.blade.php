<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') - {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- AdminLTE CSS if needed -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">
    {{-- Header --}}
    @include('user.layout.header')

    {{-- Sidebar --}}
    @include('user.layout.sidebar')

    {{-- Main Content --}}
    <main class="app-main">
        <div class="app-content-header py-3 px-3">
            <h3 class="mb-0">@yield('page-title', 'Dashboard')</h3>
            <ol class="breadcrumb float-end">
                @yield('breadcrumb')
            </ol>
        </div>

        <div class="app-content px-3">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>

    {{-- Footer --}}
    @include('user.layout.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
@stack('scripts')
</body>
</html>
