<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pertumbuhan Anak - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-5xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Pertumbuhan Anak
                </h1>

                <p class="text-gray-500 mt-1">
                    Pilih anak untuk melihat perkembangan pertumbuhan
                </p>
            </div>

            <a
                href="{{ route('user.dashboard') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg"
            >
                Dashboard
            </a>

        </div>

        @if($children->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach($children as $child)

                    <div class="bg-white rounded-2xl shadow p-6">

                        <div class="flex justify-between items-start">

                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $child->name }}
                                </h2>

                                <p class="text-gray-500 mt-1">
                                    {{ $child->gender }}
                                </p>

                                <p class="text-gray-500">
                                    Lahir:
                                    {{ $child->birth_date->format('d-m-Y') }}
                                </p>
                            </div>

                            <div class="bg-green-100 p-3 rounded-xl">
                                <span class="text-green-600 text-xl">
                                    🌱
                                </span>
                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-6">

                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-sm text-gray-500">
                                    Berat terakhir
                                </p>

                                <p class="text-lg font-bold text-gray-800">
                                    {{ $child->weight }} kg
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-sm text-gray-500">
                                    Tinggi terakhir
                                </p>

                                <p class="text-lg font-bold text-gray-800">
                                    {{ $child->height }} cm
                                </p>
                            </div>

                        </div>

                        <a
                            href="{{ route('user.growth.show', $child->id) }}"
                            class="block text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg mt-6"
                        >
                            Lihat Pertumbuhan
                        </a>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-2xl shadow p-8 text-center">

                <h2 class="text-xl font-bold text-gray-800">
                    Belum ada data anak
                </h2>

                <p class="text-gray-500 mt-2">
                    Tambahkan data anak terlebih dahulu.
                </p>

                <a
                    href="{{ route('user.children.create') }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg mt-5"
                >
                    Tambah Anak
                </a>

            </div>

        @endif

    </div>

</body>
</html>
