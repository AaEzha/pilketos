<table style="display: none">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kandidat</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Jumlah Vote</th>
            <th>Tahun</th>
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
                {{-- <td><img src="{{ url($sCalon->gambar) }}" height="100px" width="100px" alt=""></td> --}}
                <td>{{ $sCalon->kelas }}</td>
                <td>{{ $sCalon->jurusan }}</td>
                <td>{{ $sCalon->votes ? $sCalon->votes : '0' }}</td>
                <td>{{ $sCalon->Tahun }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
