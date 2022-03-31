<?php

namespace App\Http\Controllers;

use App\Models\Stockminimarket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockminimarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        $data = Stockminimarket::with('user','barang', 'category', 'minimarket', 'gudang')
                ->when(($auth && $auth->role_id!=1), function ($q) use ($auth){
                    return $q->where('user_id', $auth->id);
                })
                ->orderBy('id','DESC')
                ->get();
        return response()->json(['data' => $data]);
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
            'barang_id'     => 'required',
            'catbarang_id'  => 'required',
            'minimarket_id' => 'required',
            'gudang_id'     => 'required',
            'stock'         => 'required',
            'status'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        $auth = auth()->user();

        $data = Stockminimarket::create([
            'user_id'       => $auth->id,
            'catbarang_id'  => $request->catbarang_id,
            'barang_id'     => $request->barang_id,
            'minimarket_id' => $request->minimarket_id,
            'gudang_id'     => $request->gudang_id,
            'stock'         => $request->stock,
            'status'        => $request->status,
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
