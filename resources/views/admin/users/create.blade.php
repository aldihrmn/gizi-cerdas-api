<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah User - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-10">

        <div class="bg-white shadow rounded-xl p-8">

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Tambah User
            </h1>

            <p class="text-gray-500 mb-6">
                Tambahkan pengguna baru ke aplikasi.
            </p>


            @if($errors->any())

                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-5">

                    <ul class="list-disc ml-5">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form action="{{ route('admin.users.store') }}" method="POST">

                @csrf


                <div class="mb-5">

                    <label class="block text-gray-700 mb-2">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Masukkan nama"
                        required
                    >

                </div>


                <div class="mb-5">

                    <label class="block text-gray-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Masukkan email"
                        required
                    >

                </div>


                <div class="mb-5">

                    <label class="block text-gray-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Minimal 6 karakter"
                        required
                    >

                </div>


                <div class="mb-6">

                    <label class="block text-gray-700 mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border rounded-lg px-4 py-2"
                        required
                    >

                        <option value="">-- Pilih Role --</option>

                        <option value="user">
                            User
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                    </select>

                </div>


                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.users.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>