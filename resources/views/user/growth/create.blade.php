<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pengukuran - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Pengukuran
            </h1>

            <p class="text-gray-500 mt-1">
                Tambahkan data pertumbuhan {{ $child->name }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            @if($errors->any())

                <div class="bg-red-50 text-red-600 rounded-lg p-4 mb-6">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="{{ route('user.growth.store', $child->id) }}"
                method="POST"
            >

                @csrf

                <div class="mb-5">

                    <label
                        for="record_date"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Tanggal Pengukuran
                    </label>

                    <input
                        type="date"
                        name="record_date"
                        id="record_date"
                        value="{{ old('record_date', date('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required
                    >

                </div>

                <div class="mb-5">

                    <label
                        for="weight"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Berat Badan (kg)
                    </label>

                    <input
                        type="number"
                        name="weight"
                        id="weight"
                        step="0.01"
                        min="0"
                        value="{{ old('weight') }}"
                        placeholder="Contoh: 12.50"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required
                    >

                </div>

                <div class="mb-6">

                    <label
                        for="height"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Tinggi Badan (cm)
                    </label>

                    <input
                        type="number"
                        name="height"
                        id="height"
                        step="0.01"
                        min="0"
                        value="{{ old('height') }}"
                        placeholder="Contoh: 85.00"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required
                    >

                </div>

                <div class="flex gap-3">

                    <a
                        href="{{ route('user.growth.show', $child->id) }}"
                        class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg"
                    >
                        Simpan Pengukuran
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
