<!-- resources/views/components/modal-register.blade.php -->
<div id="registerModal" class="modal fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 backdrop-blur-sm hidden">
    <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-lg w-full max-w-md shadow-lg relative text-white">
        <button onclick="closeRegisterModal()" class="absolute top-2 right-2 text-white text-xl">&times;</button>
        <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama"
                class="form-input mb-3 w-full rounded-lg px-3 py-2 bg-white bg-opacity-10 backdrop-blur-sm border-none text-white placeholder-white focus:outline-none">
            <input type="email" name="email" placeholder="Email"
                class="form-input mb-3 w-full rounded-lg px-3 py-2 bg-white bg-opacity-10 backdrop-blur-sm border-none text-white placeholder-white focus:outline-none">
            <input type="password" name="password" placeholder="Password"
                class="form-input mb-3 w-full rounded-lg px-3 py-2 bg-white bg-opacity-10 backdrop-blur-sm border-none text-white placeholder-white focus:outline-none">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="form-input mb-3 w-full rounded-lg px-3 py-2 bg-white bg-opacity-10 backdrop-blur-sm border-none text-white placeholder-white focus:outline-none">

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg">Daftar</button>
        </form>

        <p class="text-center mt-4 text-sm">
            Sudah punya akun?
            <a href="#" onclick="toggleLogin()" class="text-blue-400 hover:underline">Login</a>
        </p>
    </div>
</div>
