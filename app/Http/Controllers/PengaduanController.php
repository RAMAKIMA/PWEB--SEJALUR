<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Account;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'email' => 'required|email',
            'tanggal_pengaduan' => 'required|date',
            'jenis_kerusakan' => 'required',
            'lokasi_kerusakan' => 'required',
            'foto_kerusakan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto_kerusakan')->store('pengaduan', 'public');

        Pengaduan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'email' => $request->email,
            'tanggal_pengaduan' => $request->tanggal_pengaduan,
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'lokasi_kerusakan' => $request->lokasi_kerusakan,
            'foto_kerusakan' => $path,
            'status' => 'Belum Diperbaiki', // Status default
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function indexAdmin()
    {
        $pengaduans = Pengaduan::whereIn('status', ['Belum Diperbaiki', 'Sedang diperbaiki'])->get();
        $petugasList = Account::where('role', 'petugas')->pluck('username'); // Ambil nama semua petugas
        return view('Pengaduan/Pengaduan(Admin)', compact('pengaduans', 'petugasList'));
    }

    public function indexMasyarakat()
    {
        $pengaduans = Pengaduan::whereIn('status', ['Belum Diperbaiki', 'Sedang diperbaiki'])->get();
        return view('Pengaduan/Pengaduan(Masyarakat)', compact('pengaduans'));
    }

    public function indexPetugas()
    {
        $pengaduans = Pengaduan::whereIn('status', ['Belum Diperbaiki', 'Sedang diperbaiki'])->get();
        return view('Pengaduan/Pengaduan(Petugas)', compact('pengaduans'));
    }

    public function indexDashboardAdmin()
    {
        $pengaduans = Pengaduan::All();
        $petugasList = Account::where('role', 'petugas')->pluck('username'); // Ambil nama semua petugas

        // Tambahkan jumlah berdasarkan status
        $belumDiperbaiki = Pengaduan::where('status', 'Belum Diperbaiki')->count();
        $sedangDiperbaiki = Pengaduan::where('status', 'Sedang Diperbaiki')->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();

        return view('Dashboard/Dashboard(Admin)', compact('pengaduans', 'petugasList'));
    }

    public function indexDashboardMasyarakat()
    {
        $pengaduans = Pengaduan::All();

        // Tambahkan jumlah berdasarkan status
        $belumDiperbaiki = Pengaduan::where('status', 'Belum Diperbaiki')->count();
        $sedangDiperbaiki = Pengaduan::where('status', 'Sedang Diperbaiki')->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();

        return view('Dashboard/Dashboard(Masyarakat)', compact('pengaduans'));
    }

    public function indexDashboardPetugas()
    {
        $pengaduans = Pengaduan::All();

        // Tambahkan jumlah berdasarkan status
        $belumDiperbaiki = Pengaduan::where('status', 'Belum Diperbaiki')->count();
        $sedangDiperbaiki = Pengaduan::where('status', 'Sedang Diperbaiki')->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();

        return view('Dashboard/Dashboard(Petugas)', compact('pengaduans'));
    }

    public function showPengaduanDetail($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $role = request()->segment(2); // Contoh: 'Admin' dari /Pengaduan-detail/Admin/{id}

        if ($role === 'Admin') {
            return view('Pengaduan-detail.Pengaduan-detail(Admin)', compact('pengaduan'));
        } elseif ($role === 'Petugas') {
            return view('Pengaduan-detail.Pengaduan-detail(Petugas)', compact('pengaduan'));
        } else {
            return view('Pengaduan-detail.Pengaduan-detail(Masyarakat)', compact('pengaduan'));
        }
    }

    public function showPerbaikanDikerjakan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $role = request()->segment(2); // Contoh: 'Admin' dari /Pengaduan-detail/Admin/{id}

        if ($role === 'Admin') {
            return view('Perbaikan-dikerjakan-detail.Perbaikan-dikerjakan-detail(Admin)', compact('pengaduan'));
        } elseif ($role === 'Petugas') {
            return view('Perbaikan-dikerjakan-detail.Perbaikan-dikerjakan-detail(Petugas)', compact('pengaduan'));
        } else {
            return view('Perbaikan-dikerjakan-detail.Perbaikan-dikerjakan-detail(Masyarakat)', compact('pengaduan'));
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->input('status');
        $pengaduan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function updatePetugas(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->petugas = $request->input('petugas');
        $pengaduan->save();

        return back()->with('success', 'Petugas berhasil diperbarui.');
    }
}
