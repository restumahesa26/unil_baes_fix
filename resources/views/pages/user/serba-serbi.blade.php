@extends('layouts.user')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Serba Serbi Desa Rindu Hati</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Serba Serbi Desa Rindu Hati</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="serba-serba">
        <div class="container">
            {!! $serbas->serba_serbi !!}
        </div>
    </section>
@endsection
