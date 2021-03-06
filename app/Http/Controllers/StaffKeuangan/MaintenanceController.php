<?php

namespace App\Http\Controllers\StaffKeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Asets;
use App\Models\Mitra;
use App\Models\Anggaran;

class MaintenanceController extends Controller
{
  private $maintenance;
  private $aset;
  private $mitra;
  private $anggaran;

  public function __construct()
  {
    $this->maintenance  = new Maintenance;
    $this->aset         = new Asets;
    $this->mitra        = new Mitra;
    $this->anggaran     = new Anggaran;
  }

  public function index()
  {
    $maintenance  = $this->maintenance->all();
    return view('staff_keuangan/maintenance', ['maintenance' => $maintenance]);
  }
  
  public function create()
  {
    $aset   = $this->aset->all();
    $mitra  = $this->mitra->all();
    return view('staff_keuangan/tambahMaintenance', [
      'aset'  => $aset,
      'mitra' => $mitra
    ]);
  }
  
  public function store(Request $request)
  {
    // Validate the request...

    $this->maintenance->kode_maintenance    = $request->kode_maintenance;
    $this->maintenance->tanggal_maintenance = $request->tanggal_maintenance;
    $this->maintenance->aset_id             = $request->aset;
    $this->maintenance->biaya               = preg_replace('/[Rp. ]/', '', $request->biaya);
    $this->maintenance->mitra_id            = $request->mitra;
    $this->maintenance->tanggal_selesai     = $request->tanggal_selesai;
    $this->maintenance->lokasi              = $request->lokasi;

    $this->maintenance->save();

    return redirect('/staff_keuangan/maintenance')->with('status', 'Berhasil tambah maintenance.');
  }
  
  public function show($id)
  {
    $maintenance  = $this->maintenance->find($id);
    return view('staff_keuangan/editMaintenance', $maintenance);
  }
  
  public function edit($id)
  {
    $maintenance          = $this->maintenance->find($id);
    $maintenance['aset']  = $this->aset->all();
    $maintenance['mitra'] = $this->mitra->all();
    return view('staff_keuangan/editMaintenance', $maintenance);
  }
  
  public function update(Request $request, $id)
  {
    $maintenance_baru = $this->maintenance->find($id);

    $maintenance_baru->kode_maintenance    = $request->kode_maintenance;
    $maintenance_baru->tanggal_maintenance = $request->tanggal_maintenance;
    $maintenance_baru->aset_id             = $request->aset;
    $maintenance_baru->biaya               = preg_replace('/[Rp. ]/', '', $request->biaya);
    $maintenance_baru->mitra_id            = $request->mitra;
    $maintenance_baru->tanggal_selesai     = $request->tanggal_selesai;
    $maintenance_baru->lokasi              = $request->lokasi;

    $maintenance_baru->save();

    return redirect('/staff_keuangan/maintenance')->with('status', 'Berhasil edit data maintenance.');
  }
  
  public function destroy($id)
  {
    $maintenance_baru = $this->maintenance->find($id);
    $maintenance_baru->delete();
    return back()->with('status', 'Berhasil hapus data aset.');
  }

  public function history()
  {
    $maintenance  = $this->maintenance->where('status', 'terima')->get();
    return view('staff_keuangan/historyMaintenance', ['maintenance' => $maintenance]);
  }
  
  public function updateStatus($status, $id)
  {
    $maintenance_baru = $this->maintenance->find($id);

    $maintenance_baru->status_keuangan  = $status;
    
    $maintenance_baru->save();

    $maintenance_baru = $this->maintenance->find($id);
    if ($maintenance_baru->status_kaur !== NULL && $maintenance_baru->status_keuangan !== NULL && $maintenance_baru->status_wadek !== NULL) {
      if ($maintenance_baru->status_kaur == 'terima' && $maintenance_baru->status_keuangan == 'terima' && $maintenance_baru->status_wadek == 'terima') {
        $maintenance_baru->status = 'terima';
      } else {
        $maintenance_baru->status = 'tolak';
      }
      $maintenance_baru->save();
    }
    return redirect('/staff_keuangan/maintenance')->with('status', 'Berhasil edit data maintenance.');
  }

  public function printHistory()
  {
    $maintenance  = $this->maintenance->where('status', 'terima')->get();
    return view('printHistoryMaintenance', ['maintenance' => $maintenance]);
  }
  
  public function print()
  {
    $maintenance = $this->maintenance->all();
    return view('printMaintenance', ['maintenance' => $maintenance]);
  }

  public function inputAnggaran(Request $request)
  {
    $anggaran = $this->anggaran->first();

    $anggaran->anggaran_maintenance = preg_replace('/[Rp. ]/', '', $request->anggaran);

    $anggaran->save();

    return redirect('/staff_keuangan')->with('status', 'Berhasil ubah anggaran maintenance.');
  }
}