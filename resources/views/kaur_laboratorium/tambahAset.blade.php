@extends('template')
@section('konten')
<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">
      <h3>DATA ASET</h3>
    </div>
    <form action="/kaur_laboratorium/data_aset/tambah" method="post">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label" for="input-username">Kode Aset</label>
              <input type="text" id="input-username" class="form-control" placeholder="Kode Aset" name="kode_aset" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Nama Aset</label>
              <input type="text" id="input-username" class="form-control" placeholder="Nama Aset" name="nama_aset" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Jenis Aset</label>
              <input type="text" class="form-control" value="laboratorium" name="jenis_aset" readonly>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Merk</label>
              <input type="text" id="input-username" class="form-control" placeholder="Merk" name="merk" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Kepemilikan</label>
              <input type="text" id="input-username" class="form-control" placeholder="Kepemilikan" name="kepemilikan" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Lokasi</label>
              <input type="text" id="input-username" class="form-control" placeholder="Lokasi" name="lokasi" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Tanggal Pembelian</label>
              <input type="date" id="input-username" class="form-control" placeholder="Tanggal Pembelian" name="tanggal_pembelian" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Tanggal Maintenance</label>
              <input type="date" id="input-username" class="form-control" placeholder="Tanggal Maintenance" name="tanggal_maintenance">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Waktu Maintenance</label>
              <input type="text" id="input-username" class="form-control" placeholder="Waktu Maintenance" name="waktu_maintenance" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-username">Kondisi</label>
              <select name="kondisi" id="kondisi" class="mySelect2" required>
                <option selected disabled></option>
                <option value="baik">Baik</option>
                <option value="maintenance">Maintenance</option>
                <option value="rusak">Rusak</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#tambah">Tambah</button>

        <!-- Modal -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tambah Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Anda yakin akan menambah aset?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary float-right mb-3" type="submit">Tambah</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection