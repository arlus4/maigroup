<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ref_KotaKab;
use App\Models\ref_Kecamatan;
use App\Models\ref_Kelurahan;
use App\Models\ref_KodePos;

class AlamatController extends Controller
{
    public function get_data_kotakab($provinsi)
    {
        $kotakab = ref_KotaKab::select('kode_kotakab', 'nama_kotakab')
            ->where('kode_propinsi', $provinsi)
            ->get();
        return response()->json($kotakab);
    }

    public function get_data_kecamatan($kotakab)
    {
        $kecamatan = ref_Kecamatan::select('kode_kecamatan', 'nama_kecamatan')
            ->where('kode_kotakab', $kotakab)
            ->get();
        return response()->json($kecamatan);
    }

    public function get_data_kelurahan($kecamatan)
    {
        $kelurahan = ref_Kelurahan::select('kode_kelurahan', 'nama_kelurahan')
            ->where('kode_kecamatan', $kecamatan)
            ->get();
        return response()->json($kelurahan);
    }

    public function get_data_kodepos($kelurahan)
    {
        $kodepos = ref_KodePos::select('kodepos')
            ->where('kode_kelurahan', $kelurahan)
            ->get();
        return response()->json($kodepos);
    }
}
