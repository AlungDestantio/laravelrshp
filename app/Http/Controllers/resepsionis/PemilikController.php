<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::with('user')->orderBy('idpemilik', 'DESC')->get();
        return view('resepsionis.registrasipemilik.index', compact('data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|confirmed',
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat user baru
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // 2. Set role pemilik ke tabel role_user
            DB::table('role_user')->insert([
                'iduser' => $user->iduser,
                'idrole' => 4,   // role pemilik
                'status' => 1
            ]);

            // 3. Buat data pemilik
            Pemilik::create([
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
                'iduser' => $user->iduser,
            ]);

            DB::commit();
            return redirect()->route('resepsionis.registrasi-pemilik.index')
                ->with('success', 'Pemilik baru berhasil didaftarkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $data = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.registrasipemilik.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_wa' => 'required',
            'alamat' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $pemilik = Pemilik::findOrFail($id);

            // Update user
            User::where('iduser', $pemilik->iduser)->update([
                'nama' => $request->nama,
                'email' => $request->email,
            ]);

            // Update pemilik
            $pemilik->update([
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('resepsionis.registrasi-pemilik.index')
                ->with('success', 'Data pemilik berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pemilik = Pemilik::findOrFail($id);

            // Hapus user lalu pemilik
            User::where('iduser', $pemilik->iduser)->delete();
            $pemilik->delete();

            DB::commit();
            return redirect()->route('resepsionis.registrasi-pemilik.index')
                ->with('success', 'Data pemilik berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
