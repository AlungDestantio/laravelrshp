<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;

class DokterController extends Controller
{
    public function index()
    {
        $data = Dokter::with('user')->orderBy('id_dokter','ASC')->get();
        return view('admin.dokter.index', compact('data'));
    }

    public function create()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role.idrole', 2);
        })->get();

        return view('admin.dokter.create', compact('users'));
    }


    public function store(Request $request)
    {
        Dokter::create($request->all());

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Dokter::with('user')->findOrFail($id);
        $users = User::whereHas('roles', function($q){
            $q->where('role.idrole', 2);
        })->get();

        return view('admin.dokter.edit', compact('data', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = Dokter::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = Dokter::findOrFail($id);
        $data->deleted_by = auth()->id(); 
        $data->save();

        $data->delete(); 

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus!');
    }
}
