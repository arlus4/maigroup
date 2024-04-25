<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\FaQ_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_FaQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq_categories()
    {
        return view('master.settings.faq.categories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faq_category_store(Request $request)
    {
        try {
            $request->validate([
                'users_type' => 'required',
                'name'       => 'required',
                'slug'       => 'required',
            ]);
            
            DB::beginTransaction(); // Begin Transaction

            FaQ_Category::create([
                'users_type' => $request->users_type,
                'name'       => $request->name,
                'slug'       => $request->slug,
            ]);
            
            DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Berhasil Menambah Kategori Baru');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function get_data_faq_category()
    {
        $data = FaQ_Category::all();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaQ_Category  $faq_cat
     * @return \Illuminate\Http\Response
     */
    public function faq_category_edit(Request $request)
    {
        return response()->json(FaQ_Category::find($request->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FaQ_Category  $faq_cat
     * @return \Illuminate\Http\Response
     */
    public function faq_category_update(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction
        
            $request->validate([
                'users_type'         => 'required',
                'nama_category_edit' => 'required',
                'slug_edit'          => 'required|unique:faqs_categories,slug,' . $request->id,
            ]);
        
            FaQ_Category::find($request->id)->update([
                'users_type'    => $request->users_type,
                'name'          => $request->nama_category_edit,
                'slug'          => $request->slug_edit,
                'updated_at'    => Carbon::now()->timezone('Asia/Jakarta')
            ]);
        
            DB::commit(); // Commit the transaction
        
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Mengubah Kategori'
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception
        
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaQ_Category  $faq_cat
     * @return \Illuminate\Http\Response
     */
    public function faq_category_delete(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            FaQ_Category::find($request->id)->delete();

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Data Kategori berhasil dihapus'
            ]);

        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq_user_pembeli()
    {
        return view('master.settings.faq.users.pembeli');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq_user_owner()
    {
        return view('master.settings.faq.users.owner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq_user_pegawai()
    {
        return view('master.settings.faq.users.pegawai');
    }


    public function catFaQSlug(Request $request)
    {
        $slug = SlugService::createSlug(FaQ_Category::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
