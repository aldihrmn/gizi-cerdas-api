<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Perhitungan Nutrisi - Gizi Cerdas</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F7F5FF;
        }

        .card {
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(80, 45, 130, 0.07);
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

        .purple-soft {
            background: #F3E8FF;
        }

        .status-card {
            border: 1px solid #E9D5FF;
            background: #FCFAFF;
            border-radius: 18px;
            transition: all 0.2s ease;
        }

        .status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(109, 40, 217, 0.08);
        }

        .value-card {
            background: #F9F7FF;
            border: 1px solid #EEE8FF;
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

                            <p class="text-white font-bold">
                                Puskesmas Seroja
                            </p>

                            <p class="text-purple-100 text-xs">
                                Sistem Informasi Gizi Anak
                            </p>

                        </div>

                    </div>

                    <h1 class="text-2xl md:text-4xl font-bold">
                        Hasil Perhitungan Nutrisi
                    </h1>

                    <p class="text-purple-100 mt-2 text-sm md:text-base">
                        Hasil pemantauan pertumbuhan dan kebutuhan nutrisi anak
                    </p>

                </div>

                <a
                    href="{{ route('user.nutrition.create') }}"
                    class="inline-flex items-center justify-center
                           bg-white text-purple-700
                           font-semibold
                           px-5 py-3
                           rounded-xl
                           hover:bg-purple-50
                           transition"
                >
                    ← Hitung Lagi
                </a>

            </div>

        </div>

    </header>


    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <main class="max-w-6xl mx-auto px-5 md:px-6 py-8">


        <!-- =====================================================
             INFORMASI ANAK
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    👶
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Informasi Anak
                    </h2>

                    <p class="text-sm text-gray-500">
                        Data anak dan hasil pemeriksaan
                    </p>

                </div>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-4">


                <!-- NAMA -->
                <div class="value-card p-4">

                    <p class="text-xs text-gray-500">
                        Nama Anak
                    </p>

                    <p class="font-bold text-[#34156F] mt-1">
                        {{ $child->name }}
                    </p>

                </div>


                <!-- TANGGAL -->
                <div class="value-card p-4">

                    <p class="text-xs text-gray-500">
                        Tanggal Pemeriksaan
                    </p>

                    <p class="font-bold text-[#34156F] mt-1">
                        {{ $calculationDate->format('d-m-Y') }}
                    </p>

                </div>


                <!-- USIA -->
                <div class="value-card p-4">

                    <p class="text-xs text-gray-500">
                        Usia
                    </p>

                    <p class="font-bold text-[#34156F] mt-1">
                        {{ $result['age_text'] ?? '-' }}
                    </p>

                </div>


                <!-- BERAT -->
                <div class="value-card p-4">

                    <p class="text-xs text-gray-500">
                        Berat Badan
                    </p>

                    <p class="font-bold text-[#34156F] mt-1">
                        {{ number_format((float) $result['weight'], 2, ',', '.') }}
                        kg
                    </p>

                </div>


                <!-- TINGGI -->
                <div class="value-card p-4">

                    <p class="text-xs text-gray-500">
                        Tinggi Badan
                    </p>

                    <p class="font-bold text-[#34156F] mt-1">
                        {{ number_format((float) $result['height'], 2, ',', '.') }}
                        cm
                    </p>

                </div>

            </div>

        </section>


        <!-- =====================================================
             STATUS GIZI
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    📊
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Status Gizi
                    </h2>

                    <p class="text-sm text-gray-500">
                        Hasil berdasarkan indikator antropometri
                    </p>

                </div>

            </div>


            <div class="grid md:grid-cols-2 gap-4">


                <!-- =================================================
                     BB/U
                ================================================== -->
                <div class="status-card p-5">

                    @php
                        $statusBBU =
                            $result['statuses']['BB/U'] ?? null;

                        $statusLowerBBU =
                            strtolower(
                                (string) $statusBBU
                            );

                        $badgeBBU =
                            'bg-purple-100 text-purple-700';

                        if (
                            str_contains(
                                $statusLowerBBU,
                                'normal'
                            )
                        ) {
                            $badgeBBU =
                                'bg-green-100 text-green-700';
                        } elseif (
                            str_contains(
                                $statusLowerBBU,
                                'kurang'
                            ) ||
                            str_contains(
                                $statusLowerBBU,
                                'sangat'
                            )
                        ) {
                            $badgeBBU =
                                'bg-yellow-100 text-yellow-700';
                        } elseif (
                            str_contains(
                                $statusLowerBBU,
                                'lebih'
                            )
                        ) {
                            $badgeBBU =
                                'bg-red-100 text-red-700';
                        }
                    @endphp


                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                    ⚖️
                                </div>

                                <div>

                                    <p class="font-bold text-[#34156F]">
                                        BB/U
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Berat Badan menurut Umur
                                    </p>

                                </div>

                            </div>

                        </div>


                        @if($statusBBU)
                            <span
                                class="{{ $badgeBBU }}
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-bold
                                       text-right"
                            >
                                {{ $statusBBU }}
                            </span>
                        @else
                            <span
                                class="bg-gray-100 text-gray-500
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-semibold"
                            >
                                Tidak tersedia
                            </span>
                        @endif

                    </div>


                    <div class="mt-4 bg-white rounded-xl p-4 border border-purple-100">

                        <p class="text-xs text-gray-500">
                            Keterangan
                        </p>

                        @if($statusBBU)

                            <p class="text-sm text-gray-700 mt-1 leading-relaxed">
                                Status berat badan anak dibandingkan dengan standar berat badan berdasarkan usia.
                            </p>

                        @else

                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                Standar BB/U pada sistem tersedia sampai usia 60 bulan.
                            </p>

                        @endif

                    </div>

                </div>


                <!-- =================================================
                     TB/U
                ================================================== -->
                <div class="status-card p-5">

                    @php
                        $statusTBU =
                            $result['statuses']['TB/U'] ?? null;

                        $statusLowerTBU =
                            strtolower(
                                (string) $statusTBU
                            );

                        $badgeTBU =
                            'bg-purple-100 text-purple-700';

                        if (
                            str_contains(
                                $statusLowerTBU,
                                'normal'
                            )
                        ) {
                            $badgeTBU =
                                'bg-green-100 text-green-700';
                        } elseif (
                            str_contains(
                                $statusLowerTBU,
                                'pendek'
                            ) ||
                            str_contains(
                                $statusLowerTBU,
                                'sangat'
                            )
                        ) {
                            $badgeTBU =
                                'bg-yellow-100 text-yellow-700';
                        } elseif (
                            str_contains(
                                $statusLowerTBU,
                                'tinggi'
                            )
                        ) {
                            $badgeTBU =
                                'bg-purple-100 text-purple-700';
                        }
                    @endphp


                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                    📏
                                </div>

                                <div>

                                    <p class="font-bold text-[#34156F]">
                                        TB/U
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Tinggi Badan menurut Umur
                                    </p>

                                </div>

                            </div>

                        </div>


                        @if($statusTBU)

                            <span
                                class="{{ $badgeTBU }}
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-bold
                                       text-right"
                            >
                                {{ $statusTBU }}
                            </span>

                        @else

                            <span
                                class="bg-gray-100 text-gray-500
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-semibold"
                            >
                                Tidak tersedia
                            </span>

                        @endif

                    </div>


                    <div class="mt-4 bg-white rounded-xl p-4 border border-purple-100">

                        <p class="text-xs text-gray-500">
                            Keterangan
                        </p>

                        @if($statusTBU)

                            <p class="text-sm text-gray-700 mt-1 leading-relaxed">
                                Status tinggi badan anak dibandingkan dengan standar tinggi berdasarkan usia.
                            </p>

                        @else

                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                Standar TB/U pada sistem tersedia pada rentang standar pertumbuhan yang tersimpan.
                            </p>

                        @endif

                    </div>

                </div>


                <!-- =================================================
                     BB/TB
                ================================================== -->
                <div class="status-card p-5">

                    @php
                        $statusBBTB =
                            $result['statuses']['BB/TB'] ?? null;

                        $statusLowerBBTB =
                            strtolower(
                                (string) $statusBBTB
                            );

                        $badgeBBTB =
                            'bg-purple-100 text-purple-700';

                        if (
                            str_contains(
                                $statusLowerBBTB,
                                'baik'
                            )
                        ) {
                            $badgeBBTB =
                                'bg-green-100 text-green-700';
                        } elseif (
                            str_contains(
                                $statusLowerBBTB,
                                'kurang'
                            ) ||
                            str_contains(
                                $statusLowerBBTB,
                                'buruk'
                            )
                        ) {
                            $badgeBBTB =
                                'bg-yellow-100 text-yellow-700';
                        } elseif (
                            str_contains(
                                $statusLowerBBTB,
                                'lebih'
                            ) ||
                            str_contains(
                                $statusLowerBBTB,
                                'obesitas'
                            )
                        ) {
                            $badgeBBTB =
                                'bg-red-100 text-red-700';
                        }
                    @endphp


                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                    📐
                                </div>

                                <div>

                                    <p class="font-bold text-[#34156F]">
                                        BB/TB
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Berat Badan menurut Tinggi Badan
                                    </p>

                                </div>

                            </div>

                        </div>


                        @if($statusBBTB)

                            <span
                                class="{{ $badgeBBTB }}
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-bold
                                       text-right"
                            >
                                {{ $statusBBTB }}
                            </span>

                        @else

                            <span
                                class="bg-gray-100 text-gray-500
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-semibold"
                            >
                                Tidak tersedia
                            </span>

                        @endif

                    </div>


                    <div class="mt-4 bg-white rounded-xl p-4 border border-purple-100">

                        <p class="text-xs text-gray-500">
                            Keterangan
                        </p>

                        @if($statusBBTB)

                            <p class="text-sm text-gray-700 mt-1 leading-relaxed">
                                Status berat badan dibandingkan dengan tinggi badan anak.
                            </p>

                        @else

                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                Standar BB/TB berdasarkan data WFH yang tersedia pada sistem.
                            </p>

                        @endif

                    </div>

                </div>


                <!-- =================================================
                     IMT/U
                ================================================== -->
                <div class="status-card p-5">

                    @php
                        $statusIMTU =
                            $result['statuses']['IMT/U'] ?? null;

                        $statusLowerIMTU =
                            strtolower(
                                (string) $statusIMTU
                            );

                        $badgeIMTU =
                            'bg-purple-100 text-purple-700';

                        if (
                            str_contains(
                                $statusLowerIMTU,
                                'normal'
                            )
                        ) {
                            $badgeIMTU =
                                'bg-green-100 text-green-700';
                        } elseif (
                            str_contains(
                                $statusLowerIMTU,
                                'kurus'
                            ) ||
                            str_contains(
                                $statusLowerIMTU,
                                'sangat'
                            )
                        ) {
                            $badgeIMTU =
                                'bg-yellow-100 text-yellow-700';
                        } elseif (
                            str_contains(
                                $statusLowerIMTU,
                                'lebih'
                            ) ||
                            str_contains(
                                $statusLowerIMTU,
                                'gemuk'
                            ) ||
                            str_contains(
                                $statusLowerIMTU,
                                'obesitas'
                            )
                        ) {
                            $badgeIMTU =
                                'bg-red-100 text-red-700';
                        }
                    @endphp


                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                    📊
                                </div>

                                <div>

                                    <p class="font-bold text-[#34156F]">
                                        IMT/U
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Indeks Massa Tubuh menurut Umur
                                    </p>

                                </div>

                            </div>

                        </div>


                        @if($statusIMTU)

                            <span
                                class="{{ $badgeIMTU }}
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-bold
                                       text-right"
                            >
                                {{ $statusIMTU }}
                            </span>

                        @else

                            <span
                                class="bg-gray-100 text-gray-500
                                       px-3 py-1.5
                                       rounded-full
                                       text-xs
                                       font-semibold"
                            >
                                Tidak tersedia
                            </span>

                        @endif

                    </div>


                    <div class="mt-4 bg-white rounded-xl p-4 border border-purple-100">

                        <p class="text-xs text-gray-500">
                            Keterangan
                        </p>

                        @if($statusIMTU)

                            <p class="text-sm text-gray-700 mt-1 leading-relaxed">
                                Indeks massa tubuh anak dibandingkan dengan standar berdasarkan umur.
                            </p>

                        @else

                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                Data standar IMT/U untuk usia pemeriksaan belum ditemukan.
                            </p>

                        @endif

                    </div>

                </div>

            </div>


            <!-- RINGKASAN -->
            <div class="mt-5 p-5 rounded-2xl bg-purple-50 border border-purple-100">

                <div class="flex items-start gap-3">

                    <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center">
                        ℹ️
                    </div>

                    <div>

                        <p class="font-bold text-[#34156F]">
                            Ringkasan Status Gizi
                        </p>

                        <p class="text-sm text-purple-900/70 mt-1 leading-relaxed">
                            {{ $result['nutrition_status'] ?? 'Data status gizi belum tersedia' }}
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- =====================================================
             DATA BMI
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    📈
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Data Antropometri
                    </h2>

                    <p class="text-sm text-gray-500">
                        Nilai pengukuran yang digunakan
                    </p>

                </div>

            </div>


            <div class="grid md:grid-cols-3 gap-4">

                <div class="value-card p-5">

                    <p class="text-sm text-gray-500">
                        Berat Badan
                    </p>

                    <p class="text-2xl font-bold text-[#34156F] mt-1">
                        {{ number_format((float) $result['weight'], 2, ',', '.') }}
                        kg
                    </p>

                </div>


                <div class="value-card p-5">

                    <p class="text-sm text-gray-500">
                        Tinggi Badan
                    </p>

                    <p class="text-2xl font-bold text-[#34156F] mt-1">
                        {{ number_format((float) $result['height'], 2, ',', '.') }}
                        cm
                    </p>

                </div>


                <div class="value-card p-5">

                    <p class="text-sm text-gray-500">
                        IMT / BMI
                    </p>

                    <p class="text-2xl font-bold text-[#34156F] mt-1">
                        {{ number_format((float) $result['bmi'], 2, ',', '.') }}
                    </p>

                </div>

            </div>

        </section>


        <!-- =====================================================
             KEBUTUHAN ENERGI
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    🔥
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Kebutuhan Energi
                    </h2>

                    <p class="text-sm text-gray-500">
                        Perkiraan kebutuhan energi harian anak
                    </p>

                </div>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">


                <!-- BB IDEAL -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        BB Ideal
                    </p>

                    @if($result['ideal_weight'] !== null)

                        <p class="text-2xl font-bold text-[#34156F] mt-1">
                            {{ number_format(
                                (float) $result['ideal_weight'],
                                2,
                                ',',
                                '.'
                            ) }}
                        </p>

                        <p class="text-sm text-purple-700 mt-1">
                            kg
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>


                <!-- HEIGHT AGE -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        Height Age
                    </p>

                    @if($result['height_age_months'] !== null)

                        @php
                            $heightAgeYears =
                                intdiv(
                                    (int) $result['height_age_months'],
                                    12
                                );

                            $heightAgeRemaining =
                                (int) $result['height_age_months'] % 12;
                        @endphp

                        <p class="text-xl font-bold text-[#34156F] mt-1">
                            {{ $heightAgeYears }}
                            tahun
                        </p>

                        <p class="text-sm text-purple-700 mt-1">
                            {{ $heightAgeRemaining }} bulan
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>


                <!-- ENERGI/KG -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        Energi per Kg
                    </p>

                    @if($result['energy_per_kg'] !== null)

                        <p class="text-2xl font-bold text-[#34156F] mt-1">
                            {{ number_format(
                                (float) $result['energy_per_kg'],
                                0,
                                ',',
                                '.'
                            ) }}
                        </p>

                        <p class="text-sm text-purple-700 mt-1">
                            kkal/kg/hari
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>


                <!-- TOTAL ENERGI -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        Kebutuhan Energi
                    </p>

                    @if($result['energy_requirement'] !== null)

                        <p class="text-2xl font-bold text-[#34156F] mt-1">
                            {{ number_format(
                                (float) $result['energy_requirement'],
                                2,
                                ',',
                                '.'
                            ) }}
                        </p>

                        <p class="text-sm text-purple-700 mt-1">
                            kkal/hari
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>

            </div>


            @if(
                $result['ideal_weight'] !== null &&
                $result['energy_per_kg'] !== null &&
                $result['energy_requirement'] !== null
            )

                <div class="mt-6 p-5 rounded-xl bg-purple-50 border border-purple-100">

                    <p class="text-sm font-semibold text-[#34156F] mb-2">
                        Dasar Perhitungan
                    </p>

                    <p class="text-gray-600 text-sm">
                        BB Ideal × Kebutuhan Energi
                    </p>

                    <p class="font-bold text-[#34156F] mt-2">

                        {{ number_format(
                            (float) $result['ideal_weight'],
                            2,
                            ',',
                            '.'
                        ) }}

                        kg

                        ×

                        {{ number_format(
                            (float) $result['energy_per_kg'],
                            0,
                            ',',
                            '.'
                        ) }}

                        kkal/kg/hari

                        =

                        {{ number_format(
                            (float) $result['energy_requirement'],
                            2,
                            ',',
                            '.'
                        ) }}

                        kkal/hari

                    </p>

                </div>

            @endif

        </section>


        <!-- =====================================================
             FOOD QUANTITATIVE
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    🍽️
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Food Quantitative
                    </h2>

                    <p class="text-sm text-gray-500">
                        Pembagian kebutuhan energi dari makanan padat dan liquid
                    </p>

                </div>

            </div>


            <div class="grid md:grid-cols-2 gap-5">


                <!-- SOLID -->
                <div class="border border-purple-200 bg-purple-50 rounded-2xl p-6">

                    <div class="flex items-center justify-between mb-4">

                        <div>

                            <p class="text-sm text-purple-700">
                                Solid Food
                            </p>

                            <h3 class="text-3xl font-bold text-[#34156F]">
                                {{ number_format(
                                    (float) $result['solid_percentage'],
                                    0,
                                    ',',
                                    '.'
                                ) }}%
                            </h3>

                        </div>

                        <div class="text-4xl">
                            🍚
                        </div>

                    </div>


                    <div class="bg-white rounded-xl p-4">

                        <p class="text-sm text-gray-500">
                            Kebutuhan energi dari solid food
                        </p>

                        @if($result['solid_energy'] !== null)

                            <p class="text-xl font-bold text-[#34156F] mt-1">
                                {{ number_format(
                                    (float) $result['solid_energy'],
                                    2,
                                    ',',
                                    '.'
                                ) }}
                                kkal/hari
                            </p>

                        @else

                            <p class="font-semibold text-gray-500 mt-1">
                                Tidak tersedia
                            </p>

                        @endif

                    </div>

                </div>


                <!-- LIQUID -->
                <div class="border border-purple-200 bg-purple-50 rounded-2xl p-6">

                    <div class="flex items-center justify-between mb-4">

                        <div>

                            <p class="text-sm text-purple-700">
                                Liquid Food / ASI
                            </p>

                            <h3 class="text-3xl font-bold text-[#34156F]">
                                {{ number_format(
                                    (float) $result['liquid_percentage'],
                                    0,
                                    ',',
                                    '.'
                                ) }}%
                            </h3>

                        </div>

                        <div class="text-4xl">
                            🍼
                        </div>

                    </div>


                    <div class="bg-white rounded-xl p-4 mb-4">

                        <p class="text-sm text-gray-500">
                            Kebutuhan energi dari liquid food
                        </p>

                        @if($result['liquid_energy'] !== null)

                            <p class="text-xl font-bold text-[#34156F] mt-1">
                                {{ number_format(
                                    (float) $result['liquid_energy'],
                                    2,
                                    ',',
                                    '.'
                                ) }}
                                kkal/hari
                            </p>

                        @else

                            <p class="font-semibold text-gray-500 mt-1">
                                Tidak tersedia
                            </p>

                        @endif

                    </div>


                    <div class="bg-white rounded-xl p-4">

                        <p class="text-sm text-gray-500">
                            Perkiraan volume liquid
                        </p>

                        @if($result['liquid_ml'] !== null)

                            <p class="text-xl font-bold text-[#34156F] mt-1">
                                {{ number_format(
                                    (float) $result['liquid_ml'],
                                    2,
                                    ',',
                                    '.'
                                ) }}
                                ml/hari
                            </p>

                        @else

                            <p class="font-semibold text-gray-500 mt-1">
                                Tidak tersedia
                            </p>

                        @endif

                    </div>

                </div>

            </div>


            @if(
                isset($result['food_quantitative']) &&
                isset($result['food_quantitative']['description'])
            )

                <div class="mt-5 bg-purple-50 border border-purple-100 rounded-xl p-5">

                    <p class="font-semibold text-[#34156F] mb-1">
                        Keterangan
                    </p>

                    <p class="text-gray-600 leading-relaxed">
                        {{ $result['food_quantitative']['description'] }}
                    </p>

                </div>

            @endif

        </section>


        <!-- =====================================================
             ZAT GIZI MAKRO
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    🥗
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Kebutuhan Zat Gizi Makro
                    </h2>

                    <p class="text-sm text-gray-500">
                        Perkiraan kebutuhan protein, lemak, dan karbohidrat
                    </p>

                </div>

            </div>


            <div class="grid md:grid-cols-3 gap-4">


                <!-- PROTEIN -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        Protein
                    </p>

                    @if($result['protein_requirement'] !== null)

                        <p class="text-3xl font-bold text-[#34156F] mt-1">
                            {{ number_format(
                                (float) $result['protein_requirement'],
                                2,
                                ',',
                                '.'
                            ) }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            gram/hari
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>


                <!-- LEMAK -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        Lemak
                    </p>

                    @if($result['fat_requirement'] !== null)

                        <p class="text-3xl font-bold text-[#34156F] mt-1">
                            {{ number_format(
                                (float) $result['fat_requirement'],
                                2,
                                ',',
                                '.'
                            ) }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            gram/hari
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>


                <!-- KARBOHIDRAT -->
                <div class="value-card p-5">

                    <p class="text-sm text-purple-700">
                        Karbohidrat
                    </p>

                    @if($result['carbohydrate_requirement'] !== null)

                        <p class="text-3xl font-bold text-[#34156F] mt-1">
                            {{ number_format(
                                (float) $result['carbohydrate_requirement'],
                                2,
                                ',',
                                '.'
                            ) }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            gram/hari
                        </p>

                    @else

                        <p class="text-lg font-bold text-gray-500 mt-1">
                            Tidak tersedia
                        </p>

                    @endif

                </div>

            </div>

        </section>


        <!-- =====================================================
             REKOMENDASI
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="flex items-center gap-3 mb-5">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    💡
                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#34156F]">
                        Rekomendasi
                    </h2>

                    <p class="text-sm text-gray-500">
                        Saran berdasarkan hasil perhitungan
                    </p>

                </div>

            </div>


            <div class="bg-purple-50 border border-purple-100 rounded-xl p-5">

                <p class="text-purple-950 leading-relaxed">
                    {{ $result['recommendation'] ?? '-' }}
                </p>

            </div>

        </section>


        <!-- =====================================================
             CATATAN
        ====================================================== -->
        <section class="card p-6 mb-6">

            <div class="bg-purple-50 border border-purple-100 rounded-xl p-5">

                <div class="flex gap-3">

                    <div class="text-2xl">
                        ℹ️
                    </div>

                    <div>

                        <h3 class="font-bold text-[#34156F]">
                            Catatan
                        </h3>

                        <p class="text-sm text-purple-900/70 mt-2 leading-relaxed">
                            Hasil pada website ini digunakan sebagai media
                            informasi dan pemantauan. Hasil perhitungan bukan
                            pengganti konsultasi langsung dengan tenaga kesehatan
                            atau ahli gizi.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- =====================================================
             BUTTON
        ====================================================== -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pb-8">

            <a
                href="{{ route('user.nutrition.create') }}"
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
                Hitung Nutrisi Lagi
            </a>


            <a
                href="{{ route('user.dashboard') }}"
                class="bg-white
                       hover:bg-purple-50
                       text-purple-700
                       border border-purple-200
                       font-semibold
                       px-6 py-3
                       rounded-xl
                       text-center
                       transition"
            >
                Kembali ke Dashboard
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