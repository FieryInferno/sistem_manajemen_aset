<?php

namespace App\Http\Controllers\Wadek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Asets;
use App\Models\Mitra;

class MaintenanceController extends Controller
{
  private $maintenance;
  private $aset;
  private $mitra;

  public function __construct()
  {
    $this->maintenance  = new Maintenance;
    $this->aset         = new Asets;
    $this->mitra        = new Mitra;
  }

  public function index()
  {
    $maintenance  = $this->maintenance->all();
    return view('wadek/maintenance', ['maintenance' => $maintenance]);
  }
  
  public function create()
  {
    $aset   = $this->aset->all();
    $mitra  = $this->mitra->all();
    return view('wadek/tambahMaintenance', [
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

    return redirect('/wadek/maintenance')->with('status', 'Berhasil tambah maintenance.');
  }
  
  public function show($id)
  {
    $maintenance  = $this->maintenance->find($id);
    return view('wadek/editMaintenance', $maintenance);
  }
  
  public function edit($id)
  {
    $maintenance          = $this->maintenance->find($id);
    $maintenance['aset']  = $this->aset->all();
    $maintenance['mitra'] = $this->mitra->all();
    return view('wadek/editMaintenance', $maintenance);
  }
  
  public function update(Request $request, $id)
  {
    // dd($request->kode_maintenance);
    $maintenance_baru = $this->maintenance->find($id);

    $maintenance_baru->kode_maintenance    = $request->kode_maintenance;
    $maintenance_baru->tanggal_maintenance = $request->tanggal_maintenance;
    $maintenance_baru->aset_id             = $request->aset;
    $maintenance_baru->biaya               = preg_replace('/[Rp. ]/', '', $request->biaya);
    $maintenance_baru->mitra_id            = $request->mitra;
    $maintenance_baru->tanggal_selesai     = $request->tanggal_selesai;
    $maintenance_baru->lokasi              = $request->lokasi;

    $maintenance_baru->save();

    return redirect('/wadek/maintenance')->with('status', 'Berhasil edit data maintenance.');
  }
  
  public function destroy($id)
  {
    $maintenance_baru = $this->maintenance->find($id);
    $maintenance_baru->delete();
    return back()->with('status', 'Berhasil hapus data aset.');
  }
  
  public function updateStatus($status, $id)
  {
    $maintenance_baru = $this->maintenance->find($id);

    $maintenance_baru->status_wadek  = $status;
    
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
    return redirect('/wadek/maintenance')->with('status', 'Berhasil edit data maintenance.');
  }

  public function history()
  {
    $maintenance  = $this->maintenance->where('status', 'terima')->get();
    return view('wadek/historyMaintenance', ['maintenance' => $maintenance]);
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
}