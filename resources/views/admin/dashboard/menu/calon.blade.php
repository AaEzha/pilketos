@extends('admin_layouts.header')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent ">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Calon</li>
        </ol>
    </nav>

    <button type="button" id="tambah-calon" class="d-inline btn btn-sm btn-primary text-white" data-toggle="modal"
        data-target="#modal-calon">
        Tambah data <i class="fas fa-plus ml-2"></i>
    </button>

    <button type="button" data-toggle="modal" data-target="#delete-All"
        class="d-inline btn btn-sm btn-danger hapus-calon-all text-white">Hapus semua
        data<i class="fas fa-trash-alt ml-2"></i></button>

    <!-- Modal -->
    <div class="modal fade" id="delete-All" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">



                <div class="modal-body">
                    <h5>Apakah anda yakin ingin menghapus semua data ?</h5>
                    <p>Data yang sudah dihapus , tidak bisa dikembalikan lagi.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="form-delete-all" action="{{ route('admin.calon.delete.all') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card">

    </div> --}}
    @if (!$calon->isEmpty())

        <div class="container">
            <div class="row mt-5">
                @foreach ($calon as $kandidat)


                    <div class="col-lg-4 col-sm-4 col-md-4 d-flex justify-content-center mb-4">
                        <div class="card" style="width: 18rem; height: 45rem">
                            <img class="card-img-top" src="{{ url($kandidat->gambar) }}" alt="Card image cap"
                                height="50%">
                            <div class="card-body">
                                <p class="card-title text-center font-weight-bold">{{ $kandidat->nama }}</p>
                                <p class="card-title text-center">{{ $kandidat->kelas }} - {{ $kandidat->jurusan }}
                                </p>
                                <p class="font-weight-bold">Visi</p>
                                <p>{{ $kandidat->visi }}</p>
                                <p class="font-weight-bold">Misi</p>
                                <p>{{ $kandidat->misi }}</p>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info " style="width: 100%">Update</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger delete-calon" data-id="{{ $kandidat->id }}"
                                            style="width: 100%">Delete</button>
                                    </div>
                                </div>
                                {{-- <button class="d-inline p-2 border-0 bg-primary text-white"
                                    style="width: 50%">Update</button>
                                <button class="d-inline p-2 border-0 bg-primary text-white "
                                    style="width: 30%">Update</button> --}}
                            </div>

                        </div>




                    </div>


                @endforeach
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center col-sm-12 mt-5 ">
                <img src="{{ asset('assets/img/nodata.png') }}" alt="" class="w-25 ">

            </div>

        </div>
        <p class="text-center text-dark font-weight-bold">Data tidak ada, silahkan buat</p>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="modal-calon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form id="form-tambah-calon" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Masukan Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Masukan NISN</label>
                            <input type="number" class="form-control" id="nisn" name="nisn">
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
                        <div class="form-group">
                            <input type="file" name="file" class="form-control" id="image-input">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Visi</label>
                            <textarea class="form-control" id="visi" name="visi" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Misi</label>
                            <textarea class="form-control" id="misi" name="misi" rows="3"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('javascripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $('#form-tambah-calon').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.calon.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                        });
                        setInterval('location.reload()', 3000);
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });

        $('.delete-calon').click(function() {
            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Apakah yakin ingin menghapus data calon ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('admin/calon/') }}/" + id,
                        type: "DELETE",
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function() {
                            setInterval('location.reload()', 1000);
                        }
                    });
                }
            });


        });
    </script>
@endpush
