@extends('admin_layouts.header')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center display-4">Data Siswa</h3>

            <button class="btn btn-primary btn-sm mb-3 float-right" data-toggle="modal" data-target="#modal-siswa">Tambah
                Siswa <i class="fas fa-plus ml-2"></i></button>
            <div class="table-responsive">
                <table class="table" id="table_siswa" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col" width="20px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $ShowSiswa)


                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $ShowSiswa->nisn }}</td>
                                <td>{{ $ShowSiswa->nama }}</td>
                                <td>{{ $ShowSiswa->kelas }}</td>
                                <td>{{ $ShowSiswa->jurusan }}</td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" style="display: none">
                        <p class="text-bold">Data tidak boleh kosong</p>
                    </div>
                    <form id="tambah-siswa">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NISN</label>
                            <input type="number" class="form-control" name="nisn" id="nisn" aria-describedby="emailHelp"
                                placeholder="Masukan NISN">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Masukan Nama">
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Pilih Kelas</label>
                            <select class="custom-select my-1 mr-sm-2" id="kelas" name="kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Pilih Jurusan</label>
                            <select class="custom-select my-1 mr-sm-2" id="jurusan" name="jurusan">
                                <option selected disabled>Pilih Jurusan</option>
                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="EIND">EIND</option>
                                <option value="TP">TP</option>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-simpan" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('javascripts')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var siswa = $('#table_siswa').DataTable();

            $('#btn-simpan').on('click', function() {



                console.log("test");

                var nisn = $('#nisn').val();
                var nama = $('#nama').val();
                var kelas = $('#kelas').val();
                var jurusan = $('#jurusan').val();
                var password = $('#password').val();

                if (nisn.length == "" || nama.length == "" || kelas.length == "" || jurusan.length == "") {
                    $('.alert').show();
                    console.log("tst");
                } else {
                    $.ajax({
                        data: $('#tambah-siswa').serialize(),
                        url: "{{ route('admin.siswa.store') }}",
                        dataType: "JSON",
                        type: "POST",
                        success: function(data) {
                            $('#modal-siswa').modal('hide');
                            // $('#table_siswa').DataTable().ajax.reload();
                            // siswa.ajax.url().load("{{ route('admin.siswa') }}");
                            $('#tambah-siswa').trigger("reset");
                            window.location.href = "{{ route('admin.siswa') }}";




                        },
                        error: function(data) {
                            console.log("error", data);
                        }
                    });
                }

            });
        })
    </script>
@endpush
