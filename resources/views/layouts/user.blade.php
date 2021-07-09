<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>RinduHati</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @stack('addon-style')

    @include('includes.user.style')

    <!-- =======================================================
  * Template Name: Medilab - v2.1.1
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    @include('includes.user.navbar')


    @yield('content')

    <div id="modal-logout" class="modal">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="appointment-btn">Keluar</a>
        </form>
        <a href="#" rel="modal:close">Close</a>
    </div>

    @include('includes.user.footer')

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <a href="https://api.whatsapp.com/send?phone=628117482512" class="chat-whatsapp" target="_blank"><i class="icofont-whatsapp"></i></a>
        @if (Auth::user())
        <a href="#" class="kritik-saran" data-toggle="modal" data-target=".bd-example-modal-lg"><p>Kritik & Saran</p></a>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="transition: all .3s ease-in-out;">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Kritik & Saran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kritik-saran.store') }}" method="POST">
                <div class="modal-body">
                        @csrf
                        <div class="form-group text-center">
                            <label for="review" style="font-size: 22px;">Kritik & Saran</label>
                            <textarea class="form-control" name="kritik_saran" rows="3" id="review"
                                placeholder="Masukkan Kritik & Saran"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
                </div>
                </div>
            </div>
        </div>
        @endif

    @include('includes.user.script')

</body>

@stack('addon-script')

</html>
