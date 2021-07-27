<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/957fd7238a.js" crossorigin="anonymous"></script>
    <title>Pilketos SMK TI Pembangunan Cimahi</title>
</head>

<body style="background-color: #48cae4">
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #0096c7">
        <div class="container ">
            <a class="navbar-brand text-white " href="#"> SMK TI Pembangunan</a>
            @if (Auth::guard('siswa')->check())
                <div class="d-flex flex-column  ">
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::guard('siswa')->user()->nama }} - {{ Auth::guard('siswa')->user()->kelas }}
                            {{ Auth::guard('siswa')->user()->jurusan }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="{{ route('siswa.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">Keluar</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </nav>


    {{-- Isi konten --}}
    @yield('konten')

    @extends('siswa_layouts.SiswaFooter')
