<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catatan Puskesmas - Gizi Cerdas</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F7F5FF;
        }

        .page-bg {
            background:
                radial-gradient(
                    circle at top right,
                    rgba(139, 92, 246, 0.10),
                    transparent 35%
                ),
                #F7F5FF;
        }

        .purple-gradient {
            background:
                linear-gradient(
                    135deg,
                    #6D28D9 0%,
                    #8B5CF6 55%,
                    #A78BFA 100%
                );
        }

        .card {
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(80, 45, 130, 0.07);
        }

        .note-card {
            border: 1px solid #E9D5FF;
            background: #ffffff;
            border-radius: 18px;
            transition: all 0.2s ease;
        }

        .note-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(109, 40, 217, 0.08);
        }

        .info-box {
            background: #F3E8FF;
            border: 1px solid #E9D5FF;
            border-radius: 16px;
        }
    </style>
</head>


<body class="page-bg min-h-screen">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <header class="purple-gradient text-white">

        <div class="max-w-6xl mx-auto px-5 md:px-6 py-7">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center text-xl">
                            🏥
                        </div>

                        <div>

                            <p class="font-bold text-white">
                                Puskesmas Seroja
                            </p>

                            <p class="text-purple-100 text-xs">
                                Sistem Informasi Gizi Anak
                            </p>

                        </div>

                    </div>

                    <h1 class="text-2xl md:text-4xl font-bold">
                        Catatan Puskesmas
                    </h1>

                    <p class="text-purple-100 mt-2 text-sm md:text-base">
                        Catatan dan pesan dari petugas Puskesmas untuk Anda
                    </p>

                </div>


                <a
                    href="{{ route('user.dashboard') }}"
                    class="inline-flex items-center justify-center
                           bg-white
                           text-purple-700
                           font-semibold
                           px-5 py-3
                           rounded-xl
                           hover:bg-purple-50
                           transition"
                >
                    ← Dashboard
                </a>

            </div>

        </div>

    </header>


    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <main class="max-w-6xl mx-auto px-5 md:px-6 py-8">


        <!-- =====================================================
             INFORMASI
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-start gap-3">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    📝
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Catatan dari Puskesmas
                    </h2>

                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                        Halaman ini berisi catatan yang diberikan oleh petugas
                        Puskesmas berdasarkan pemantauan anak.
                    </p>

                </div>

            </div>

        </section>


        <!-- =====================================================
             FLASH MESSAGE
        ====================================================== -->
        @if(session('success'))

            <div class="card p-5 mb-6 border border-green-200">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                        ✅
                    </div>

                    <div>

                        <p class="font-bold text-green-800">
                            Berhasil
                        </p>

                        <p class="text-sm text-green-700 mt-1">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        <!-- =====================================================
             JUMLAH CATATAN
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="grid md:grid-cols-3 gap-4">


                <!-- TOTAL -->
                <div class="info-box p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-purple-700">
                                Total Catatan
                            </p>

                            <p class="text-3xl font-bold text-[#34156F] mt-1">
                                {{ $notes->count() }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Catatan dari Puskesmas
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center text-xl">
                            📝
                        </div>

                    </div>

                </div>


                <!-- ANAK -->
                <div class="info-box p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-purple-700">
                                Anak yang Dipantau
                            </p>

                            <p class="text-3xl font-bold text-[#34156F] mt-1">
                                {{ $notes->pluck('child_id')->unique()->count() }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Berdasarkan catatan
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center text-xl">
                            👶
                        </div>

                    </div>

                </div>


                <!-- TERBARU -->
                <div class="info-box p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-purple-700">
                                Catatan Terbaru
                            </p>

                            <p class="text-lg font-bold text-[#34156F] mt-1">

                                @if($notes->count() > 0)

                                    {{ $notes->first()->created_at->format('d-m-Y') }}

                                @else

                                    Belum ada

                                @endif

                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Tanggal catatan terakhir
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center text-xl">
                            🗓️
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- =====================================================
             DAFTAR CATATAN
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center justify-between gap-4 mb-6">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                        💬
                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-[#34156F]">
                            Riwayat Catatan
                        </h2>

                        <p class="text-sm text-gray-500">
                            Pesan yang telah diberikan petugas
                        </p>

                    </div>

                </div>

            </div>


            @if($notes->count() > 0)

                <div class="space-y-4">

                    @foreach($notes as $note)

                        <div class="note-card p-5">

                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">


                                <!-- INFO UTAMA -->
                                <div class="flex items-start gap-4 flex-1">

                                    <div class="w-12 h-12 min-w-12 rounded-xl bg-purple-100 flex items-center justify-center text-xl">
                                        📝
                                    </div>


                                    <div class="flex-1">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h3 class="font-bold text-[#34156F] text-lg">
                                                Catatan Puskesmas
                                            </h3>

                                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Baru
                                            </span>

                                        </div>


                                        <!-- ANAK -->
                                        <div class="mt-3">

                                            <p class="text-xs text-gray-500">
                                                Untuk Anak
                                            </p>

                                            <p class="font-semibold text-gray-800 mt-1">
                                                {{ $note->child->name ?? 'Data anak tidak tersedia' }}
                                            </p>

                                        </div>


                                        <!-- PETUGAS -->
                                        <div class="mt-3">

                                            <p class="text-xs text-gray-500">
                                                Petugas Puskesmas
                                            </p>

                                            <p class="font-semibold text-gray-800 mt-1">
                                                {{ $note->admin->name ?? 'Petugas Puskesmas' }}
                                            </p>

                                        </div>


                                        <!-- CATATAN -->
                                        <div class="mt-4 bg-purple-50 border border-purple-100 rounded-xl p-4">

                                            <p class="text-xs text-purple-700 font-semibold mb-2">
                                                Isi Catatan
                                            </p>

                                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                                                {{ $note->note }}
                                            </p>

                                        </div>


                                        <!-- TANGGAL -->
                                        <div class="mt-4 flex flex-wrap gap-4 text-xs text-gray-500">

                                            <span class="flex items-center gap-1">
                                                🗓️
                                                {{ $note->created_at->format('d-m-Y') }}
                                            </span>

                                            <span class="flex items-center gap-1">
                                                🕐
                                                {{ $note->created_at->format('H:i') }}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


            @else

                <!-- =================================================
                     KOSONG
                ================================================== -->
                <div class="text-center py-14">

                    <div class="w-20 h-20 rounded-2xl bg-purple-100 mx-auto flex items-center justify-center text-4xl">
                        📝
                    </div>

                    <h3 class="text-xl font-bold text-[#34156F] mt-5">
                        Belum Ada Catatan
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto leading-relaxed">
                        Belum ada catatan dari petugas Puskesmas.
                        Catatan akan muncul di halaman ini setelah
                        petugas memberikan pesan atau hasil pemantauan.
                    </p>

                    <a
                        href="{{ route('user.dashboard') }}"
                        class="inline-flex items-center justify-center
                               mt-5
                               bg-purple-600
                               hover:bg-purple-700
                               text-white
                               font-semibold
                               px-5 py-3
                               rounded-xl
                               transition"
                    >
                        Kembali ke Dashboard
                    </a>

                </div>

            @endif

        </section>


        <!-- =====================================================
             INFORMASI TAMBAHAN
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="bg-purple-50 border border-purple-100 rounded-2xl p-5">

                <div class="flex items-start gap-3">

                    <div class="text-2xl">
                        ℹ️
                    </div>

                    <div>

                        <h3 class="font-bold text-[#34156F]">
                            Informasi
                        </h3>

                        <p class="text-sm text-purple-900/70 mt-2 leading-relaxed">
                            Catatan Puskesmas merupakan informasi dari petugas
                            untuk membantu pemantauan pertumbuhan dan kondisi
                            gizi anak. Tetap lakukan konsultasi langsung dengan
                            tenaga kesehatan apabila membutuhkan pemeriksaan
                            atau penanganan lebih lanjut.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- =====================================================
             BUTTON
        ====================================================== -->
        <div class="flex justify-center pb-8">

            <a
                href="{{ route('user.dashboard') }}"
                class="bg-purple-600
                       hover:bg-purple-700
                       text-white
                       font-semibold
                       px-6 py-3
                       rounded-xl
                       text-center
                       transition
                       shadow-sm"
            >
                ← Kembali ke Dashboard
            </a>

        </div>

    </main>


    <!-- =====================================================
         FOOTER
    ====================================================== -->
    <footer class="text-center pb-8">

        <p class="text-xs text-gray-400">
            Puskesmas Seroja · Sistem Informasi Gizi Anak
        </p>

    </footer>

</body>

</html>