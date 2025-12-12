<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;
use App\Models\User;

class PerawatController extends Controller
{
    public function index()
    {
        $data = Perawat::with('user')->orderBy('id_perawat','ASC')->get();
        return view('admin.perawat.index', compact('data'));
    }

    public function create()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role.idrole', 3);
        })->get();

        return view('admin.perawat.create', compact('users'));
    }

    public function store(Request $request)
    {
        Perawat::create($request->all());

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Perawat::findOrFail($id);
        $users = User::whereHas('roles', function($q){
            $q->where('role.idrole', 3);
        })->get();


        return view('admin.perawat.edit', compact('data','users'));
    }

    public function update(Request $request, $id)
    {
        $data = Perawat::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $data = Perawat::findOrFail($id);
        $data->deleted_by = auth()->id(); 
        $data->save();

        $data->delete(); 

        return redirect()->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil dihapus!');
    }
}
