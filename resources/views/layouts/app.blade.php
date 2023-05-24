@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cruds</h1>
@stop
@section('contenido')
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @auth()
                @section('menusdfdfgs')
           
                    <!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/docentes') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> <p>Docentes</p></a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/paises') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> <p>Paises</p></a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/libros') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Libros</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/cars') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Cars</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ciudades') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Ciudades</a> 
                        </li>
       
                @endsection
                @endauth()

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

@stop   

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @vite(['resources/js/app.js'])
    @livewireStyles
    <script> console.log('Hi!'); </script>
    @livewireScripts
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
           addModal.hide();
           editModal.hide();
        })
    </script>
@stop




















