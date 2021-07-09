<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('title')

    @include('includes.admin.style')

    @stack('addon-style')
</head>

<body>
    <div id="app">

        @include('includes.admin.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>Desa Rindu Hati &copy; 2021  </p>
                    </div>
                    <div class="float-end">
                        <p>Dibuat dengan <span class="text-danger"><i class="bi bi-heart"></i></span> oleh Unil Ba'es</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include('includes.admin.script')

</body>

@stack('addon-script')

</html>
