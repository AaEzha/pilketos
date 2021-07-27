<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Pilketos Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 py-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img src="{{ asset('assets/img/logo.png') }}" style="background-position: center;
                background-size: cover; width: 100%;  padding-left: 30px" alt="">
                            </div>
                            <div class="col-lg-6 mt-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Silahkan Masuk</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                name="email" placeholder="Masukan Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Masukan Password">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox"
                                                        aria-label="Checkbox for following text input" id="rememberme"
                                                        name="rememberme">

                                                </div>

                                            </div>
                                            <p>Ingat saya</p>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-user btn-block btn-login"
                                            id="btn-login">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

            // get id button
            $('#btn-login').click(function() {
                console.log('berhasil');

                //get id from input
                var email = $('#email').val();
                var password = $("#password").val();
                var remeberme = $('#rememberme').val();
                var token = $("meta[name='csrf-token']").attr("content");
                // var rememberme = $('#rememberme').val();

                // validasi

                if (email.length == "") {

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
                        url: "{{ route('admin.login') }}",
                        type: "POST",
                        dataType: "JSON",
                        cache: false,
                        data: {
                            "email": email,
                            "password": password,
                            "_token": token,


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
                                    window.location.href =
                                        "{{ route('admin.dashboard') }}";
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
        });
    </script>

</body>

</html>
