<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\Pegawai_Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class Admin_PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('master.outlets.pegawai.daftarPegawai');
    }

    public function getDataListPegawai(): JsonResponse
    {
        $data = DB::table('pegawai')
            ->select(
                'pegawai.id',
                'pegawai.name as name_pegawai',
                'pegawai.email',
                'pegawai.created_at',
                'pegawai_details.avatar',
                'pegawai_details.path_avatar',
                'outlets.outlet_name',
                'outlets.outlet_code',
                'brands.brand_name',
                'brand_categories.brand_category_name'
            )
            ->leftJoin('pegawai_details', 'pegawai_details.pegawai_id', 'pegawai.id')
            ->leftJoin('outlets', 'outlets.outlet_code', 'pegawai.outlet_code')
            ->leftJoin('brands', 'brands.brand_code', 'outlets.brand_code')
            ->leftJoin('brand_categories', 'brand_categories.brand_category_code', 'brands.brand_category_code')
            //untuk parameter ynag ditampilkan hanya pegawai pada brand yang telah di approve
            ->leftJoin('brands_registers', 'brands_registers.brand_code', 'brands.brand_code')
            ->where('brands_registers.is_regis', '1')
            ->where('pegawai.is_active', '1')
            ->orderBy('pegawai.name', 'asc')
            ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $pegawai = Pegawai::findOrFail($id);
        $detail = Pegawai_Detail::where('pegawai_id', $id)->first();
        $penjualan = DB::table('invoice_master_pembeli')->where('pegawai_id', $pegawai->id)->sum('invoice_master_pembeli.amount');

        return view('master.outlets.pegawai.detailPegawai', [
            'pegawai' => $pegawai,
            'detail' => $detail,
            'penjualan' => $penjualan
        ]);
    }

    public function getDataDetailProfilePegawai($id): JsonResponse
    {
        $pegawai = DB::table('pegawai')
            ->select(
                'pegawai.id',
                'pegawai.name as name_pegawai',
                'pegawai.username',
                'pegawai.email',
                'pegawai.no_hp',
                'pegawai.created_at',
                'ref_kelurahan.nama_kelurahan',
                'ref_kecamatan.nama_kecamatan',
                'ref_kotakab.nama_kotakab',
                'ref_propinsi.nama_propinsi',
                'pegawai_details.kode_pos',
                'pegawai_details.alamat_detail',
                'outlets.outlet_name',
                'outlets.outlet_code',
                'brands.brand_name',
                'brands.brand_code',
                'brand_categories.brand_category_name'
            )
            ->leftJoin('pegawai_details', 'pegawai_details.pegawai_id', 'pegawai.id')
            ->leftJoin('ref_kelurahan', 'ref_kelurahan.kode_kelurahan', 'pegawai_details.kelurahan')
            ->leftJoin('ref_kecamatan', 'ref_kecamatan.kode_kecamatan', 'pegawai_details.kecamatan')
            ->leftJoin('ref_kotakab', 'ref_kotakab.kode_kotakab', 'pegawai_details.kota_kabupaten')
            ->leftJoin('ref_propinsi', 'ref_propinsi.kode_propinsi', 'pegawai_details.provinsi')
            ->leftJoin('outlets', 'outlets.outlet_code', 'pegawai.outlet_code')
            ->leftJoin('brands', 'brands.brand_code', 'outlets.brand_code')
            ->leftJoin('brand_categories', 'brand_categories.brand_category_code', 'brands.brand_category_code')
            ->where('pegawai.id', $id)
            ->get();

        $datas = [
            'data' => $pegawai
        ];

        return response()->json($datas);
    }

    public function getDataTransactionPegawai(Pegawai $pegawai): JsonResponse
    {
        $transaksi = DB::table('invoice_master_pembeli')
        ->select(
            'users_pelanggan.name as pembeli',
            'invoice_master_pembeli.date_created',
            'invoice_master_pembeli.invoice_no',
            'invoice_master_pembeli.qty',
            'invoice_master_pembeli.amount',
        )
        ->leftJoin('users_pelanggan', 'users_pelanggan.id', 'invoice_master_pembeli.pembeli_id')
        ->where('invoice_master_pembeli.pegawai_id', $pegawai->id)
        ->get();

        $datas = [
            'data' => $transaksi
        ];

        return response()->json($datas);
    }

    public function validateEmailPegawai(Request $request)
    {
        $email = $request->email;
        $used = Pegawai::where('email', $email)->exists();

        return response()->json(['used' => $used]);
    }

    public function updateEmailPegawai(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required',
                'email' =>'required'
            ]);

            // Cek Email
            $used = Pegawai::where('email', $request->email)->exists();
            if ($used) {
                return redirect()->back()->with('error', 'Email Sudah Digunakan, Silahkan Gunakan Email yang lain.');
            }
            
            $update = Pegawai::findOrFail($request->id);

            $update->update(['email' => $request->email]);

            DB::commit(); // Commit the transaction

        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Email Pegawai Berhasil diupdate');
    }

    public function updatePasswordPegawai(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $request->validate([
                'newpassword'      => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
                'confirmpassword'  => 'required|same:newpassword',
            ]);

            $user = Pegawai::findOrFail($request->id);

            $user->update([
                'password' => Hash::make($request->newpassword),
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Password berhasil diperbaharui');
    }

    public function updateStatusPegawai(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required'
            ]);

            $update = Pegawai::findOrFail($request->id);
            if ($update->is_active == 0) {
                $update->update(['is_active' => 1]);
            } else {
                $update->update(['is_active' => 0]);
            }
            
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Status berhasil diperbaharui');
    }
}
