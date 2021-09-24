<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggaranSeeder extends Seeder
{
  
  public function run()
  {
    DB::table('anggaran')->insert([
      'anggaran_pengadaan'    => '1',
      'anggaran_maintenance'  => '1',
    ]);
  }
}
