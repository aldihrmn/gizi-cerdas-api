<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Pertumbuhan - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="mb-6">
            <a
                href="{{ route('admin.growth.index') }}"
                class="text-blue-600 hover:text-blue-800 font-medium"
            >
                ← Kembali ke Data Pertumbuhan
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <div class="mb-8">

                <h1 class="text-2xl font-bold text-gray-800">
                    Edit Data Pertumbuhan
                </h1>

                <p class="text-gray-500 mt-2">
                    Perbarui data berat badan dan tinggi badan anak.
                </p>

            </div>


            @if ($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">

                    <p class="font-semibold mb-2">
                        Data belum lengkap:
                    </p>

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('admin.growth.update', $growth->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Anak
                    </label>

                    <select
                        name="child_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >

                        <option value="">
                            -- Pilih Anak --
                        </option>

                        @foreach ($children as $child)

                            <option
                                value="{{ $child->id }}"
                                {{ old('child_id', $growth->child_id) == $child->id ? 'selected' : '' }}
                            >
                                {{ $child->name }}

                                @if ($child->user)
                                    - {{ $child->user->name }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Pemeriksaan
                    </label>

                    <input
                        type="date"
                        name="record_date"
                        value="{{ old('record_date', \Carbon\Carbon::parse($growth->record_date)->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Berat Badan (kg)
                        </label>

                        <input
                            type="number"
                            name="weight"
                            step="0.01"
                            min="0"
                            value="{{ old('weight', $growth->weight) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required
                        >

                    </div>


                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tinggi Badan (cm)
                        </label>

                        <input
                            type="number"
                            name="height"
                            step="0.01"
                            min="0"
                            value="{{ old('height', $growth->height) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required
                        >

                    </div>


                </div>


                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8">

                    <a
                        href="{{ route('admin.growth.index') }}"
                        class="text-center px-6 py-3 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium"
                    >
                        Update Data
                    </button>

                </div>


            </form>

        </div>

    </div>

</body>
</html>