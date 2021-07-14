@extends('layouts.user')

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Kamus Bahasa Daerah</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Kamus Bahasa Daerah</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Doctors Section ======= -->
    <section id="produk" class="produk" style="background-color: #fff">
        <div class="container">

            <h4 class="text-center mb-3">
                Kamus Bahasa Daerah Rejang
            </h4>

            <div class="form-group row">
                <div class="col-md-6 col-lg-6 col-sm-6">
                    <label for="kata_kunci" class="col-form-label">Kata Kunci</label>
                    <input type="text" class="form-control col-10" id="kata_kunci" placeholder="Masukkan Kata Kunci ( bahasa indonesia )">
                    <a href="{{ route('kamus-download') }}" class="btn btn-primary mt-2" target="_blank">Download E-book Kamus</a>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6">
                    <label for="kata_kunci" class="col-form-label">Hasil Terjemahan <span><sup  class="text-danger" id="pesan"></sup></span></label>
                    <ul id="menu"></ul>
                </div>
            </div>
        </div>
    </section><!-- End Doctors Section -->
</main><!-- End #main -->
@endsection

@push('addon-script')
    <script>
        $("#kata_kunci").on("keyup", function() {
            var kata_kunci = $('#kata_kunci').val();
            if(kata_kunci.length == 0){
                $('#menu').empty();
            }else {
                $.ajax({
                    url: `{{ route('terjemahan.api') }}`,
                    type: 'get',
                    data: {
                        'kata_kunci' : kata_kunci
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            if(response.hasil == 'kosong'){
                                $('#menu').empty();
                                document.getElementById('pesan').innerHTML = 'Terjemahan tidak ditemukan :(.. masukkan kata kunci kembali';
                            }else {
                                function createMenuItem(name) {
                                    let li = document.createElement('li');
                                    li.textContent = name;
                                    return li;
                                }
                                // get the ul#menu
                                const menu = document.querySelector('#menu');
                                $('#menu').empty();
                                document.getElementById('pesan').innerHTML = '';
                                // add menu item
                                $.each(response, function (kata_kunci, terjemahan) {
                                    menu.appendChild(createMenuItem(kata_kunci + ' bahasa rejangnya ' + terjemahan));
                                });
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
