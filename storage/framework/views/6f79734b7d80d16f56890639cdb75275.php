<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pengaduan (Masyarakat)</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Bagian Navbar -->
    <nav class="bg-yellow-400 text-black px-8 py-4 flex items-center justify-between shadow-md sticky top-0 z-50">
    <div class="flex items-center">
        <img src="/img/Logo-SEJALUR-Hitam.png" alt="Logo SEJALUR Hitam" class="h-10" />
    </div>
    <ul class="flex gap-6 font-semibold items-center pr-[7.5em]">
        <li><a href="<?php echo e(route('Pengaduan.masyarakat')); ?>" class="hover:underline">Pengaduan</a></li>

        <!-- Dropdown Perbaikan -->
        <li class="relative">
        <button id="dropdownToggle" class="hover:underline flex items-center gap-1">
            Perbaikan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdownMenu" class="hidden absolute bg-white text-black mt-2 shadow-lg rounded-lg z-50 w-48">
            <li><a href="<?php echo e(route('Perbaikan.dikerjakan.masyarakat')); ?>" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dikerjakan</a></li>
            <li><a href="<?php echo e(route('Perbaikan.selesai.masyarakat')); ?>" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Selesai</a></li>
        </ul>
        </li>

        <li><a href="<?php echo e(route('Dashboard.masyarakat')); ?>" class="hover:underline">Dashboard</a></li>
    </ul>

    <!-- Dropdown Profil -->
    <div class="relative pr-20">
        <button id="profileBtn" class="flex items-center justify-center w-9 h-9 rounded-full bg-white font-bold text-black border-2 border-black">
        <?php echo e(strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 1))); ?>

        </button>

        <!-- Menu Dropdown Profil -->
        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg z-50">
        <a href="<?php echo e(route('Profil.masyarakat')); ?>" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Profil</a>
        <form method="POST" action="<?php echo e(route('Logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">Logout</button>
        </form>
        </div>
    </div>
    </nav>

  <!-- Background -->
  <div class="bg-cover bg-center min-h-[90vh]" style="background-image: url('https://images.pexels.com/photos/12228684/pexels-photo-12228684.jpeg');">
    <div class="flex items-center justify-center min-h-[90vh] bg-black bg-opacity-60 pt-5 pb-2">

        <!-- Form -->
      <div class="bg-white text-black rounded-xl shadow-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Form Pengaduan</h2>
        <?php if(session('success')): ?>
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-800 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('pengaduan.store')); ?>" enctype="multipart/form-data" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-medium mb-1">Nama Pelapor<span class="text-red-500">*</span></label>
                <input type="text" name="nama_pelapor" class="w-full border border-gray-300 rounded px-3 py-1" placeholder="Masukkan Nama Lengkap" required/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email<span class="text-red-500">*</span></label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-1" placeholder="Masukkan Email" required/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Pengaduan<span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_pengaduan" class="w-full border border-gray-300 rounded px-3 py-1" required/>
            </div>
            <div class="mb-4 relative">
                <label class="block text-sm font-medium mb-1">Jenis Kerusakan<span class="text-red-500">*</span></label>
                <select name="jenis_kerusakan" class="w-full border rounded px-3 py-2 text-sm pr-10 appearance-none" required>
                    <option value="">-- Pilih jenis kerusakan --</option>
                    <option>Retak</option>
                    <option>Berlubang</option>
                    <option>Bergelombang</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-600 mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-chevron-down">
                    <path d="M6 9l6 6l6 -6" />
                </svg>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi Kerusakan<span class="text-red-500">*</span></label>
                <input type="text" name="lokasi_kerusakan" class="w-full border border-gray-300 rounded px-3 py-1" placeholder="Masukkan Link Gmaps" required/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Foto Kerusakan<span class="text-red-500">*</span></label>
                <div class="border border-dashed border-gray-400 rounded px-3 py-4 text-center text-sm relative" id="uploadBox">
                <p id="uploadText">
                    Seret & Jatuhkan berkas Anda atau
                    <label for="fileInput" class="text-orange-600 font-semibold cursor-pointer underline">Jelajahi</label>
                </p>
                <input id="fileInput" name="foto_kerusakan" type="file" accept="image/*" class="hidden" required/>
                <div id="previewContainer" class="mt-4 hidden">
                    <img id="imagePreview" class="w-full h-40 object-cover rounded shadow" alt="Preview Gambar"/>
                    <p id="fileName" class="text-sm mt-2 text-gray-700 font-medium"></p>
                </div>
                </div>
            </div>
            <button type="submit" class="bg-yellow-400 w-full py-2 rounded font-semibold hover:bg-yellow-500">
                Adukan
            </button>
        </form>
      </div>
    </div>
  </div>
</body>

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

    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const uploadText = document.getElementById('uploadText');

    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];
        if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            uploadText.classList.add('hidden');
        };

        reader.readAsDataURL(file);
        }
    });

    setTimeout(() => {
        const alert = document.querySelector('.bg-green-100');
        if (alert) alert.remove();
    }, 4000);
    </script>

</html>
<?php /**PATH C:\laragon\www\PWEB\resources\views/Form-pengaduan/Form-pengaduan.blade.php ENDPATH**/ ?>