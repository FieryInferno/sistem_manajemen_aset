<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengadaan;
use App\Models\Maintenance;
use App\Models\Anggaran;

class KeuanganController extends Controller
{
  private $pengadaan;
  private $maintenance;
  private $Anggaran;
  
  public function __construct()
  {
    $this->pengadaan    = new Pengadaan;
    $this->maintenance  = new Maintenance;
    $this->anggaran     = new Anggaran;
  }

  public function index()
  {
    $tgl_awal       = date('Y')-7;
    $tgl_akhir      = date('Y');
    $data_pengadaan = [];
    for ($i = $tgl_awal; $i <= $tgl_akhir; $i++) {
      $pengadaan          = $this->pengadaan->whereYear('tanggal_input', $i)->get();
      $data_pengadaan[$i] = 0;
      foreach ($pengadaan as $key) {
        $data_pengadaan[$i] += $key['harga_aset'];
      }
    }
    $data['data_pengadaan']  = $data_pengadaan;
   
    $data_maintenance = [];
    for ($i = $tgl_awal; $i <= $tgl_akhir; $i++) {
      $maintenance          = $this->maintenance->whereYear('tanggal_maintenance', $i)->get();
      $data_maintenance[$i] = 0;
      foreach ($maintenance as $key) {
        $data_maintenance[$i] += $key['biaya'];
      }
    }
    $data['data_maintenance']  = $data_maintenance; 

    $pengadaan = collect($this->pengadaan->get());

    $laboratorium = $pengadaan->map(function ($item) {
      if ($item['jenis_aset'] == 'laboratorium') {
        return $item['harga_aset'] * $item['quantity'];
      }
    });

    $institusi  = $pengadaan->map(function ($item) {
      if ($item['jenis_aset'] == 'institusi') {
        return $item['harga_aset'] * $item['quantity'];
      }
    });
    
    $pengadaan  = $pengadaan->map(function ($item) {
      return $item['harga_aset'] * $item['quantity'];
    });

    $data['p_realisasi']  = $pengadaan->sum();
    $data['p_anggaran']   = $anggaran->anggaran_pengadaan;
    $data['p_pengadaan']  = $pengadaan->sum() / $anggaran->anggaran_pengadaan * 100;

    $data['biayaPengadaan']['laboratorium'] = $laboratorium->sum();
    $data['biayaPengadaan']['institusi']    = $institusi->sum();

    $maintenance = collect($this->maintenance->get());

    $laboratorium = $maintenance->map(function ($item) {
      if ($item->aset->jenis_aset == 'laboratorium') {
        return $item['biaya'];
      }
    });

    $institusi  = $maintenance->map(function ($item) {
      if ($item->aset->jenis_aset == 'institusi') {
        return $item['biaya'];
      }
    });
    
    $maintenance  = $maintenance->map(function ($item) {
      return $item['biaya'];
    });

    $data['m_realisasi']    = $maintenance->sum();
    $data['m_anggaran']     = $anggaran->anggaran_maintenance;
    $data['m_maintenance']  = $maintenance->sum() / $anggaran->anggaran_maintenance * 100;

    $data['biayaMaintenance']['laboratorium'] = $laboratorium->sum();
    $data['biayaMaintenance']['institusi']    = $institusi->sum();

    return view('keuangan/dashboard', $data);
  }
}
