<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Halo, {{ auth()->user()->name }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Pantau tumbuh kembang anak dengan Gizi Cerdas
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg"
                >
                    Logout
                </button>
            </form>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('user.nutrition.create') }}" class="bg-white rounded-2xl shadow p-6 hover:shadow-lg">
                <h2 class="text-xl font-bold text-green-600">
                    Hitung Gizi
                </h2>

                <p class="text-gray-500 mt-2">
                    Hitung kebutuhan gizi anak.
                </p>
            </a>

            <a href="#" class="bg-white rounded-2xl shadow p-6 hover:shadow-lg">
                <h2 class="text-xl font-bold text-blue-600">
                    Pertumbuhan
                </h2>

                <p class="text-gray-500 mt-2">
                    Pantau perkembangan anak.
                </p>
            </a>

            <a href="#" class="bg-white rounded-2xl shadow p-6 hover:shadow-lg">
                <h2 class="text-xl font-bold text-orange-500">
                    Edukasi
                </h2>

                <p class="text-gray-500 mt-2">
                    Baca informasi seputar gizi.
                </p>
            </a>

        </div>

    </div>

</body>
</html>
