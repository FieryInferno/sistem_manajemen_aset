<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengadaan;
use App\Models\Mitra;

class PengadaanController extends Controller
{
  private $pengadaan;
  private $mitra;

  public function __construct()
  {
    $this->pengadaan  = new Pengadaan;
    $this->mitra      = new Mitra;
  }

  public function index()
  {
    $pengadaan = $this->pengadaan->all();
    return view('admin/pengadaan', ['pengadaan' => $pengadaan]);
  }

  public function create()
  {
    $mitra  = $this->mitra->all();
    return view('admin/tambahPengadaan', ['mitra' => $mitra]);
  }
  
  public function store(Request $request)
  {
    // Validate the request...

    $this->pengadaan->no_pengadaan  = $request->no_pengadaan;
    $this->pengadaan->tanggal_input = $request->tanggal_input;
    $this->pengadaan->nama_aset     = $request->nama_aset;
    $this->pengadaan->jenis_aset    = $request->jenis_aset;
    $this->pengadaan->merk          = $request->merk;
    $this->pengadaan->quantity      = $request->quantity;
    $this->pengadaan->mitra_id      = $request->mitra;
    $this->pengadaan->harga_aset    = preg_replace('/[Rp. ]/', '', $request->harga_aset);

    $this->pengadaan->save();

    return redirect('/admin/pengadaan')->with('status', 'Berhasil tambah pengadaan.');
  }
  
  public function edit($id)
  {
    $pengadaan          = $this->pengadaan->find($id);
    $pengadaan['mitra'] = $this->mitra->all();
    return view('admin/editPengadaan', $pengadaan);
  }
  
  public function update(Request $request, $id)
  {
    $pengadaan_baru = $this->pengadaan->find($id);

    $pengadaan_baru->no_pengadaan  = $request->no_pengadaan;
    $pengadaan_baru->tanggal_input = $request->tanggal_input;
    $pengadaan_baru->nama_aset     = $request->nama_aset;
    $pengadaan_baru->jenis_aset    = $request->jenis_aset;
    $pengadaan_baru->merk          = $request->merk;
    $pengadaan_baru->quantity      = $request->quantity;
    $pengadaan_baru->mitra_id      = $request->mitra;
    $pengadaan_baru->harga_aset    = preg_replace('/[Rp. ]/', '', $request->harga_aset);

    $pengadaan_baru->save();

    return redirect('/admin/pengadaan')->with('status', 'Berhasil edit data pengadaan.');
  }
  
  public function destroy($id)
  {
    $pengadaan_baru = $this->pengadaan->find($id);
    $pengadaan_baru->delete();
    return back()->with('status', 'Berhasil hapus data aset.');
  }

  public function history()
  {
    $pengadaan = $this->pengadaan->where('status', 'terima')->get();
    return view('admin/historyPengadaan', ['pengadaan' => $pengadaan]);
  }
  
  public function print()
  {
    $pengadaan = $this->pengadaan->all();
    return view('printPengadaan', ['pengadaan' => $pengadaan]);
  }

  public function printHistory()
  {
    $pengadaan  = $this->pengadaan->where('status', 'terima')->get();
    return view('printHistoryPengadaan', ['pengadaan' => $pengadaan]);
  }
}
