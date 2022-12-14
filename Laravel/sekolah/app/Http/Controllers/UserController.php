<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::query()
    //         ->limit(5)
    //         ->offset(0)
    //         ->get();

    //     return view("users.list", compact('users'));
    // }
    public function edit($id)
    {
        $user = User::query()
                    ->where('id', $id)
                    ->first();
        $sekolah = Sekolah::query()->get();

        return view("users.show", compact('user', 'sekolah'));
    }
    public function store(UserFormRequest $request)
    {

        // dd($request->all());
        $payload = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'tingkatan' => $request->input('tingkatan'),
            'nisn' => $request->input('nisn'),
            'alamat' => $request->input('alamat'),
            'gender' => $request->input('gender'),
            'keterangan' => $request->input('keterangan'),
            'role' => $request->input('role'),
            'id_sekolah' => $request->input('id_sekolah'),
        ];

        User::create($payload);
        return redirect()->back()->with('success', 'Successfully created a new user');
    } // menambahkan data
    public function create()
    {
        $sekolah = Sekolah::query()->get();
        return view('users.create', compact('sekolah'));
    } // menampilkan halaman membuat data
    public function update(UserFormRequest $request, $id = null)
    {
        // dd($request->all());    
        $user = User::query()
            ->where('id', $id)
            ->first()
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'tingkatan' => $request->input('tingkatan'),
                'nisn' => $request->input('nisn'),
                'alamat' => $request->input('alamat'),
                'gender' => $request->input('gender'),
                'keterangan' => $request->input('keterangan'),
                'role' => $request->input('role'),
                'id_sekolah' => $request->input('id_sekolah'),
            ]);
        return redirect()->back()->with('success', 'Successfully updated the user');
    } // mengupdate data
    public function destroy ($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->back();
    }
}
