<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=na, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>@yield('title')</title>

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <script src="{{ mix('js/app.js') }}" defer></script>

            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            @stack('styles')
            <script scr="{{mix('js/app.js')}}" defer></script>

            <style></style>
        </head>

        <body>
            <div class="d-flex flex-column h-screen justify-content-between">
                <header>
                    <nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm" >
                        <a class="navbar-brand" href="http://190.7.153.162:84/biomedica/public/">
                            <img class="img-fluid mb-0" src="/biomedica/storage/app/public/img/BIOMEDICALMANAGER.PNG" alt="">
                        </a>

                        <button class="navbar-toggler" type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}"
                            ><span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class= "nav-link {{ setActive('home') }}"
                                    href="{{ route('home') }}">Home
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class= "nav-link {{ setActive('sense') }}"
                                    href="{{ route('sense') }}">{{ __('Sensor') }}
                                    </a>
                                </li>

                            </ul>

                        </div>

                    </nav>
                </header>
                <main class="py-4">
                    @yield('content')
                </main>
                <footer class="bg-white text-center text-black-50 py shadow">
                    {{ config('app.name') }} | copyright @ {{ date('Y-m-d') }}
                </footer>

            </div>
            @stack('scripts')
        </body>
</html>
