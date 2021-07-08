@extends('template')
@section('konten')
<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">
      <h3>PENGADAAN</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="myTable">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Nomor Pengadaan</th>
              <th scope="col">Nama Aset</th>
              <th scope="col">Jenis Aset</th>
              <th scope="col">Quantity</th>
              <th scope="col">Kode Mitra</th>
              <th scope="col">Nama Mitra</th>
              <th scope="col">Harga Aset</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pengadaan as $pengadaan)
              <tr>
                <td>{{ $pengadaan->no_pengadaan }}</td>
                <td>{{ $pengadaan->aset->nama_aset }}</td>
                <td>{{ $pengadaan->aset->jenis_aset }}</td>
                <td>{{ $pengadaan->quantity }}</td>
                <td>{{ $pengadaan->mitra->kode_mitra }}</td>
                <td>{{ $pengadaan->mitra->nama_mitra }}</td>
                <td>{{ $pengadaan->harga_aset }}</td>
                <td>{{ $pengadaan->status }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection