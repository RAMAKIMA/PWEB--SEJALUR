<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page - SEJALUR</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <!-- Navbar -->
    <nav class="bg-yellow-400 text-black px-8 py-4 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center">
        <img src="img/Logo-SEJALUR-Hitam.png" alt="Logo SEJALUR Hitam" class="h-10" />
    </div>
    <ul class="flex gap-6 font-semibold ml-7 items-center">
        <li><a href="<?php echo e(route('Login')); ?>" class="hover:underline">Pengaduan</a></li>

        <!-- Perbaikan Dropdown - on click -->
        <li class="relative">
        <button id="dropdownToggle" class="hover:underline flex items-center gap-1">
            Perbaikan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdownMenu" class="hidden absolute bg-white text-black mt-2 shadow-lg rounded-lg z-50 w-48">
            <li>
            <a href="<?php echo e(route('Login')); ?>" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dikerjakan</a>
            </li>
            <li>
            <a href="<?php echo e(route('Login')); ?>" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Selesai</a>
            </li>
        </ul>
        </li>

        <li><a href="<?php echo e(route('Login')); ?>" class="hover:underline">Dashboard</a></li>
    </ul>

    <div class="flex items-center gap-4 mr-10 font-semibold">
        <a href="<?php echo e(route('Register')); ?>" class="hover:underline">Sign Up</a>
        <span>|</span>
        <a href="<?php echo e(route('Login')); ?>" class="bg-black text-white px-4 py-2 rounded-full hover:bg-[#171C22]">Sign In</a>
    </div>
    </nav>

  <!-- Hero Section -->
  <section
    class="relative h-[90vh] bg-cover bg-center flex items-center justify-center"
    style="background-image: url('https://images.pexels.com/photos/12228684/pexels-photo-12228684.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');"
  >
    <div class="absolute inset-0 bg-black opacity-60"></div>
    <div class="relative z-10 text-center">
      <!-- Logo -->
      <img src="img/Logo-SEJALUR-Putih.png" alt="Logo SEJALUR Putih" class="mx-auto h-28" />
      <p class="text-sm text-white">Selamat Datang di Website kami</p>
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
    </script>

</html>
<?php /**PATH C:\laragon\www\PWEB\resources\views/Landing-page/Landing-page.blade.php ENDPATH**/ ?>