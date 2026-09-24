<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Anak - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-gray-100 min-h-screen">


    <div class="max-w-7xl mx-auto px-6 py-8">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Data Anak
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola seluruh data anak pada sistem Gizi Cerdas.
                </p>

            </div>


            <div class="flex gap-3">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg"
                >
                    Dashboard
                </a>


                <a
                    href="{{ route('admin.children.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg"
                >
                    + Tambah Anak
                </a>

            </div>

        </div>



        <!-- =====================================================
             PESAN SUKSES
        ====================================================== -->

        @if(session('success'))

            <div class="bg-green-100 text-green-700 px-5 py-4 rounded-lg mb-6">

                {{ session('success') }}

            </div>

        @endif



        <!-- =====================================================
             PESAN ERROR
        ====================================================== -->

        @if(session('error'))

            <div class="bg-red-100 text-red-700 px-5 py-4 rounded-lg mb-6">

                {{ session('error') }}

            </div>

        @endif



        <!-- =====================================================
             TABEL DATA ANAK
        ====================================================== -->

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">


                    <!-- HEADER TABEL -->

                    <thead class="bg-gray-800 text-white">

                        <tr>

                            <th class="px-5 py-4 text-left">
                                No
                            </th>

                            <th class="px-5 py-4 text-left">
                                Nama Anak
                            </th>

                            <th class="px-5 py-4 text-left">
                                Orang Tua
                            </th>

                            <th class="px-5 py-4 text-left">
                                Tanggal Lahir
                            </th>

                            <th class="px-5 py-4 text-left">
                                Jenis Kelamin
                            </th>

                            <th class="px-5 py-4 text-left">
                                Berat
                            </th>

                            <th class="px-5 py-4 text-left">
                                Tinggi
                            </th>

                            <th class="px-5 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    <!-- ISI TABEL -->

                    <tbody>

                        @forelse($children as $child)

                            <tr class="border-b hover:bg-gray-50">


                                <!-- NOMOR -->

                                <td class="px-5 py-4">

                                    {{ $loop->iteration }}

                                </td>



                                <!-- NAMA ANAK -->

                                <td class="px-5 py-4 font-medium">

                                    {{ $child->name }}

                                </td>



                                <!-- ORANG TUA -->

                                <td class="px-5 py-4">

                                    {{ $child->user->name ?? '-' }}

                                </td>



                                <!-- TANGGAL LAHIR -->

                                <td class="px-5 py-4">

                                    {{ $child->birth_date->format('d-m-Y') }}

                                </td>



                                <!-- JENIS KELAMIN -->

                                <td class="px-5 py-4">

                                    @if($child->gender === 'L')

                                        Laki-laki

                                    @elseif($child->gender === 'P')

                                        Perempuan

                                    @else

                                        {{ $child->gender }}

                                    @endif

                                </td>



                                <!-- BERAT -->

                                <td class="px-5 py-4">

                                    {{ $child->weight ?? '-' }}

                                    @if($child->weight)

                                        kg

                                    @endif

                                </td>



                                <!-- TINGGI -->

                                <td class="px-5 py-4">

                                    {{ $child->height ?? '-' }}

                                    @if($child->height)

                                        cm

                                    @endif

                                </td>



                                <!-- =================================================
                                     AKSI
                                ================================================== -->

                                <td class="px-5 py-4">


                                    <div class="flex justify-center gap-2 flex-wrap">


                                        <!-- EDIT -->

                                        <a
                                            href="{{ route('admin.children.edit', $child->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg"
                                        >

                                            Edit

                                        </a>



                                        <!-- CATATAN ADMIN -->

                                        <a
                                            href="{{ route('admin.notes.create', $child->id) }}"
                                            class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded-lg"
                                        >

                                            📝 Beri Catatan

                                        </a>



                                        <!-- HAPUS -->

                                        <form
                                            action="{{ route('admin.children.destroy', $child->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data anak ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg"
                                            >

                                                Hapus

                                            </button>

                                        </form>


                                    </div>

                                </td>


                            </tr>


                        @empty


                            <!-- TIDAK ADA DATA -->

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-gray-500 py-10"
                                >

                                    Belum ada data anak.

                                </td>

                            </tr>


                        @endforelse


                    </tbody>


                </table>

            </div>

        </div>



        <!-- =====================================================
             INFORMASI
        ====================================================== -->

        <div class="mt-6 bg-white rounded-xl shadow p-5">

            <h2 class="text-lg font-bold text-gray-800 mb-2">

                Catatan Admin

            </h2>


            <p class="text-gray-500 text-sm leading-6">

                Admin dapat memberikan catatan atau saran
                kepada orang tua berdasarkan data dan hasil
                pemantauan pertumbuhan anak.

                Klik tombol
                <strong>📝 Beri Catatan</strong>
                pada anak yang ingin diberikan catatan.

            </p>

        </div>


    </div>


</body>

</html>