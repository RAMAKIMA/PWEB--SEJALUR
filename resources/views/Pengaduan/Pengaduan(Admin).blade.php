<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengaduan - SEJALUR</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-white">

    <!-- Bagian Navbar -->
    <nav class="bg-yellow-400 text-black px-8 py-4 flex items-center justify-between shadow-md sticky top-0 z-50">
    <div class="flex items-center">
        <img src="/img/Logo-SEJALUR-Hitam.png" alt="Logo SEJALUR Hitam" class="h-10" />
    </div>
    <ul class="flex gap-6 font-semibold items-center pr-[7.5em]">
        <li><a href="{{ route('Pengaduan.admin') }}" class="hover:underline">Pengaduan</a></li>

        <!-- Dropdown Perbaikan -->
        <li class="relative">
        <button id="dropdownToggle" class="hover:underline flex items-center gap-1">
            Perbaikan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdownMenu" class="hidden absolute bg-white text-black mt-2 shadow-lg rounded-lg z-50 w-48">
            <li><a href="{{ route('Perbaikan.dikerjakan.admin') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dikerjakan</a></li>
            <li><a href="{{ route('Perbaikan.selesai.admin') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Selesai</a></li>
        </ul>
        </li>

        <li><a href="{{ route('Dashboard.admin') }}" class="hover:underline">Dashboard</a></li>
    </ul>

    <!-- Dropdown Profil -->
    <div class="relative pr-8">
        <button id="profileBtn" class="flex items-center justify-center w-9 h-9 rounded-full bg-white font-bold text-black border-2 border-black">
        {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 1)) }}
        </button>

        <!-- Menu Dropdown Profil -->
        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg z-50">
        <a href="{{ route('Profil.admin') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Profil</a>
        <form method="POST" action="{{ route('Logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Logout</button>
        </form>
        </div>
    </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-[91vh] bg-cover bg-center" style="background-image: url('https://images.pexels.com/photos/12228684/pexels-photo-12228684.jpeg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative flex flex-col items-center justify-center text-center">
        <h1 class="text-5xl font-bold pt-28 text-center">Pengaduan</h1>

        <!-- Table -->
        <div class="mt-10 w-[90%] max-w-6xl bg-white text-black rounded-2xl shadow-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-white text-gray-700 border-b">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Jenis Kerusakan</th>
                <th class="px-4 py-3 text-left">Lokasi</th>
                <th class="px-4 py-3 text-left">Tanggal Pengaduan</th>
                <th class="px-4 py-3 text-left">Detail Pengaduan</th>
                {{-- <th class="px-4 py-3 text-left">Status</th> --}}
                <th class="px-4 py-3 text-left">Petugas</th>
            </tr>
            </thead>
            <tbody>
                @foreach($pengaduans as $index => $pengaduan)
                <tr class="border-t">
                    <td class="px-4 py-3 text-left">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 text-left">{{ $pengaduan->jenis_kerusakan }}</td>
                    <td class="px-4 py-3 text-left">
                        <a href="{{ $pengaduan->lokasi_kerusakan }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                            {{ $pengaduan->lokasi_kerusakan }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-left">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d-m-Y') }}</td>
                    <td class="px-4 py-3 text-blue-600 hover:underline text-left">
                        <a href="{{ route('Pengaduan.detail.admin', ['id' => $pengaduan->id]) }}">Lihat detail</a>
                    </td>

                    {{-- Form status --}}
                    {{-- <td class="px-4 py-3 text-left">
                        <form method="POST" action="{{ route('pengaduan.updateStatus', $pengaduan->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()"
                                class="bg-yellow-400 text-black text-xs font-bold px-3 py-1 pr-6 rounded-full appearance-none"
                                style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'black\' height=\'16\' viewBox=\'0 0 24 24\' width=\'16\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/></svg>'); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1rem;">
                                <option class="bg-white" value="Belum Diperbaiki" {{ $pengaduan->status == 'Belum Diperbaiki' ? 'selected' : '' }}>Belum diperbaiki</option>
                                <option class="bg-white" value="Sedang diperbaiki" {{ $pengaduan->status == 'Sedang diperbaiki' ? 'selected' : '' }}>Sedang diperbaiki</option>
                                <option class="bg-white" value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td> --}}

                    {{-- Form petugas --}}
                    <td class="px-4 py-3 text-left">
                        <form method="POST" action="{{ route('pengaduan.updatePetugas', $pengaduan->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="petugas" onchange="this.form.submit()"
                                class="bg-yellow-400 text-black text-xs font-bold px-3 py-1 pr-6 rounded-full appearance-none"
                                style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'black\' height=\'16\' viewBox=\'0 0 24 24\' width=\'16\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/></svg>'); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1rem;">
                                <option class="bg-white" value="">Pilih Petugas</option>
                                @foreach($petugasList as $petugas)
                                    <option class="bg-white" value="{{ $petugas }}" {{ $pengaduan->petugas == $petugas ? 'selected' : '' }}>
                                        {{ $petugas }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </section>

</body>
    <!-- Script for dropdown toggle -->
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

        function toggleInput(inputId) {
            const inputDiv = document.getElementById(inputId);
            inputDiv.classList.toggle('hidden');
        }

        function simpanPetugas(selectId, inputId, inputDivId) {
            const select = document.getElementById(selectId);
            const input = document.getElementById(inputId);
            const inputDiv = document.getElementById(inputDivId);
            const namaBaru = input.value.trim();

            if (namaBaru !== "") {
                const option = document.createElement("option");
                option.value = namaBaru;
                option.text = namaBaru;
                option.classList.add("bg-white");
                select.add(option);
                select.value = namaBaru;
                input.value = "";
                inputDiv.classList.add('hidden');
            } else {
                alert("Nama petugas tidak boleh kosong.");
            }
        }
    </script>

</html>
