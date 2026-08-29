<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Dashboard Admin
                </h1>

                <p class="text-gray-500 mt-1">
                    Selamat datang di Gizi Cerdas
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

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-gray-500">Total User</p>
                <h2 class="text-3xl font-bold text-green-600 mt-2">
                    1
                </h2>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-gray-500">Total Anak</p>
                <h2 class="text-3xl font-bold text-blue-600 mt-2">
                    1
                </h2>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-gray-500">Data Makanan</p>
                <h2 class="text-3xl font-bold text-orange-500 mt-2">
                    6
                </h2>
            </div>

        </div>

    </div>

</body>
</html>
