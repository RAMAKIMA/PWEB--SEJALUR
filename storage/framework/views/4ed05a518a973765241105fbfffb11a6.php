<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - SEJALUR</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black">

  <div class="min-h-screen flex">
    <!-- KIRI: Background dengan logo -->
    <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('https://images.pexels.com/photos/12228684/pexels-photo-12228684.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');">
      <div class="absolute inset-0 bg-black opacity-60"></div>
      <div class="relative z-10 h-full flex flex-col items-center justify-center text-white text-center px-6">
        <img src="img/Logo-SEJALUR-Putih.png" alt="Logo SEJALUR" class="h-24 mb-4" />
        <p class="text-sm">Selamat Datang di Website kami</p>
      </div>
    </div>

    <!-- KANAN: Form Login -->
    <div class="w-1/2 bg-yellow-400 flex items-center justify-center">
      <form method="POST" action="<?php echo e(route('Login')); ?>" class="bg-white rounded-3xl shadow-lg p-8 w-[90%] max-w-sm">
        <?php echo csrf_field(); ?>

        <h2 class="text-center text-xl font-bold mb-6">Log In</h2>

        <!-- Tampilkan error jika ada -->
        <?php if($errors->any()): ?>
          <div class="mb-4 text-sm text-red-600">
            <?php echo e($errors->first()); ?>

          </div>
        <?php endif; ?>

        <!-- Email -->
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Email<span class="text-red-500">*</span></label>
          <input name="email" type="email" class="w-full border rounded px-3 py-2 text-sm" placeholder="Masukkan Email" required />
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
        <label class="block text-sm font-medium mb-1">Kata Sandi<span class="text-red-500">*</span></label>
        <input id="password" name="password" type="password" class="w-full border rounded px-3 py-2 text-sm pr-10" placeholder="Masukkan Kata Sandi" required />

        <!-- Tombol toggle visibility -->
        <div class="absolute inset-y-0 right-3 flex items-center mt-6">
            <button type="button" onclick="togglePassword(this, 'password')">
            <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M0 0h24v24H0z" stroke="none" />
                <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M22 12c0 0 -4 -8 -10 -8s-10 8 -10 8s4 8 10 8s10 -8 10 -8" />
            </svg>

            <svg class="icon-eye-off hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M0 0h24v24H0z" stroke="none"/>
                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6
                    c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18
                    c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                <path d="M3 3l18 18" />
            </svg>
            </button>
        </div>
        </div>

        <!-- Belum punya akun -->
        <div class="text-xs text-right mb-4">
          Belum punya akun? <a href="<?php echo e(route('Register')); ?>" class="text-[#FF6600] hover:underline font-bold">Daftar</a>
        </div>

        <!-- Tombol Login -->
        <button type="submit" class="w-full bg-black text-white py-2 rounded-md font-semibold hover:bg-gray-800 text-sm">
          Log In
        </button>
      </form>
    </div>
  </div>

</body>

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
    </script>

</html>
<?php /**PATH C:\laragon\www\PWEB\resources\views/Auth/Login.blade.php ENDPATH**/ ?>