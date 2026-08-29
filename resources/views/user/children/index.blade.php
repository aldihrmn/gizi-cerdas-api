<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Anak - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Data Anak
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola data anak kamu
                </p>
            </div>

            <a href="{{ route('user.children.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg">
                + Tambah Anak
            </a>

        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse($children as $child)

                <div class="bg-white rounded-2xl shadow p-6">

                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $child->name }}
                    </h2>

                    <div class="mt-4 space-y-2 text-gray-600">

                        <p>
                            <span class="font-medium">Tanggal Lahir:</span>
                            {{ $child->birth_date->format('d-m-Y') }}
                        </p>

                        <p>
                            <span class="font-medium">Jenis Kelamin:</span>
                            {{ $child->gender }}
                        </p>

                        <p>
                            <span class="font-medium">Berat:</span>
                            {{ $child->weight }} kg
                        </p>

                        <p>
                            <span class="font-medium">Tinggi:</span>
                            {{ $child->height }} cm
                        </p>

                    </div>

                    <div class="mt-5">
                        <a href="#"
                           class="text-green-600 font-medium">
                            Hitung Kebutuhan Gizi →
                        </a>
                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow p-8 text-center md:col-span-2">

                    <h2 class="text-xl font-bold text-gray-700">
                        Belum ada data anak
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Tambahkan data anak untuk mulai menghitung kebutuhan gizi.
                    </p>

                    <a href="{{ route('user.children.create') }}"
                       class="inline-block mt-5 bg-green-600 text-white px-5 py-3 rounded-lg">
                        Tambah Data Anak
                    </a>

                </div>

            @endforelse

        </div>

        <div class="mt-8">
            <a href="{{ route('user.dashboard') }}"
               class="text-gray-600 hover:text-gray-800">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>

</body>
</html>
