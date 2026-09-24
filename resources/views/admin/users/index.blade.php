<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manajemen User - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Manajemen User
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola data pengguna aplikasi Gizi Cerdas
                </p>
            </div>

            <div class="flex gap-3">

                <a href="{{ route('admin.dashboard') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Kembali
                </a>

                <a href="{{ route('admin.users.create') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
                    + Tambah User
                </a>

            </div>

        </div>


        @if(session('success'))

            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-5">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-5">
                {{ session('error') }}
            </div>

        @endif


        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-purple-700 text-white">

                    <tr>
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Nama</th>
                        <th class="px-5 py-4 text-left">Email</th>
                        <th class="px-5 py-4 text-left">Role</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-5 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-5 py-4 font-medium">
                                {{ $user->name }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-5 py-4">

                                @if($user->role == 'admin')

                                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                        Admin
                                    </span>

                                @else

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        User
                                    </span>

                                @endif

                            </td>

                            <td class="px-5 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-8 text-gray-500">
                                Belum ada data user.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>