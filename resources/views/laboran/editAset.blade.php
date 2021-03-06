@extends('template')
@section('konten')
<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">
      <h3>DATA ASET</h3>
    </div>
    <form action="/laboran/data_aset/edit/{{ $id }}" method="post">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label" for="input-username">Kode Aset</label>
              <input type="text" id="input-username" class="form-control" placeholder="Kode Aset" name="kode_aset" required value="{{ $kode_aset }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Nama Aset</label>
              <input type="text" id="input-username" class="form-control" placeholder="Nama Aset" name="nama_aset" required value="{{ $nama_aset }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Jenis Aset</label>
              <select name="jenis_aset" id="jenis_aset" class="mySelect2" required>
                <option selected disabled></option>
                <option value="laboratorium" <?= $jenis_aset == 'laboratorium' ? 'selected' : '' ; ?>>Laboratorium</option>
                <option value="institusi" <?= $jenis_aset == 'institusi' ? 'selected' : '' ; ?>>Institusi</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Merk</label>
              <input type="text" id="input-username" class="form-control" placeholder="Merk" name="merk" required value="{{ $merk }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Kepemilikan</label>
              <input type="text" id="input-username" class="form-control" placeholder="Kepemilikan" name="kepemilikan" required value="{{ $kepemilikan }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Lokasi</label>
              <input type="text" id="input-username" class="form-control" placeholder="Lokasi" name="lokasi" required value="{{ $lokasi }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Tanggal Pembelian</label>
              <input type="date" id="input-username" class="form-control" placeholder="Tanggal Pembelian" name="tanggal_pembelian" required value="{{ $tanggal_pembelian }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Tanggal Maintenance</label>
              <input type="date" id="input-username" class="form-control" placeholder="Tanggal Maintenance" name="tanggal_maintenance" required value="{{ $tanggal_maintenance }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Waktu Maintenance</label>
              <input type="text" id="input-username" class="form-control" placeholder="Waktu Maintenance" name="waktu_maintenance" required value="{{ $waktu_maintenance }}">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Kondisi</label>
              <input type="text" id="input-username" class="form-control" placeholder="Kondisi" name="kondisi" required value="{{ $kondisi }}">
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
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Anda yakin akan mengedit aset?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary float-right mb-3" type="submit">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection