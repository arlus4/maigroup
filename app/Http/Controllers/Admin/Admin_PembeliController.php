<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Users_Pelanggan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class Admin_PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('master.pembeli.daftarUserPembeli');
    }

    public function get_dataPembeli(): JsonResponse
    {
        $pelanggan = DB::table('users_pelanggan')
        ->select(
            'users_pelanggan.id',
            'users_pelanggan.name',
            'users_pelanggan.username',
            'users_pelanggan.no_hp',
            'users_pelanggan.email',
            'users_pelanggan.is_active',
            'users_pelanggan_details.avatar',
            'users_pelanggan_details.path_avatar'
        )
        ->leftJoin('users_pelanggan_details', 'users_pelanggan.id', 'users_pelanggan_details.pelanggan_id')
        ->get();
        
        $datas = [
            'data' => $pelanggan
        ];

        return response()->json($datas);
    }

    /**
     * Update the notifications status for a user.
     *
     * @param Request $request
     * @param int $user
     * @return JsonResponse
     */
    public function updateNotifications(Request $request, $user): JsonResponse
    {
        // Check if the 'enabled' parameter is set to 'true'
        // If true, set $isActive to 1, otherwise set it to 0
        $isActive = $request->enabled === 'true' ? 1 : 0;

        // Update the 'is_active' column of the user with the given ID
        Users_Pelanggan::where('id', $user)->update(['is_active' => $isActive]);

        // Return a JSON response with a success message
        return response()->json(['message' => 'Status Berhasil Diubah.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $pelanggan = Users_Pelanggan::findOrFail($id);
        $detail = DB::table('users_pelanggan_details')
            ->select(
                'users_pelanggan_details.avatar',
                'users_pelanggan_details.path_avatar',
                'ref_kelurahan.nama_kelurahan',
                'ref_kecamatan.nama_kecamatan',
                'ref_kotakab.nama_kotakab',
                'ref_propinsi.nama_propinsi',
            )
            ->leftJoin('ref_kelurahan', 'ref_kelurahan.kode_kelurahan', 'users_pelanggan_details.kode_kelurahan')
            ->leftJoin('ref_kecamatan', 'ref_kecamatan.kode_kecamatan', 'users_pelanggan_details.kode_kecamatan')
            ->leftJoin('ref_kotakab', 'ref_kotakab.kode_kotakab', 'users_pelanggan_details.kode_kotakab')
            ->leftJoin('ref_propinsi', 'ref_propinsi.kode_propinsi', 'users_pelanggan_details.kode_propinsi')
            ->where('users_pelanggan_details.pelanggan_id', $id)
        ->first();
        $penjualan = DB::table('invoice_master_pembeli')->where('pembeli_id', $id)->sum('invoice_master_pembeli.amount');

        return view('master.pembeli.detailUserPembeli', [
            'pelanggan' => $pelanggan,
            'detail' => $detail,
            'penjualan' => $penjualan
        ]);
    }

    /**
     * Get data transaction for buyer.
     *
     * @param int $id The buyer ID.
     * @return JsonResponse The JSON response containing the transaction data.
     */
    public function getDataTransactionPembeli($id): JsonResponse
    {
        $transaksi = DB::table('invoice_master_pembeli')
        ->select(
            'invoice_master_pembeli.date_created',
            'invoice_master_pembeli.invoice_no',
            'invoice_master_pembeli.qty',
            'invoice_master_pembeli.amount',
            'outlets.outlet_name'
        )
        ->leftJoin('outlets', 'outlets.outlet_code', 'invoice_master_pembeli.outlet_code')
        ->where('invoice_master_pembeli.pembeli_id', $id)
        ->get();

        $datas = [
            'data' => $transaksi
        ];

        return response()->json($datas);
    }

    public function validateNoHPPembeli(Request $request)
    {
        $no_hp = $request->no_hp;
        $used = Users_Pelanggan::where('no_hp', $no_hp)->exists();

        return response()->json(['used' => $used]);
    }

    public function validateUsernamePembeli(Request $request)
    {
        $username = $request->username;
        $used = Users_Pelanggan::where('username', $username)->exists();

        return response()->json(['used' => $used]);
    }

    public function validateEmailPembeli(Request $request)
    {
        $email = $request->email;
        $used = Users_Pelanggan::where('email', $email)->exists();

        return response()->json(['used' => $used]);
    }

    public function updateNoHPPembeli(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required',
                'no_hp' =>'required'
            ]);

            // Cek Nomor HandPhone
            $used = Users_Pelanggan::where('no_hp', $request->no_hp)->exists();
            if ($used) {
                return redirect()->back()->with('error', 'Nomor HandPhone Sudah Digunakan, Silahkan Gunakan Nomor HandPhone yang lain.');
            }
            
            $update = Users_Pelanggan::findOrFail($request->id);

            $update->update([
                'no_hp' => $request->no_hp,
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction

        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Nomor HandPhone Pembeli Berhasil diupdate');
    }

    public function updateUsernamePembeli(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required',
                'username' =>'required'
            ]);

            // Cek Username
            $used = Users_Pelanggan::where('username', $request->username)->exists();
            if ($used) {
                return redirect()->back()->with('error', 'Username Sudah Digunakan, Silahkan Gunakan Username yang lain.');
            }
            
            $update = Users_Pelanggan::findOrFail($request->id);

            $update->update([
                'username' => $request->username,
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction

        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Username Pembeli Berhasil diupdate');
    }

    public function updateEmailPembeli(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required',
                'email' =>'required'
            ]);

            // Cek Email
            $used = Users_Pelanggan::where('email', $request->email)->exists();
            if ($used) {
                return redirect()->back()->with('error', 'Email Sudah Digunakan, Silahkan Gunakan Email yang lain.');
            }
            
            $update = Users_Pelanggan::findOrFail($request->id);

            $update->update([
                'email' => $request->email,
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction

        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Email Pembeli Berhasil diupdate');
    }

    public function updatePasswordPembeli(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $request->validate([
                'newpassword'      => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
                'confirmpassword'  => 'required|same:newpassword',
            ]);

            $user = Users_Pelanggan::findOrFail($request->id);

            $user->update([
                'password' => Hash::make($request->newpassword),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Password berhasil diperbaharui');
    }

    public function updateStatusPembeli(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required'
            ]);

            $update = Users_Pelanggan::findOrFail($request->id);
            if ($update->is_active == 0) {
                $update->update([
                    'is_active' => 1,
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta')
                ]);
            } else {
                $update->update([
                    'is_active' => 0,
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta')
                ]);
            }
            
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Status berhasil diperbaharui');
    }
}
