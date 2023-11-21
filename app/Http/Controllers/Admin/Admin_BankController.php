<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ref_Bank;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class Admin_BankController extends Controller
{
    public function index()
    {
        $dataBank = Ref_Bank::select(
            'id',
            'nama_bank',
            'nomor_rekening',
            'icon_bank',
            'path_icon_bank'
        )->get();

        return view('master.bank.daftarBank',[
            'dataBank' => $dataBank,
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'nama_bank'        => 'required|max:40',
                'nomor_rekening'   => 'required|max:40',
            ]);

            if ($request->hasFile('icon_bank')) {
                $request->validate([
                    'icon_bank' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'icon_bank.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/icon_bank directory
                $imageName = Str::random(10) . '_' . $request->icon_bank->getClientOriginalName();

                $request->icon_bank->storeAs('icon_bank/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/icon_bank/' . $imageName;
            } else {
                $imageName = null;
                $imagePath = null;
            }

            Ref_Bank::updateOrCreate([
                'id'                => $request->idBank,
            ],[
                'nama_bank'         => $request->nama_bank,
                'nomor_rekening'    => $request->nomor_rekening,
                'icon_bank'         => $imageName,
                'path_icon_bank'    => $imagePath
            ]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Menambah/Mengubah Bank!'
            ]);

        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e);

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal Menambah Bank. Silakan coba lagi.'
            ]);
        }
    }

    public function edit(Request $request)
    {
        return response()->json(Ref_Bank::find($request->id));
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $dataBank = Ref_Bank::find($request->id);
            
            if(file_exists(public_path().'/storage/icon_bank/'.$dataBank->icon_bank)) {
                unlink(public_path().'/storage/icon_bank/'.$dataBank->icon_bank);
            }
            
            $dataBank->delete();

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Data bank berhasil dihapus.'
            ]);

        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging
    
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data bank.'
            ]);
        }

    }
}
