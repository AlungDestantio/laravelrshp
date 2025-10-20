<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with('ras.jenis')->orderBy('idpet')->get();
        $ras = RasHewan::all();
        return view('admin.pet.index', compact('data','ras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:M,F',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ]);
        Pet::create($request->only(['nama','tanggal_lahir','warna_tanda','jenis_kelamin','idras_hewan','idpemilik']));
        return redirect()->route('admin.pet.index')->with('success','Pet ditambahkan.');
    }

    public function edit($id)
    {
        $item = Pet::findOrFail($id);
        $ras = RasHewan::all();
        return view('admin.pet.edit', compact('item','ras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:M,F',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ]);
        $item = Pet::findOrFail($id);
        $item->update($request->only(['nama','tanggal_lahir','warna_tanda','jenis_kelamin','idras_hewan','idpemilik']));
        return redirect()->route('admin.pet.index')->with('success','Pet diperbarui.');
    }

    public function destroy($id)
    {
        Pet::findOrFail($id)->delete();
        return redirect()->route('admin.pet.index')->with('success','Pet dihapus.');
    }
}
