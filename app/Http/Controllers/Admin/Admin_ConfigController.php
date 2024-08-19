<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Ref_Config;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Admin_ConfigController extends Controller
{
    public function index(): View
    {
        return view('master.settings.config.index');
    }

    public function get_dataConfig(): JsonResponse
    {
        if (!empty(Auth::user()->id)) {
            $data = Ref_Config::select('id', 'code', 'id_value', 'value', 'sequence', 'description')->get();

            $datas = [
                'data' => $data
            ];

            return response()->json($datas);
        }
        return redirect()->route('login')->with('error', 'Silahkan Login Terlebih Dahulu');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'code'          => 'required',
                'id_value'      => 'required',
                'value'         => 'required',
                'sequence'      => 'required',
                'description'   => 'required'
            ]);

            Ref_Config::create([
                'code'          => $request->code,
                'id_value'      => $request->id_value,
                'value'         => $request->value,
                'sequence'      => $request->sequence,
                'description'   => $request->description,
                'created_at'    => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'    => Carbon::now()->timezone('Asia/Jakarta'),
            ]);

            DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Configuration Has Been Added.');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Configuration Fail to Added :' . $th->getMessage());
        }
    }

    public function edit(Request $request): JsonResponse
    {
        return response()->json(Ref_Config::find($request->id));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'code_edit'          => 'required',
                'id_value_edit'      => 'required',
                'value_edit'         => 'required',
                'sequence_edit'      => 'required',
                'description_edit'   => 'required'
            ]);

            Ref_Config::find($request->id)->update([
                'code'          => $request->code_edit,
                'id_value'      => $request->id_value_edit,
                'value'         => $request->value_edit,
                'sequence'      => $request->sequence_edit,
                'description'   => $request->description_edit,
                'updated_at'    => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Configuration Has Been Updated'
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status' => 'error',
                'message' => 'Something went Wrong: ' . $th->getMessage()
            ], 500);
        }
    }
}
