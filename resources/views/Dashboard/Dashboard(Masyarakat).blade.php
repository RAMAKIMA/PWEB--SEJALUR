<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard (Masyarakat)</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black">

    <!-- Bagian Navbar -->
    <nav class="bg-yellow-400 text-black px-8 py-4 flex items-center justify-between shadow-md sticky top-0 z-50">
    <div class="flex items-center">
        <img src="/img/Logo-SEJALUR-Hitam.png" alt="Logo SEJALUR Hitam" class="h-10" />
    </div>
    <ul class="flex gap-6 font-semibold items-center pr-[7.5em]">
        <li><a href="{{ route('Pengaduan.masyarakat') }}" class="hover:underline">Pengaduan</a></li>

        <!-- Dropdown Perbaikan -->
        <li class="relative">
        <button id="dropdownToggle" class="hover:underline flex items-center gap-1">
            Perbaikan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdownMenu" class="hidden absolute bg-white text-black mt-2 shadow-lg rounded-lg z-50 w-48">
            <li><a href="{{ route('Perbaikan.dikerjakan.masyarakat') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dikerjakan</a></li>
            <li><a href="{{ route('Perbaikan.selesai.masyarakat') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Selesai</a></li>
        </ul>
        </li>

        <li><a href="{{ route('Dashboard.masyarakat') }}" class="hover:underline">Dashboard</a></li>
    </ul>

    <!-- Dropdown Profil -->
    <div class="relative  pr-8">
        <button id="profileBtn" class="flex items-center justify-center w-9 h-9 rounded-full bg-white font-bold text-black border-2 border-black">
        {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 1)) }}
        </button>

        <!-- Menu Dropdown Profil -->
        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg z-50">
        <a href="{{ route('Profil.masyarakat') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Profil</a>
        <form method="POST" action="{{ route('Logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Logout</button>
        </form>
        </div>
    </div>
    </nav>

    <!-- Isi Konten -->
    <div class="p-8">
        <div class="pl-60 mb-6">
            <div class="flex items-center gap-0.5">
                <h1 class="font-bold text-4xl">Dashboard</h1>
                <img src="/img/cone.png" alt="Cone" class="h-10 mb-[6.5px] ">
            </div>
        </div>

        <!-- Status Ringkasan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 pl-60 pr-60">
            @php
                $belumDiperbaiki = 0;
                $sedangDiperbaiki = 0;
                $selesai = 0;

                foreach ($pengaduans as $item) {
                    if ($item->status === 'Belum Diperbaiki') {
                        $belumDiperbaiki++;
                    } elseif ($item->status === 'Sedang Diperbaiki') {
                        $sedangDiperbaiki++;
                    } elseif ($item->status === 'Selesai') {
                        $selesai++;
                    }
                }
            @endphp
            <!-- Belum Diperbaiki -->
            <div class="bg-gray-900 text-white p-6 rounded-xl shadow-md">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" />
                </svg>
                <h2 class="font-semibold">Belum diperbaiki</h2>
            </div>
            <p class="text-lg">{{ $belumDiperbaiki }} Jalan</p>
            </div>

            <!-- Sedang Diperbaiki -->
            <div class="bg-yellow-400 text-black p-6 rounded-xl shadow-md">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                <h2 class="font-semibold">Sedang diperbaiki</h2>
            </div>
            <p class="text-lg">{{ $sedangDiperbaiki }} Jalan</p>
            </div>

            <!-- Selesai -->
            <div class="bg-orange-500 text-white p-6 rounded-xl shadow-md">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19l4 -14" /><path d="M16 5l4 14" /><path d="M12 8v-2" /><path d="M12 13v-2" /><path d="M12 18v-2" />
                </svg>
                <h2 class="font-semibold">Selesai</h2>
            </div>
            <p class="text-lg">{{ $selesai }} Jalan</p>
            </div>
        </div>

        <!-- Table -->
        <div class="relative flex flex-col items-center justify-center text-center">
            <div class="mt-10 w-[90%] max-w-6xl bg-white text-black rounded-2xl shadow-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-black border-b">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Jenis Kerusakan</th>
                    <th class="px-4 py-3 text-left">Lokasi</th>
                    <th class="px-4 py-3 text-left">Tanggal Pengaduan</th>
                    {{-- <th class="px-4 py-3 text-left">Detail Pengaduan</th> --}}
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pengaduans as $index => $item)
                    <tr class="border-t">
                    <td class="px-4 py-3 text-left bg-gray-100">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 text-left">{{ $item->jenis_kerusakan }}</td>
                    <td class="px-4 py-3 text-left">
                        <a href="{{ $item->lokasi_kerusakan }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                        {{ $item->lokasi_kerusakan }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-left">{{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d-m-Y') }}</td>
                    {{-- <td class="px-4 py-3 text-blue-600 hover:underline text-left">
                        <a href="{{ route('Pengaduan.detail.masyarakat', ['id' => $item->id]) }}">Lihat detail</a>
                    </td> --}}
                    <td class="px-4 py-3 text-left">
                        @php
                            $statusColor = match($item->status) {
                                'Belum Diperbaiki' => 'bg-gray-900 text-white',
                                'Sedang Diperbaiki' => 'bg-yellow-400 text-black',
                                'Selesai' => 'bg-orange-500 text-white',
                                default => 'bg-gray-300 text-black'
                            };
                        @endphp
                        <span class="{{ $statusColor }} text-xs font-bold px-3 py-1 rounded-full">
                        {{ $item->status }}
                        </span>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
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
    </script>

</html>
