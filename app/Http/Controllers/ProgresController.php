<?php

namespace App\Http\Controllers;
use App\Models\Progres;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function store(Request $request, $pengaduanId)
    {
        $request->validate([
            'foto_progres' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto_progres')->store('progres', 'public');

        Progres::create([
            'pengaduan_id' => $pengaduanId,
            'foto_progres' => $path,
        ]);

        return back()->with('success', 'Foto progres berhasil dikirim!');
    }

    public function create($pengaduanId)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduanId);
        return view('Form-Progres.Form-progres', compact('pengaduan'));
    }

    public function showPerbaikanSelesaiDetail($id)
    {
        $pengaduan = Pengaduan::with('progres')->findOrFail($id); // include relasi progres
        $role = request()->segment(2); // Ambil segment kedua dari URL

        if ($role === 'Admin') {
            return view('Perbaikan-selesai-detail.Perbaikan-selesai-detail(Admin)', compact('pengaduan'));
        } elseif ($role === 'Petugas') {
            return view('Perbaikan-selesai-detail.Perbaikan-selesai-detail(Petugas)', compact('pengaduan'));
        } else {
            return view('Perbaikan-selesai-detail.Perbaikan-selesai-detail(Masyarakat)', compact('pengaduan'));
        }
    }
}
