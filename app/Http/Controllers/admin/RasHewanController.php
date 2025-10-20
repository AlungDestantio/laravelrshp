<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $data = RasHewan::with('jenis')->orderBy('idras_hewan')->get();
        $jenis = JenisHewan::all();
        return view('admin.rashewan.index', compact('data','jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
        ]);
        RasHewan::create($request->only('nama_ras','idjenis_hewan'));
        return redirect()->route('admin.ras-hewan.index')->with('success','Ras hewan ditambahkan.');
    }

    public function edit($id)
    {
        $item = RasHewan::findOrFail($id);
        $jenis = JenisHewan::all();
        return view('admin.rashewan.edit', compact('item','jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
        ]);
        $item = RasHewan::findOrFail($id);
        $item->update($request->only('nama_ras','idjenis_hewan'));
        return redirect()->route('admin.ras-hewan.index')->with('success','Ras hewan diperbarui.');
    }

    public function destroy($id)
    {
        RasHewan::findOrFail($id)->delete();
        return redirect()->route('admin.ras-hewan.index')->with('success','Ras hewan dihapus.');
    }
}
