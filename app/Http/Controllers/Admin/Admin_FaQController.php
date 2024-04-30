<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\FaQ_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FaQ;
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

    public function get_data_faq_category()
    {
        $data = FaQ_Category::all();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
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
        $categories = FaQ_Category::where('users_type', 3)->get();
        return view('master.settings.faq.users.pembeli', [
            'categories' => $categories
        ]);
    }

    public function get_data_faq_user_pembeli()
    {
        $data = DB::table('faqs')
            ->select(
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs_categories.name as category_name',
            )
            ->leftJoin('faqs_categories', 'faqs.faqs_categories', 'faqs_categories.id')
            ->where('faqs_categories.users_type', 3)
            ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faq_user_pembeli_store(Request $request)
    {
        try {
            $request->validate([
                'faqs_categories' => 'required',
                'question'        => 'required',
                'answer'          => 'required',
            ]);

            DB::beginTransaction(); // Begin Transaction

            FaQ::create([
                'faqs_categories' => $request->faqs_categories,
                'question'        => $request->question,
                'answer'          => $request->answer,
            ]);

            DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Berhasil Menambah FaQ Pembeli Baru');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaQ  $faq
     * @return \Illuminate\Http\Response
     */
    public function faq_user_pembeli_edit(Request $request)
    {
        $data = DB::table('faqs')
            ->select(
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs_categories.name as category_name',
                'faqs_categories.id as category_id',
            )
            ->leftJoin('faqs_categories', 'faqs.faqs_categories', 'faqs_categories.id')
            ->where('faqs.id', $request->id)
            ->first();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaQ  $faq
     * @return \Illuminate\Http\Response
     */
    public function faq_user_pembeli_delete(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            FaQ::find($request->id)->delete();

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Data FaQ berhasil dihapus'
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
    public function faq_user_owner()
    {
        $categories = FaQ_Category::where('users_type', 2)->get();
        return view('master.settings.faq.users.owner', [
            'categories' => $categories
        ]);
    }

    public function get_data_faq_user_owner()
    {
        $data = DB::table('faqs')
            ->select(
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs_categories.name as category_name',
            )
            ->leftJoin('faqs_categories', 'faqs.faqs_categories', 'faqs_categories.id')
            ->where('faqs_categories.users_type', 2)
            ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faq_user_owner_store(Request $request)
    {
        try {
            $request->validate([
                'faqs_categories' => 'required',
                'question'        => 'required',
                'answer'          => 'required',
            ]);

            DB::beginTransaction(); // Begin Transaction

            FaQ::create([
                'faqs_categories' => $request->faqs_categories,
                'question'        => $request->question,
                'answer'          => $request->answer,
            ]);

            DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Berhasil Menambah FaQ Owner Baru');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaQ  $faq
     * @return \Illuminate\Http\Response
     */
    public function faq_user_owner_edit(Request $request)
    {
        $data = DB::table('faqs')
            ->select(
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs_categories.name as category_name',
                'faqs_categories.id as category_id',
            )
            ->leftJoin('faqs_categories', 'faqs.faqs_categories', 'faqs_categories.id')
            ->where('faqs.id', $request->id)
            ->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FaQ  $faq
     * @return \Illuminate\Http\Response
     */
    public function faq_user_owner_update(Request $request)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaQ  $faq
     * @return \Illuminate\Http\Response
     */
    public function faq_user_owner_delete(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            FaQ::find($request->id)->delete();

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Data FaQ berhasil dihapus'
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
