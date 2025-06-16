<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pengaduan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Bagian Navbar -->
  <nav class="bg-yellow-400 text-black px-8 py-4 flex items-center justify-between shadow-md sticky top-0 z-50">
    <div class="flex items-center">
        <img src="/img/Logo-SEJALUR-Hitam.png" alt="Logo SEJALUR Hitam" class="h-10" />
    </div>
    <ul class="flex gap-6 font-semibold items-center pr-[7.5em]">
        <li><a href="{{ route('Pengaduan.petugas') }}" class="hover:underline">Pengaduan</a></li>

        <!-- Dropdown Perbaikan -->
        <li class="relative">
        <button id="dropdownToggle" class="hover:underline flex items-center gap-1">
            Perbaikan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdownMenu" class="hidden absolute bg-white text-black mt-2 shadow-lg rounded-lg z-50 w-48">
            <li><a href="{{ route('Perbaikan.dikerjakan.petugas') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dikerjakan</a></li>
            <li><a href="{{ route('Perbaikan.selesai.petugas') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Selesai</a></li>
        </ul>
        </li>

        <li><a href="{{ route('Dashboard.petugas') }}" class="hover:underline">Dashboard</a></li>
    </ul>

    <!-- Dropdown Profil -->
    <div class="relative  pr-8">
        <button id="profileBtn" class="flex items-center justify-center w-9 h-9 rounded-full bg-white font-bold text-black border-2 border-black">
        {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 1)) }}
        </button>

        <!-- Menu Dropdown Profil -->
        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg z-50">
        <a href="{{ route('Profil.petugas') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Profil</a>
        <form method="POST" action="{{ route('Logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Logout</button>
        </form>
        </div>
    </div>
  </nav>

  <!-- Konten Detail Pengaduan -->
  <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Detail Pengaduan</h2>

    <div class="flex flex-col md:flex-row md:gap-6 space-y-5 md:space-y-0">
    <!-- Kolom Kiri -->
        <div class="flex-1 space-y-5">
            <div>
            <label class="block font-medium text-sm mb-1 text-gray-700">Nama Pelapor<span class="text-red-500">*</span></label>
            <p class="bg-gray-100 px-4 py-2 rounded border">{{ $pengaduan->nama_pelapor }}</p>
            </div>

            <div>
            <label class="block font-medium text-sm mb-1 text-gray-700">Email<span class="text-red-500">*</span></label>
            <p class="bg-gray-100 px-4 py-2 rounded border">{{ $pengaduan->email }}</p>
            </div>

            <div>
            <label class="block font-medium text-sm mb-1 text-gray-700">Tanggal Pengaduan<span class="text-red-500">*</span></label>
            <p class="bg-gray-100 px-4 py-2 rounded border">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d-m-Y') }}</p>
            </div>

            <div>
            <label class="block font-medium text-sm mb-1 text-gray-700">Jenis Kerusakan<span class="text-red-500">*</span></label>
            <p class="bg-gray-100 px-4 py-2 rounded border">{{ $pengaduan->jenis_kerusakan }}</p>
            </div>

            <div>
            <label class="block font-medium text-sm mb-1 text-gray-700">Lokasi<span class="text-red-500">*</span></label>
            <p class="bg-gray-100 px-4 py-2 rounded border">{{ $pengaduan->lokasi_kerusakan }}</p>
            </div>

            <div>
            <label class="block font-medium text-sm mb-1 text-gray-700">
                Status<span class="text-red-500">*</span>
            </label>
            <span class="inline-block px-3 py-1 rounded text-sm font-semibold
                {{ $pengaduan->status == 'Selesai' ? 'bg-green-100 text-green-700' :
                ($pengaduan->status == 'Sedang diperbaiki' ? 'bg-orange-100 text-orange-700' :
                'bg-yellow-100 text-yellow-700') }}">
                {{ $pengaduan->status }}
            </span>
            </div>
        </div>

        <!-- Kolom Kanan: Foto Progres -->
        <div class="md:w-1/2">
            <label class="block font-medium text-sm mb-1 text-gray-700">Foto Progres</label>

            @if ($pengaduan->progres->count())
                <div class="space-y-4">
                    @foreach ($pengaduan->progres as $progres)
                        <img src="{{ asset('storage/' . $progres->foto_progres) }}" alt="Foto Progres" class="w-full rounded shadow border">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Belum ada foto progres</p>
            @endif
        </div>
        </div>

        <div>
            <a href="{{ route('Perbaikan.selesai.petugas') }}" class="inline-block mt-4 bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md ml-[38em]">
            Kembali
            </a>
        </div>
    </div>
  </div>

  <!-- Script Dropdown -->
  <script>
    const dropdownToggle = document.getElementById('dropdownToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
      if (!dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });

    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    profileBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      profileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
      if (!profileMenu.contains(e.target)) {
        profileMenu.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
