@extends('admin_layouts.header')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')


    <div class="card  ">
        <h3 class="mx-3">Filter Data berdasarkan Tahun</h3>
        <form action="{{ route('admin.laporan.pertahun') }}" method="GET" class="mx-3 my-5">

            <select style="cursor:pointer;" class="form-control " id="tag_select" name="year">
                <option value="0" selected disabled> Pilih Tahun</option>
                @php
                    $year = date('Y');

                    $min = $year - 2;
                    $max = $year;
                    for ($i = $max; $i >= $min; $i--) {
                        echo '<option value=' . $i . '>' . $i . '</option>';
                    }
                @endphp
            </select>
            <button class="btn btn-primary mt-2 "><i class="fas fa-search mr-3"></i>Cari Data</button>
        </form>
    </div>


    <div class="card mt-5">
        <div class="card-body">
            <h3 class="card-title text-center display-4">Data Laporan</h3>


            <a href="{{ route('admin.laporan.excel', $year) }}" style="display: inline-block"
                class="btn btn-success btn-sm"><i class="fas fa-file-excel mr-2"></i>Export
                PDF>


            </a>

            <a href="" class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf mr-2"></i>EXPORT PDF</a>

            <div class="table-responsive mt-4 ">
                @include('admin.dashboard.menu.table.table_laporan')


                @include ('admin.dashboard.menu.table.table_laporan')


                <table class="table" id="table_laporan" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kandidat</th>

                            <th scope="col">Kelas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Jumlah Vote</th>
                            <th scope="col" width="20px">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($calon as $sCalon)


                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $sCalon->nama }}</td>

                                <td>{{ $sCalon->kelas }}</td>
                                <td>{{ $sCalon->jurusan }}</td>
                                <td>{{ $sCalon->votes ? $sCalon->votes : '0' }}</td>
                                <td>{{ $sCalon->Tahun }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            var siswa = $('#table_laporan').DataTable();
        })
    </script>
@endpush
