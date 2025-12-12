<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RoleUser;

class TemuDokterController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['pemilik.user'])->get();
        $dokter = RoleUser::with('user')->where('idrole', 2)->get();
        $antrean = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
                    ->whereDate('waktu_daftar', today())
                    ->orderBy('no_urut')
                    ->get();

        $riwayat = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
                    ->whereDate('waktu_daftar', '<', today())
                    ->orWhere('status', 'S')
                    ->orderByDesc('waktu_daftar')
                    ->limit(10)
                    ->get();

        return view('resepsionis.temudokter.index', compact('pet', 'dokter', 'antrean', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|integer',
            'idrole_user' => 'required|integer',
        ]);

        try {
            $today = today();
            $lastNoUrut = TemuDokter::whereDate('waktu_daftar', $today)->max('no_urut');
            $noUrutBaru = ($lastNoUrut ?? 0) + 1;

            TemuDokter::create([
                'idpet' => $request->idpet,
                'idrole_user' => $request->idrole_user,
                'no_urut' => $noUrutBaru,
                'waktu_daftar' => now(),
                'status' => 'M',
            ]);

            return redirect()->route('resepsionis.temu-dokter.store')
                ->with('success', 'Temu Dokter berhasil didaftarkan dengan No. Urut ' . $noUrutBaru);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambah antrean: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
         $request->validate([
            'status' => 'required|in:M,P,S',
        ]);

        try {
            $temu = TemuDokter::findOrFail($id);
            $temu->status = $request->status;
            $temu->save();

            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('success', 'Status antrean berhasil diubah ke "' . $this->getStatusLabel($request->status) . '".');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    private function getStatusLabel($status)
    {
        return match ($status) {
            'M' => 'Menunggu',
            'P' => 'Proses',
            'S' => 'Selesai',
            default => 'Tidak Diketahui',
        };
    }

    public function destroy($id)
    {
        $data = TemuDokter::findOrFail($id);


        $data->deleted_by = auth()->id();
        $data->save();


        $data->delete();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Data temu dokter berhasil dihapus!');
    }
}
