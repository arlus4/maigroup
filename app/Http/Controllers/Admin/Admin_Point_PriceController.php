<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Point_Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Admin_Point_PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pointPrices = Point_Price::select(
            'point_prices.id',
            'point_prices.point',
            'point_prices.price',
            'creator.name as users_create',
            'updater.name as users_update'
        )
        ->leftJoin('users_login as creator', 'point_prices.users_created', '=', 'creator.id')
        ->leftJoin('users_login as updater', 'point_prices.users_updated', '=', 'updater.id')
        ->orderBy('point_prices.point')
        ->get();

        return view('master.settings.point_price.point_price', [
            'pointPrices' => $pointPrices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'point' => 'required',
                'price' => 'required'
            ]);

            Point_Price::create([
                'point' => intval(str_replace(',', '', $request->point)),
                'price' => intval(str_replace(',', '', $request->price)),
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'users_created' => Auth::user()->id,
                'users_updated' => Auth::user()->id
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Point Price Berhasil ditambahkan.'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'Point Price Gagal ditambahkan. ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point_Price  $point_Price
     * @return \Illuminate\Http\Response
     */
    public function show(Point_Price $point_Price)
    {
        $pointPrices = Point_Price::select(
            'point_prices.id',
            'point_prices.point',
            'point_prices.price',
            'point_prices.created_at',
            'point_prices.updated_at',
            'creator.name as users_create',
            'updater.name as users_update'
        )
        ->leftJoin('users_login as creator', 'point_prices.users_created', '=', 'creator.id')
        ->leftJoin('users_login as updater', 'point_prices.users_updated', '=', 'updater.id')
        ->where('point_prices.id', $point_Price->id)
        ->first();

        $datas = [
            'data' => $pointPrices
        ];
    
        return response()->json($datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'point_update' => 'required',
                'price_update' => 'required'
            ]);

            $updated = Point_Price::find($request->id);

            $updated->update([
                'point' => intval(str_replace(',', '', $request->point_update)),
                'price' => intval(str_replace(',', '', $request->price_update)),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'users_updated' => Auth::user()->id
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Point Price Berhasil diubah.'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'Point Price Gagal diubah. ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            Point_Price::find($request->id)->delete();

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Point berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
    }
}
