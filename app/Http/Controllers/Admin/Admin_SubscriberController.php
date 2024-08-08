<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class Admin_SubscriberController extends Controller
{
    public function index(): View
    {
        $subscribers = DB::table('roles')
        ->select(
            'permissions.id',
            DB::raw('UPPER(permissions.name) as name'),
            'permissions.amount'
        )
        ->leftJoin('role_has_permissions', 'role_has_permissions.role_id', 'roles.id')
        ->leftJoin('permissions', 'permissions.id', 'role_has_permissions.permission_id')
        ->where('roles.name', 'owner')
        ->get();

        return view('master.settings.subscribe.subscribe', [
            'subscribers' => $subscribers,
        ]);
    }

    public function subscriber_detail($id): JsonResponse
    {
        $data = DB::table('permissions')
        ->select(
            'permissions.id',
            DB::raw('UPPER(permissions.name) as name'),
            'permissions.description',
            'permissions.amount'
        )
        ->where('permissions.id', $id)
        ->first();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function subscriber_update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'id' => 'required',
                'amount_update' => 'required'
            ]);

            DB::table('permissions')
            ->where('id', $id)
            ->update([
                'amount'        => intval(str_replace(',', '', $request->amount_update)),
                'description'   => $request->description_update,
                'updated_at'    => Carbon::now()->timezone('Asia/Jakarta'),
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Subscribe Berhasil diubah.'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'Subscribe Gagal diubah. ' . $th->getMessage()
            ]);
        }
    }
}
