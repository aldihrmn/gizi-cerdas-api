<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Anak - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto px-6 py-10">

        <div class="mb-8">

            <a href="{{ route('admin.children.index') }}"
                class="text-green-600 hover:text-green-700 font-medium">

                ← Kembali ke Data Anak

            </a>

            <h1 class="text-3xl font-bold text-gray-800 mt-4">
                Edit Data Anak
            </h1>

            <p class="text-gray-500 mt-2">
                Ubah data anak yang sudah terdaftar.
            </p>

        </div>


        <div class="bg-white shadow rounded-2xl p-8">

            @if ($errors->any())

                <div class="bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-lg mb-6">

                    <strong>Data belum lengkap:</strong>

                    <ul class="list-disc ml-5 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form action="{{ route('admin.children.update', $child->id) }}" method="POST">

                @csrf

                @method('PUT')


                <!-- Orang Tua -->

                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Orang Tua / User
                    </label>

                    <select name="user_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>

                        <option value="">
                            -- Pilih User --
                        </option>

                        @foreach ($users as $user)

                            <option value="{{ $user->id }}"
                                {{ old('user_id', $child->user_id) == $user->id ? 'selected' : '' }}>

                                {{ $user->name }} - {{ $user->email }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Nama Anak -->

                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Anak
                    </label>

                    <input type="text"
                        name="name"
                        value="{{ old('name', $child->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>

                </div>


                <!-- Tanggal Lahir -->

                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Lahir
                    </label>

                    <input type="date"
                        name="birth_date"
                        value="{{ old('birth_date', $child->birth_date->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>

                </div>


                <!-- Jenis Kelamin -->

                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Jenis Kelamin
                    </label>

                    <select name="gender"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>

                        <option value="Laki-laki"
                            {{ old('gender', $child->gender) == 'Laki-laki' ? 'selected' : '' }}>

                            Laki-laki

                        </option>

                        <option value="Perempuan"
                            {{ old('gender', $child->gender) == 'Perempuan' ? 'selected' : '' }}>

                            Perempuan

                        </option>

                    </select>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Berat Badan -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Berat Badan (kg)
                        </label>

                        <input type="number"
                            step="0.01"
                            min="0"
                            name="weight"
                            value="{{ old('weight', $child->weight) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>

                    </div>


                    <!-- Tinggi Badan -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tinggi Badan (cm)
                        </label>

                        <input type="number"
                            step="0.01"
                            min="0"
                            name="height"
                            value="{{ old('height', $child->height) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>

                    </div>

                </div>


                <!-- Tombol -->

                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('admin.children.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg">

                        Batal

                    </a>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">

                        Update Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>