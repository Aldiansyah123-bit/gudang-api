<?php

namespace App\Http\Controllers;

use App\Models\Barangkeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();

        $data = Barangkeluar::with('user','barang','category', 'minimarket','gudang')
               ->when(($auth && $auth->role_id!=1), function ($q) use ($auth){
                   return $q->where('user_id', $auth->id);
               })
               ->orderBy('id', 'DESC')
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
        $validator = Validator::make($request->all(), [
            'barang_id'     => 'required',
            'catbarang_id'  => 'required',
            'minimarket_id' => 'required',
            'gudang_id'     => 'required',
            'qty'           => 'required',
            'foto'          => 'required',
            'status'        => 'required',
            'date'          => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        $file       = $request->foto;
        $filename   = $file->getClientOriginalName();
        $file->move(public_path('/storage/barang',$filename));
        // $file = Request()->foto;
        // $filename = $file->getClientOriginalName();
        // $file->move(public_path('/storage/profile-photos'),$filename);

        $auth = auth()->user();

        $data = Barangkeluar::create([
            'user_id'       => $auth->id,
            'barang_id'     => $request->barang_id,
            'catbarang_id'  => $request->catbarang_id,
            'minimarket_id' => $request->minimarket_id,
            'gudang_id'     => $request->gudang_id,
            'qty'           => $request->qty,
            'foto'          => $filename,
            'status'        => $request->status,
            'date'          => $request->date,
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
