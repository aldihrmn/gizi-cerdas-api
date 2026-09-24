<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Perhitungan Gizi - Gizi Cerdas</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f3ff;
            color: #1f2937;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #6d28d9, #4c1d95);
            color: white;
            padding: 30px 20px;
        }

        .logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            opacity: .7;
            margin: 20px 10px 10px;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, .15);
        }

        .menu a.active {
            background: white;
            color: #5b21b6;
            font-weight: bold;
        }

        .logout {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 25px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: rgba(255, 255, 255, .15);
            color: white;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: rgba(255, 255, 255, .25);
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #111827;
        }

        .topbar p {
            margin-top: 7px;
            color: #6b7280;
            font-size: 14px;
        }

        .back-button {
            display: inline-block;
            background: white;
            color: #5b21b6;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .05);
        }

        .profile-card {
            background: linear-gradient(135deg, #6d28d9, #7c3aed);
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 12px 30px rgba(109, 40, 217, .18);
        }

        .profile-card h2 {
            font-size: 26px;
            margin-bottom: 20px;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .profile-item {
            background: rgba(255, 255, 255, .12);
            padding: 15px;
            border-radius: 12px;
        }

        .profile-item small {
            display: block;
            opacity: .75;
            margin-bottom: 6px;
            font-size: 12px;
        }

        .profile-item strong {
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        }

        .card h3 {
            font-size: 19px;
            margin-bottom: 20px;
            color: #111827;
        }

        .measurement-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .measurement-item {
            background: #f9fafb;
            border-radius: 12px;
            padding: 18px;
        }

        .measurement-item small {
            display: block;
            color: #6b7280;
            margin-bottom: 6px;
            font-size: 12px;
        }

        .measurement-item strong {
            font-size: 22px;
            color: #111827;
        }

        .index-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .index-card {
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            padding: 22px;
            background: #fff;
        }

        .index-title {
            color: #5b21b6;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .index-description {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .zscore {
            font-size: 32px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 12px;
        }

        .status {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 9px;
            background: #ede9fe;
            color: #5b21b6;
            font-size: 13px;
            font-weight: bold;
        }

        .status-warning {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-good {
            background: #dcfce7;
            color: #166534;
        }

        .conclusion {
            background: #f5f3ff;
            border-left: 5px solid #6d28d9;
            padding: 20px;
            border-radius: 10px;
            line-height: 1.8;
        }

        .recommendation {
            background: #f0fdf4;
            border-left: 5px solid #16a34a;
            padding: 20px;
            border-radius: 10px;
            line-height: 1.8;
        }

        .note {
            background: #fff7ed;
            border-left: 5px solid #f97316;
            padding: 18px;
            border-radius: 10px;
            margin-top: 15px;
            line-height: 1.7;
            color: #7c2d12;
            font-size: 13px;
        }

        .empty-result {
            padding: 30px;
            text-align: center;
            color: #6b7280;
        }

        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
            padding: 10px 0 20px;
        }

        @media (max-width: 1000px) {

            .profile-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .measurement-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .index-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .logout {
                position: static;
                margin-top: 20px;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .profile-grid,
            .measurement-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


    <aside class="sidebar">

        <div class="logo">
            Gizi Cerdas
        </div>


        <div class="menu-title">
            Menu Utama
        </div>


        <div class="menu">

            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}">
                Data User
            </a>

            <a href="{{ route('admin.children.index') }}">
                Data Anak
            </a>

            <a href="{{ route('admin.growth.index') }}">
                Pertumbuhan
            </a>

            <a
                href="{{ route('admin.nutrition.index') }}"
                class="active"
            >
                Perhitungan Gizi
            </a>

        </div>


        <div class="logout">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button type="submit">
                    Keluar
                </button>

            </form>

        </div>

    </aside>


    <main class="content">


        <div class="topbar">

            <div>

                <h1>
                    Hasil Perhitungan Gizi
                </h1>

                <p>
                    Hasil penilaian antropometri anak
                </p>

            </div>


            <a
                href="{{ route('admin.nutrition.index') }}"
                class="back-button"
            >
                ← Kembali
            </a>

        </div>


        {{-- DATA ANAK --}}

        <div class="profile-card">

            <h2>
                {{ $result['child']->name }}
            </h2>


            <div class="profile-grid">


                <div class="profile-item">

                    <small>
                        Jenis Kelamin
                    </small>

                    <strong>

                        @if($result['child']->gender === 'L')

                            Laki-laki

                        @else

                            Perempuan

                        @endif

                    </strong>

                </div>


                <div class="profile-item">

                    <small>
                        Umur
                    </small>

                    <strong>
                        {{ $result['ageInMonths'] }} bulan
                    </strong>

                </div>


                <div class="profile-item">

                    <small>
                        Orang Tua
                    </small>

                    <strong>
                        {{ $result['child']->user->name ?? '-' }}
                    </strong>

                </div>


                <div class="profile-item">

                    <small>
                        Tanggal Perhitungan
                    </small>

                    <strong>
                        {{ \Carbon\Carbon::parse($calculation->calculation_date)->format('d-m-Y') }}
                    </strong>

                </div>


            </div>

        </div>


        {{-- DATA PENGUKURAN --}}

        <div class="card">

            <h3>
                Data Pengukuran
            </h3>


            <div class="measurement-grid">


                <div class="measurement-item">

                    <small>
                        Berat Badan
                    </small>

                    <strong>
                        {{ number_format($result['weight'], 2) }} kg
                    </strong>

                </div>


                <div class="measurement-item">

                    <small>
                        Tinggi / Panjang Badan
                    </small>

                    <strong>
                        {{ number_format($result['height'], 1) }} cm
                    </strong>

                </div>


                <div class="measurement-item">

                    <small>
                        IMT
                    </small>

                    <strong>
                        {{ number_format($result['bmi'], 2) }}
                    </strong>

                </div>


            </div>

        </div>


        {{-- HASIL INDEKS --}}

        <div class="card">

            <h3>
                Hasil Indeks Antropometri
            </h3>


            <div class="index-grid">


                {{-- BB/U --}}

                <div class="index-card">

                    <div class="index-title">
                        BB/U
                    </div>

                    <div class="index-description">
                        Berat Badan menurut Umur
                    </div>

                    <div class="zscore">

                        @if($result['weightZScore'] !== null)

                            {{ number_format($result['weightZScore'], 2) }}

                        @else

                            -

                        @endif

                    </div>

                    <span class="status">

                        {{ $result['weightStatus'] }}

                    </span>

                </div>


                {{-- TB/U ATAU PB/U --}}

                <div class="index-card">

                    <div class="index-title">
                        {{ $result['heightLabel'] }}
                    </div>

                    <div class="index-description">

                        @if($result['heightLabel'] === 'PB/U')

                            Panjang Badan menurut Umur

                        @else

                            Tinggi Badan menurut Umur

                        @endif

                    </div>


                    <div class="zscore">

                        @if($result['heightZScore'] !== null)

                            {{ number_format($result['heightZScore'], 2) }}

                        @else

                            -

                        @endif

                    </div>


                    <span class="status">

                        {{ $result['heightStatus'] }}

                    </span>

                </div>


                {{-- BB/TB ATAU BB/PB --}}

                <div class="index-card">

                    <div class="index-title">
                        {{ $result['weightHeightLabel'] }}
                    </div>

                    <div class="index-description">

                        @if($result['weightHeightLabel'] === 'BB/PB')

                            Berat Badan menurut Panjang Badan

                        @else

                            Berat Badan menurut Tinggi Badan

                        @endif

                    </div>


                    <div class="zscore">

                        @if($result['weightHeightZScore'] !== null)

                            {{ number_format($result['weightHeightZScore'], 2) }}

                        @else

                            -

                        @endif

                    </div>


                    <span class="status">

                        {{ $result['weightHeightStatus'] }}

                    </span>

                </div>


                {{-- IMT/U --}}

                <div class="index-card">

                    <div class="index-title">
                        IMT/U
                    </div>

                    <div class="index-description">
                        Indeks Massa Tubuh menurut Umur
                    </div>


                    <div class="zscore">

                        @if($result['bmiZScore'] !== null)

                            {{ number_format($result['bmiZScore'], 2) }}

                        @else

                            -

                        @endif

                    </div>


                    <span class="status">

                        {{ $result['bmiStatus'] }}

                    </span>

                </div>


            </div>

        </div>


        {{-- KESIMPULAN --}}

        <div class="card">

            <h3>
                Kesimpulan
            </h3>


            <div class="conclusion">

                {!! nl2br(e($result['nutritionStatus'])) !!}

            </div>


            <div class="note">

                <strong>
                    Catatan:
                </strong>

                Hasil penilaian menggunakan indeks antropometri
                berdasarkan data yang tersedia pada sistem.
                Penilaian status gizi perlu memperhatikan keempat
                indeks antropometri secara bersama-sama.

            </div>

        </div>


        {{-- REKOMENDASI --}}

        <div class="card">

            <h3>
                Rekomendasi
            </h3>


            <div class="recommendation">

                {{ $result['recommendation'] }}

            </div>

        </div>


        <div class="footer">

            © {{ date('Y') }} Gizi Cerdas - Sistem Informasi Gizi Anak

        </div>


    </main>


</body>

</html>