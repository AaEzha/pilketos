@extends('siswa_layouts.SiswaHeader')
@section('konten')
    {{-- Form Login --}}

    @if (Auth::guard('siswa')->check())


        <section>
            <div class="container py-5 mt-5">
                <h1 class="text-center">Daftar Calon Ketua OSIS</h1>
                <div class="row ">
                    @if (!$calon->isEmpty())


                        @foreach ($calon as $kandidat)


                            <div class="col-lg-4 col-sm-4 col-md-4 d-flex justify-content-center ">

                                <input type="hidden" name="candidat_id" class="candidat_id-{{ $kandidat->id }}"
                                    value="{{ $kandidat->id }}">

                                <div class="card mb-3 border border-0" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ url($kandidat->gambar) }}" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text text-center ">{{ $kandidat->nama }}</p>
                                        <p class="card-text text-center ">{{ $kandidat->kelas }} -
                                            {{ $kandidat->jurusan }}
                                        </p>




                                        <button type="button" class="d-inline p-2 bg-primary text-white border-0 btn-visi"
                                            style="width: 50%" data-toggle="modal"
                                            data-target="#myModal{{ $kandidat->id }}">Visi
                                            Misi</button>

                                            <button data-key="{{ $kandidat->id }}"
                                                class="d-inline p-2 bg-dark text-white border-0 btn-votes " value="1"  name="votes"
                                                >Pilih<i class="fas fa-check ml-2"></i></button>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center col-sm-12 mt-5 ">
                                <img src="{{ asset('assets/img/nodata.png') }}" alt="" class="w-25 ">

                            </div>

                        </div>
                        <p class="text-center text-dark font-weight-bold">Tidak ada Calon Osis</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- Modal Visi --}}
        <!-- Modal -->
        @foreach ($calon as $calonModal)


            <div class="modal fade" id="myModal{{ $calonModal->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div>
                                <h4>Visi</h4>
                                <p>{{ $calonModal->visi }}</p>
                            </div>
                            <div>
                                <h4>Misi</h4>
                                <p>{{ $calonModal->misi }}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @else
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-8 col-md-8 ">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class=" img-fluid mt-5 ">
                    </div>
                    <div class="col-lg-8 mt-5 col-md-4">
                        <div class="card">
                            <article class="card-body">
                                <h4 class="card-title text-center mb-4 mt-1">Silahkan login sebelum memilih ketua osis</h4>
                                <hr>


                                <form class="form-login" id="form-login">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input name="nisn" id="nisn" class="form-control" placeholder="Masukan NISN"
                                                type="number">
                                        </div> <!-- input-group.// -->
                                    </div> <!-- form-group// -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>

                                            </div>
                                            <input class="form-control" id="password" placeholder="******" type="password"
                                                name="password">



                                        </div> <!-- input-group.// -->
                                        <input type="checkbox" id="show-password" class="mr-2 mt-2">Lihat password
                                    </div> <!-- form-group// -->

                                    <div class="form-group">
                                        <button type="button" style="background-color: #0096c7"
                                            class="btn btn-primary btn-block" id="btn-login">Masuk</button>
                                    </div> <!-- form-group// -->

                                </form>
                            </article>
                        </div> <!-- card.// -->
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@push('custom-javascripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

            // get id button
            $('#btn-login').click(function() {
                console.log('berhasil');

                //get id from input
                var nisn = $('#nisn').val();
                var password = $("#password").val();
                var token = $("meta[name='csrf-token']").attr("content");

                // validasi

                if (nisn.length == "") {

                    swal({

                        text: "NISN tidak boleh kosong",
                        icon: "warning",

                    });

                } else if (password.length == "") {

                    swal({

                        text: "Password tidak boleh kosong",
                        icon: "warning",

                    });

                } else {
                    $.ajax({
                        url: "{{ route('siswa.login') }}",
                        type: "POST",
                        dataType: "JSON",
                        cache: false,
                        data: {
                            "nisn": nisn,
                            "password": password,
                            "_token": token
                        },

                        // success
                        success: function(response) {
                            if (response.success) {
                                swal({
                                    icon: "success",
                                    title: "Login berhasil",
                                    text: "anda akan diarahkan dalam 3 detik",
                                    timer: 3000,
                                    buttons: false
                                }).then(function() {
                                    window.location.href = "{{ route('siswa') }}";
                                });
                            } else {
                                console.log(response.success);
                                swal({
                                    icon: "error",
                                    title: "NISN dan Password anda tidak sesuai",
                                    text: " silahkan login kembali"
                                });
                            }
                            console.log(response);
                        },
                        error: function(response) {
                            swal({
                                icon: "error",
                                title: "Opps",
                                text: "server error"
                            });
                            console.log(response);
                        }

                    });
                }


            });

            $('#show-password').click(function() {
                if ($(this).is(":checked")) {
                    $("#password").attr("type", "text");
                } else {
                    $('#password').attr("type", "password");
                }
            });

            $('.btn-votes').click(function(e) {
                e.preventDefault();
                const key = $(this).data("key");
                var token = $("meta[name='csrf-token']").attr("content");
                var votes = 1;

                var Auth = "{{{ Auth::guard('siswa')->check() ? Auth::guard('siswa')->user()->id : null }}}";
                let id = $('.candidat_id-' + key).val();

                $.ajax({
                    url: "{{route('siswa.votes')}}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": token,
                        "key": key,
                        votes: votes,
                        "candidat_id": id
                    },
                    success:function(result){
                        swal({
                             icon: "success",
                             title: "Anda berhasil memilih",
                             timer: 3000,
                             buttons: false
                            }).then(function(){
                                window.location.href = "{{route('siswa')}}"
                            });
                    },
                    error:function(result){
                        alert("gagla")
                    }
                });



            });








        });
    </script>
@endpush
