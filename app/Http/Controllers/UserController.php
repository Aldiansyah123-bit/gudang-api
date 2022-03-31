<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        //
        if (Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password,
        ])) {
            $auth = Auth::user();
            $success['name']        = $auth->name;
            $success['address']      = $auth->address;
            $success['avatar']      = $auth->avatar;
            $success['phone']       = $auth->phone;
            $success['role_id']     = $auth->role_id;
            $success['accessToken'] = $auth->createToken('nApp')->accessToken;

            return response()->json($success, $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Terjadi Kesalahan'],401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required|min:5',
            'address'   => 'required',
            'avatar'    => 'required',
            'phone'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        if ($request->hasFile('avatar')) {
            $name       = $request->file('avatar')->getClientOriginalName();
            $filename   = pathinfo($name, PATHINFO_FILENAME);
            $ext        = $request->file('avatar')->getClientOriginalExtension();
            $avatar     = $filename.'_'.time().'.'.$ext;
            $path       = $request->file('avatar')->move(public_path('/storage/ avatar'), $avatar);
        }
        else{
            $avatar     = null;
        }

        // $file = Request()->foto;
        // $filename = $file->getClientOriginalName();
        // $file->move(public_path('/storage/profile-photos'),$filename);

        $data = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'address'   => $request->address,
            'avatar'    => $avatar,
            'phone'     => $request->phone,
            'role_id'   => 2
        ]);

        return response()->json(['data' => $data, 'message' => 'Data Berhasil diSimpan'], $this->successStatus);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'address'   => 'required',
            'avatar'    => 'required',
            'phone'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        $user = User::where('id',$id)->first();
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                unlink(public_path('/storage/avatar').'/'.$user->avatar);
            }

            $name       = $request->file('avatar')->getClientOriginalName();
            $filename   = pathinfo($name, PATHINFO_FILENAME);
            $ext        = $request->file('avatar')->getClientOriginalExtension();
            $avatar     = $filename. '_' .time(). '.' .$ext;
            $path       = $request->file('avatar')->move(public_path('/storage/avatar'),$avatar);
        }else{
            $avatar  = null;
        }

        $data = User::findOrFail($id)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'address'   => $request->address,
            'avatar'    => $avatar,
            'phone'     => $request->phone,
        ]);

        return response()->json([
            'data'      => $data,
            'message'   => 'data berhasil disimpan'
        ],$this->successStatus);
    }

    public function index()
    {
        $user = User::all();
        return response()->json(['data' => $user]);
    }

    public function detail($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['data' => $data], $this->successStatus);
    }

    public function logout(Request $request)
    {
        // auth()->user()->token()->revoke();
        $log = $request->user()->token()->revoke();
        if ($log) {
            return response()->json(['pesan' => 'Logout Berhasil']);
        }

    }
}
