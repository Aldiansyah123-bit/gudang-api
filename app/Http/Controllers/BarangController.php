<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();

        $brg = Barang::with('user','category','suplier', 'gudang')
              ->when(($auth && $auth->role_id!=1), function($q) use ($auth){
                  return $q->where('user_id', $auth->id);
              })
              ->orderBy('id', 'DESC')
              ->get();
        return response()->json(['data' => $brg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category_id'   => 'required',
            'suplier_id'    => 'required',
            'gudang_id'     => 'required',
            'name'          => 'required',
            'stock'         => 'required',
            'note_jual'     => 'required',
            'note_beli'     => 'required',
            'expla'         => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        $auth = auth()->user();

        $data = Barang::create([
                    'user_id'       => $auth->id,
                    'category_id'   => $request->category_id,
                    'suplier_id'    => $request->suplier_id,
                    'gudang_id'     => $request->gudang_id,
                    'name'          => $request->name,
                    'stock'         => $request->stock,
                    'note_jual'     => $request->note_jual,
                    'note_beli'     => $request->note_beli,
                    'expla'         => $request->expla
                ]);

        return response()->json(['data' => $data, 'message' => 'Data Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
