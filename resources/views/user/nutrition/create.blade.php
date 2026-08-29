<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hitung Gizi - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Hitung Kebutuhan Gizi
            </h1>

            <p class="text-gray-500 mt-1">
                Masukkan data anak untuk menghitung kebutuhan gizi
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <form action="{{ route('user.nutrition.store') }}" method="POST">

                @csrf

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">
                        Pilih Anak
                    </label>

                    <select
                        name="child_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >
                        <option value="">Pilih anak</option>

                        @foreach($children as $child)
                            <option value="{{ $child->id }}">
                                {{ $child->name }}
                            </option>
                        @endforeach
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
                        placeholder="Contoh: 85"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium"
                >
                    Hitung Kebutuhan Gizi
                </button>

            </form>

        </div>

        <div class="mt-6">
            <a
                href="{{ route('user.dashboard') }}"
                class="text-gray-600 hover:text-gray-800"
            >
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>

</body>
</html>
