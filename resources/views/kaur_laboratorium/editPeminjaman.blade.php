@extends('template')
@section('konten')
<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">
      <h3>PEMINJAMAN</h3>
    </div>
    <form action="/kaur_laboratorium/peminjaman/edit/{{ $id }}" method="post">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label" for="input-username">Nama Aset</label>
              <select name="aset" id="aset" class="mySelect2" required>
                <option selected disabled></option>
                @foreach($aset as $aset)
                  <option value="{{ $aset->id }}" <?= $aset_id == $aset->id ? 'selected' : '' ; ?>>{{ $aset->nama_aset }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Nama Peminjam</label>
              <input type="text" id="input-username" class="form-control" placeholder="Nama Peminjam" name="peminjam" required value="{{ $peminjam }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Lokasi Peminjaman</label>
              <input type="text" class="form-control" placeholder="Lokasi Peminjaman" name="lokasi_peminjaman" required value="{{ $lokasi_peminjaman }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Tanggal Peminjaman</label>
              <input type="date" id="input-username" class="form-control" placeholder="Tanggal Peminjaman" name="tanggal_peminjaman" required value="{{ $tanggal_peminjaman }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Tanggal Kembali</label>
              <input type="date" id="input-username" class="form-control" placeholder="Tanggal Kembali" name="tanggal_kembali" required value="{{ $tanggal_kembali }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Asal Barang</label>
              <input type="text" id="input-username" class="form-control" placeholder="Asal Barang" name="asal_barang" required value="{{ $asal_barang }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">NIM/NIP</label>
              <input type="text" id="input-username" class="form-control" placeholder="NIM/NIP" name="nip" required value="{{ $nip }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Email</label>
              <input type="email" id="input-username" class="form-control" placeholder="Email" name="email" required value="{{ $email }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">No. Telepon</label>
              <input type="text" id="input-username" class="form-control" placeholder="No. Telepon" name="no_telepon" required value="{{ $no_telepon }}">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#edit">Edit</button>

        <!-- Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Anda yakin akan mengedit peminjaman?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary float-right" type="submit">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection