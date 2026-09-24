<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Anak - Puskesmas Seroja</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F7F5FF;
            color: #34156F;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input {
            font-family: inherit;
        }

        /* HEADER */
        .topbar {
            background: linear-gradient(135deg, #6D28D9, #8B5CF6);
            color: white;
            padding: 20px 0;
            box-shadow: 0 8px 25px rgba(109, 40, 217, 0.18);
        }

        .topbar-content {
            max-width: 1200px;
            margin: auto;
            padding: 0 22px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-icon {
            width: 47px;
            height: 47px;

            border-radius: 14px;
            background: rgba(255, 255, 255, 0.17);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 23px;
        }

        .brand-text h1 {
            font-size: 19px;
            margin-bottom: 4px;
        }

        .brand-text p {
            font-size: 12px;
            opacity: 0.85;
        }

        .back-button {
            padding: 10px 15px;

            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.1);
            color: white;

            font-size: 13px;
            font-weight: 600;

            transition: 0.2s ease;
        }

        .back-button:hover {
            background: white;
            color: #6D28D9;
        }

        /* CONTAINER */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px 22px 50px;
        }

        /* PAGE INTRO */
        .page-header {
            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 22px;

            padding: 26px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;

            box-shadow: 0 8px 25px rgba(52, 21, 111, 0.05);
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-icon {
            width: 58px;
            height: 58px;

            border-radius: 17px;
            background: #F3E8FF;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 27px;
        }

        .page-title h2 {
            font-size: 25px;
            color: #34156F;
            margin-bottom: 6px;
        }

        .page-title p {
            color: #6B7280;
            font-size: 13px;
            line-height: 1.5;
        }

        .add-button {
            background: #6D28D9;
            color: white;

            padding: 12px 18px;
            border-radius: 12px;

            font-size: 14px;
            font-weight: 700;

            box-shadow: 0 6px 15px rgba(109, 40, 217, 0.2);

            transition: 0.2s ease;
        }

        .add-button:hover {
            background: #5B21B6;
            transform: translateY(-1px);
        }

        /* SUCCESS */
        .success-message {
            margin-top: 18px;

            padding: 14px 17px;

            border-radius: 13px;

            background: #F3E8FF;
            border: 1px solid #DDD0FF;

            color: #5B21B6;

            font-size: 14px;
            font-weight: 600;
        }

        /* ERROR */
        .error-message {
            margin-top: 18px;

            padding: 14px 17px;

            border-radius: 13px;

            background: #FFF1F2;
            border: 1px solid #FECDD3;

            color: #BE123C;

            font-size: 14px;
        }

        /* SECTION */
        .section-header {
            margin-top: 30px;
            margin-bottom: 17px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header h3 {
            font-size: 20px;
            color: #34156F;
        }

        .section-header span {
            font-size: 12px;
            color: #6B7280;
        }

        /* CHILD GRID */
        .children-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .child-card {
            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 20px;

            padding: 21px;

            box-shadow: 0 7px 20px rgba(52, 21, 111, 0.05);

            transition: 0.2s ease;
        }

        .child-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 13px 28px rgba(52, 21, 111, 0.08);
            border-color: #DAC8FF;
        }

        .child-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .child-profile {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .child-avatar {
            width: 50px;
            height: 50px;

            border-radius: 15px;
            background: #F3E8FF;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;
        }

        .child-name h4 {
            font-size: 17px;
            color: #34156F;
            margin-bottom: 5px;
        }

        .child-gender {
            font-size: 12px;
            color: #6B7280;
        }

        .gender-badge {
            padding: 6px 10px;

            border-radius: 9px;
            background: #F3E8FF;
            color: #6D28D9;

            font-size: 11px;
            font-weight: 700;
        }

        /* DATA */
        .data-list {
            margin-top: 20px;

            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .data-box {
            background: #FAF9FF;
            border: 1px solid #F0EBFF;

            padding: 12px;
            border-radius: 12px;
        }

        .data-label {
            color: #8A8494;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .data-value {
            color: #34156F;
            font-size: 13px;
            font-weight: 700;
        }

        /* AGE */
        .age-box {
            margin-top: 10px;

            background: linear-gradient(
                135deg,
                #F3E8FF,
                #FAF9FF
            );

            border: 1px solid #E9D8FF;
            border-radius: 13px;

            padding: 13px 14px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .age-label {
            color: #6B7280;
            font-size: 12px;
        }

        .age-value {
            color: #6D28D9;
            font-size: 14px;
            font-weight: 700;
        }

        /* ACTION */
        .action-area {
            margin-top: 18px;

            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .action-button {
            min-height: 42px;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 12px;
            font-weight: 700;

            transition: 0.2s ease;
        }

        .edit-button {
            background: #F3E8FF;
            color: #6D28D9;
            border: 1px solid #E5D7FF;
        }

        .edit-button:hover {
            background: #E9D8FF;
        }

        .nutrition-button {
            background: #6D28D9;
            color: white;
        }

        .nutrition-button:hover {
            background: #5B21B6;
        }

        .delete-form {
            margin-top: 10px;
        }

        .delete-button {
            width: 100%;
            height: 38px;

            border: 1px solid #F1D0DA;
            border-radius: 10px;

            background: #FFF7F8;
            color: #BE123C;

            cursor: pointer;

            font-size: 12px;
            font-weight: 700;

            transition: 0.2s ease;
        }

        .delete-button:hover {
            background: #FFF1F2;
        }

        /* EMPTY */
        .empty-card {
            background: white;
            border: 1px dashed #DCCEFF;
            border-radius: 20px;

            padding: 45px 25px;

            text-align: center;

            box-shadow: 0 6px 18px rgba(52, 21, 111, 0.04);
        }

        .empty-icon {
            width: 70px;
            height: 70px;

            margin: auto;

            border-radius: 20px;
            background: #F3E8FF;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 31px;
        }

        .empty-card h3 {
            margin-top: 16px;
            color: #34156F;
            font-size: 19px;
        }

        .empty-card p {
            margin-top: 7px;
            color: #6B7280;
            font-size: 13px;
            line-height: 1.6;
        }

        .empty-add {
            display: inline-block;

            margin-top: 18px;

            background: #6D28D9;
            color: white;

            padding: 11px 17px;
            border-radius: 11px;

            font-size: 13px;
            font-weight: 700;
        }

        /* FOOTER */
        footer {
            margin-top: 42px;

            text-align: center;

            color: #8A8494;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 850px) {

            .children-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 650px) {

            .topbar-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .add-button {
                width: 100%;
                text-align: center;
            }

            .data-list {
                grid-template-columns: 1fr;
            }

        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="topbar">

        <div class="topbar-content">

            <div class="brand">

                <div class="brand-icon">
                    🏥
                </div>

                <div class="brand-text">
                    <h1>Puskesmas Seroja</h1>
                    <p>Sistem Informasi Gizi Anak</p>
                </div>

            </div>

            <a
                href="{{ route('user.dashboard') }}"
                class="back-button"
            >
                ← Dashboard
            </a>

        </div>

    </header>


    <main class="container">

        <!-- JUDUL HALAMAN -->
        <div class="page-header">

            <div class="page-title">

                <div class="page-icon">
                    👶
                </div>

                <div>
                    <h2>
                        Data Anak
                    </h2>

                    <p>
                        Kelola informasi anak untuk membantu
                        pemantauan pertumbuhan dan kebutuhan nutrisi.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('user.children.create') }}"
                class="add-button"
            >
                + Tambah Anak
            </a>

        </div>


        <!-- PESAN SUKSES -->
        @if (session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif


        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div class="error-message">

                <strong>
                    Terjadi kesalahan:
                </strong>

                <div style="margin-top: 6px;">
                    {{ $errors->first() }}
                </div>

            </div>
        @endif


        <!-- JUDUL DATA -->
        <div class="section-header">

            <h3>
                Daftar Anak
            </h3>

            <span>
                {{ $children->count() }} data
            </span>

        </div>


        @if ($children->count() > 0)

            <div class="children-grid">

                @foreach ($children as $child)

                    @php

                        $totalMonths = 0;
                        $years = 0;
                        $months = 0;

                        if ($child->birth_date) {

                            $birthDate = \Carbon\Carbon::parse(
                                $child->birth_date
                            );

                            $today = \Carbon\Carbon::today();

                            if ($birthDate->lte($today)) {

                                $totalMonths = $birthDate->diffInMonths(
                                    $today
                                );

                                $years = intdiv(
                                    $totalMonths,
                                    12
                                );

                                $months = $totalMonths % 12;
                            }
                        }

                    @endphp


                    <!-- CARD ANAK -->
                    <div class="child-card">

                        <!-- BAGIAN ATAS -->
                        <div class="child-top">

                            <div class="child-profile">

                                <div class="child-avatar">
                                    @if ($child->gender === 'L')
                                        👦
                                    @else
                                        👧
                                    @endif
                                </div>

                                <div class="child-name">

                                    <h4>
                                        {{ $child->name }}
                                    </h4>

                                    <div class="child-gender">

                                        @if ($child->gender === 'L')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                    </div>

                                </div>

                            </div>


                            <div class="gender-badge">

                                @if ($child->gender === 'L')
                                    L
                                @else
                                    P
                                @endif

                            </div>

                        </div>


                        <!-- DATA ANAK -->
                        <div class="data-list">

                            <div class="data-box">

                                <div class="data-label">
                                    Tanggal Lahir
                                </div>

                                <div class="data-value">

                                    @if ($child->birth_date)
                                        {{ \Carbon\Carbon::parse($child->birth_date)->format('d M Y') }}
                                    @else
                                        -
                                    @endif

                                </div>

                            </div>


                            <div class="data-box">

                                <div class="data-label">
                                    Berat Badan
                                </div>

                                <div class="data-value">
                                    {{ number_format((float) $child->weight, 2, ',', '.') }}
                                    kg
                                </div>

                            </div>


                            <div class="data-box">

                                <div class="data-label">
                                    Tinggi Badan
                                </div>

                                <div class="data-value">
                                    {{ number_format((float) $child->height, 2, ',', '.') }}
                                    cm
                                </div>

                            </div>


                            <div class="data-box">

                                <div class="data-label">
                                    Status Data
                                </div>

                                <div class="data-value">
                                    ✓ Tersimpan
                                </div>

                            </div>

                        </div>


                        <!-- UMUR -->
                        <div class="age-box">

                            <span class="age-label">
                                Umur anak
                            </span>

                            <span class="age-value">

                                @if ($years > 0 && $months > 0)

                                    {{ $years }} tahun
                                    {{ $months }} bulan

                                @elseif ($years > 0)

                                    {{ $years }} tahun

                                @elseif ($months > 0)

                                    {{ $months }} bulan

                                @else

                                    Kurang dari 1 bulan

                                @endif

                            </span>

                        </div>


                        <!-- BUTTON -->
                        <div class="action-area">

                            <a
                                href="{{ route('user.children.edit', $child->id) }}"
                                class="action-button edit-button"
                            >
                                ✏️ Edit Data
                            </a>


                            <a
                                href="{{ route('user.nutrition.create') }}?child_id={{ $child->id }}"
                                class="action-button nutrition-button"
                            >
                                🥗 Hitung Nutrisi
                            </a>

                        </div>


                        <!-- HAPUS -->
                        <form
                            action="{{ route('user.children.destroy', $child->id) }}"
                            method="POST"
                            class="delete-form"
                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus data anak ini?');"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button"
                            >
                                🗑️ Hapus Data Anak
                            </button>

                        </form>

                    </div>

                @endforeach

            </div>

        @else

            <!-- DATA KOSONG -->
            <div class="empty-card">

                <div class="empty-icon">
                    👶
                </div>

                <h3>
                    Belum Ada Data Anak
                </h3>

                <p>
                    Tambahkan data anak terlebih dahulu untuk
                    menggunakan fitur pemantauan pertumbuhan
                    dan perhitungan nutrisi.
                </p>

                <a
                    href="{{ route('user.children.create') }}"
                    class="empty-add"
                >
                    + Tambah Data Anak
                </a>

            </div>

        @endif


        <!-- FOOTER -->
        <footer>
            © {{ date('Y') }} Puskesmas Seroja
            • Sistem Informasi Gizi Anak
        </footer>

    </main>

</body>
</html>