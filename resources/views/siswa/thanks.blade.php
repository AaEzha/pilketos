@extends('siswa_layouts.SiswaHeader')
@section('konten')
    <h2 class="text-center mt-5">Terimakasih sudah berpartisipasi dalam pemilihan OSIS</h2>
    @foreach ($thanks as $makasih)
        <img src="{{ url($makasih->gambar) }}" class="rounded mx-auto d-block" alt="..." width="300px">
        <p class="text-center">anda memilih {{ $makasih->nama }} sebagai calon ketua OSIS</p>
    @endforeach

@endsection
