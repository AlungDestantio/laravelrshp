<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\RoleUser;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::with('user')->orderBy('idpemilik', 'ASC')->get();
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

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5,
                'status' => 1
            ]);

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


            $user = $pemilik->user; 
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
            ]);



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
        $data = Pemilik::findOrFail($id);
        $data->deleted_by = auth()->id(); 
        $data->save();

        $data->delete(); 

        return redirect()->route('resepsionis.registrasi-pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus!');
    }

}
