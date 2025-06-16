<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil (Masyarakat)</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

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

    <!-- Konten Profil -->
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
        @if (session('success'))
            <div id="successAlert" class="fixed top-5 right-5 flex items-center gap-3 bg-white border border-green-400 text-black px-5 py-3 rounded-lg shadow z-50 transition-all duration-300 ease-in-out">
                <!-- Icon centang -->
                <svg class="w-6 h-6 bg-green-200 rounded-full text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 13l4 4L19 7" />
                </svg>

                <!-- Pesan -->
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif
        <h2 class="text-2xl font-bold mb-6">Profil</h2>
            <form class="space-y-5" action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium text-sm mb-1 text-gray-700">Nama Lengkap<span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->nama_lengkap) }}"
                class="w-full border border-gray-300 rounded px-4 py-1 focus:outline-none focus:ring-2 focus:ring-black" required>
            </div>

            <div>
                <label class="block font-medium text-sm mb-1 text-gray-700">Username<span class="text-red-500">*</span></label>
                <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                class="w-full border border-gray-300 rounded px-4 py-1 focus:outline-none focus:ring-2 focus:ring-black" required>
            </div>

            <div>
                <label class="block font-medium text-sm mb-1 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                class="w-full border border-gray-300 rounded px-4 py-1 bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
            </div>

            <div>
                <label class="block font-medium text-sm mb-1 text-gray-700">No. Telepon<span class="text-red-500">*</span></label>
                <input type="tel" name="no_telepon" value="{{ old('no_telepon', Auth::user()->no_telepon) }}"
                class="w-full border border-gray-300 rounded px-4 py-1 focus:outline-none focus:ring-2 focus:ring-black" required>
            </div>

            <div class="mb-4 relative">
                <label class="block text-sm font-medium mb-1">Kata Sandi Baru</label>
                <input id="password" name="password" type="password"
                class="w-full border rounded px-3 py-2 text-sm pr-10 focus:outline-none focus:ring-2 focus:ring-black"
                placeholder="Masukkan kata sandi baru">

                <div class="absolute inset-y-0 right-3 flex items-center mt-6">
                <button type="button" onclick="togglePassword(this, 'password')">
                    <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M0 0h24v24H0z" stroke="none" />
                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M22 12c0 0 -4 -8 -10 -8s-10 8 -10 8s4 8 10 8s10 -8 10 -8" />
                    </svg>

                    <svg class="icon-eye-off hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M0 0h24v24H0z" stroke="none" />
                    <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                    <path
                        d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6
                            c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18
                            c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                    <path d="M3 3l18 18" />
                    </svg>
                </button>
                </div>
            </div>

            <div>
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-1 rounded-md ml-[38.5em]">
                Simpan
                </button>
            </div>
            </form>
    </div>
</body>

    <!-- Script for dropdown toggle -->
    <script>
        function togglePassword(button, inputId) {
            const input = document.getElementById(inputId);
            const iconEye = button.querySelector('.icon-eye');
            const iconEyeOff = button.querySelector('.icon-eye-off');

            if (input.type === 'password') {
            input.type = 'text';
            iconEye.classList.add('hidden');
            iconEyeOff.classList.remove('hidden');
            } else {
            input.type = 'password';
            iconEye.classList.remove('hidden');
            iconEyeOff.classList.add('hidden');
            }
        }

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

        // Hilangkan alert setelah 3 detik
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) alert.remove('ease-in-out duration-300');
        }, 3000);
    </script>

</html>
