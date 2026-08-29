<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Anak - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-8">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Data Anak
            </h1>

            <p class="text-gray-500 mt-1">
                Masukkan data anak dengan benar
            </p>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <form action="{{ route('user.children.store') }}" method="POST">

                @csrf

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">
                        Nama Anak
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama anak"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="birth_date"
                        value="{{ old('birth_date') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">
                        Jenis Kelamin
                    </label>

                    <select
                        name="gender"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">
                        Berat Badan (kg)
                    </label>

                    <input
                        type="number"
                        name="weight"
                        step="0.01"
                        value="{{ old('weight') }}"
                        placeholder="Contoh: 12.5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >
                </div>

                <div class="mb-6">
                    <label class="block font-medium text-gray-700 mb-2">
                        Tinggi Badan (cm)
                    </label>

                    <input
                        type="number"
                        name="height"
                        step="0.01"
                        value="{{ old('height') }}"
                        placeholder="Contoh: 85"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >
                </div>

                <div class="flex gap-3">

                    <a href="{{ route('user.children.index') }}"
                       class="flex-1 text-center border border-gray-300 text-gray-700 py-3 rounded-lg">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
