<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::with('user')->orderBy('idpemilik', 'ASC')->get();
        return view('admin.pemilik.index', compact('data'));
    }

    public function create()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role.idrole', 5);
        })->get();

        return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        Pemilik::create($request->all());

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Pemilik::findOrFail($id);
        $users = User::whereHas('roles', function($q){
            $q->where('role.idrole', 5);
        })->get();


        return view('admin.pemilik.edit', compact('data', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = Pemilik::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = Pemilik::findOrFail($id);
        $data->deleted_by = auth()->id(); 
        $data->save();

        $data->delete(); 

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus!');
    }

}
