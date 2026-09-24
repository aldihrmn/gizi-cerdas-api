<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Detail Pertumbuhan - Puskesmas Seroja
    </title>


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


        /* ===============================
           HEADER
        =============================== */

        .topbar {
            background:
                linear-gradient(
                    135deg,
                    #6D28D9,
                    #8B5CF6
                );

            color: white;

            padding: 20px 0;

            box-shadow:
                0 8px 25px rgba(109, 40, 217, 0.18);
        }


        .topbar-content {
            max-width: 1100px;

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

            background:
                rgba(255,255,255,0.17);

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

            border:
                1px solid
                rgba(255,255,255,0.3);

            border-radius: 10px;

            background:
                rgba(255,255,255,0.10);

            color: white;

            font-size: 13px;

            font-weight: 600;

            transition: 0.2s ease;
        }


        .back-button:hover {
            background: white;

            color: #6D28D9;
        }


        /* ===============================
           CONTAINER
        =============================== */

        .container {
            max-width: 1100px;

            margin: auto;

            padding:
                30px 22px 50px;
        }


        /* ===============================
           PAGE HEADER
        =============================== */

        .page-header {
            background: white;

            border:
                1px solid #EEE7FF;

            border-radius: 22px;

            padding: 25px;

            display: flex;

            align-items: center;

            gap: 16px;

            box-shadow:
                0 8px 25px
                rgba(52,21,111,0.05);
        }


        .page-icon {
            width: 58px;
            height: 58px;

            border-radius: 17px;

            background: #F3E8FF;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 28px;
        }


        .page-header h2 {
            font-size: 25px;

            color: #34156F;

            margin-bottom: 6px;
        }


        .page-header p {
            color: #6B7280;

            font-size: 13px;

            line-height: 1.6;
        }


        /* ===============================
           CONTENT GRID
        =============================== */

        .content-grid {
            margin-top: 22px;

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 18px;
        }


        /* ===============================
           CARD
        =============================== */

        .card {
            background: white;

            border:
                1px solid #EEE7FF;

            border-radius: 20px;

            padding: 23px;

            box-shadow:
                0 7px 20px
                rgba(52,21,111,0.05);
        }


        .card-title {
            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 20px;

            padding-bottom: 14px;

            border-bottom:
                1px solid #F0EBFF;
        }


        .card-title-icon {
            width: 39px;
            height: 39px;

            border-radius: 11px;

            background: #F3E8FF;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 18px;
        }


        .card-title h3 {
            font-size: 17px;

            color: #34156F;
        }


        /* ===============================
           CHILD PROFILE
        =============================== */

        .child-profile {
            display: flex;

            align-items: center;

            gap: 14px;

            padding: 15px;

            border-radius: 15px;

            background: #FAF8FF;

            border:
                1px solid #F0EBFF;
        }


        .child-avatar {
            width: 54px;
            height: 54px;

            min-width: 54px;

            border-radius: 16px;

            background: #F3E8FF;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 26px;
        }


        .child-name {
            color: #34156F;

            font-size: 17px;

            font-weight: 700;

            margin-bottom: 4px;
        }


        .child-gender {
            color: #6B7280;

            font-size: 12px;
        }


        /* ===============================
           DATA LIST
        =============================== */

        .data-list {
            margin-top: 16px;

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 10px;
        }


        .data-box {
            padding: 14px;

            background: #FCFBFF;

            border:
                1px solid #F0EBFF;

            border-radius: 13px;
        }


        .data-label {
            color: #8A8494;

            font-size: 11px;

            margin-bottom: 6px;
        }


        .data-value {
            color: #34156F;

            font-size: 14px;

            font-weight: 700;
        }


        /* ===============================
           MEASUREMENT
        =============================== */

        .measurement-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;
        }


        .measurement-card {
            background:
                linear-gradient(
                    135deg,
                    #F3E8FF,
                    #FAF9FF
                );

            border:
                1px solid #E5D7FF;

            border-radius: 16px;

            padding: 18px;
        }


        .measurement-icon {
            width: 38px;
            height: 38px;

            border-radius: 11px;

            background: white;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 18px;

            margin-bottom: 12px;
        }


        .measurement-label {
            color: #6B7280;

            font-size: 11px;

            margin-bottom: 4px;
        }


        .measurement-value {
            color: #6D28D9;

            font-size: 23px;

            font-weight: 700;
        }


        .measurement-unit {
            color: #8A8494;

            font-size: 11px;
        }


        /* ===============================
           INFO ROW
        =============================== */

        .info-row {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 12px 0;

            border-bottom:
                1px solid #F3F0FA;
        }


        .info-row:last-child {
            border-bottom: none;
        }


        .info-row-label {
            color: #6B7280;

            font-size: 12px;
        }


        .info-row-value {
            color: #34156F;

            font-size: 13px;

            font-weight: 700;

            text-align: right;
        }


        /* ===============================
           STATUS
        =============================== */

        .status-box {
            margin-top: 18px;

            padding: 17px;

            border-radius: 15px;

            background: #F3E8FF;

            border:
                1px solid #E5D7FF;
        }


        .status-title {
            color: #6D28D9;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            margin-bottom: 6px;
        }


        .status-text {
            color: #34156F;

            font-size: 15px;

            font-weight: 700;
        }


        /* ===============================
           NOTE
        =============================== */

        .note-box {
            padding: 16px;

            background: #FAF8FF;

            border:
                1px solid #F0EBFF;

            border-radius: 14px;
        }


        .note-title {
            color: #34156F;

            font-size: 12px;

            font-weight: 700;

            margin-bottom: 7px;
        }


        .note-text {
            color: #6B7280;

            font-size: 12px;

            line-height: 1.7;
        }


        /* ===============================
           ACTION
        =============================== */

        .action-area {
            margin-top: 22px;

            display: flex;

            justify-content: flex-end;

            gap: 10px;
        }


        .button {
            min-width: 135px;

            height: 43px;

            border-radius: 11px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 12px;

            font-weight: 700;

            transition: 0.2s ease;
        }


        .back-page-button {
            background: white;

            border:
                1px solid #DDD6FE;

            color: #6B7280;
        }


        .back-page-button:hover {
            background: #FAF9FF;

            color: #6D28D9;
        }


        .edit-button {
            background: #6D28D9;

            color: white;

            box-shadow:
                0 6px 15px
                rgba(109,40,217,0.20);
        }


        .edit-button:hover {
            background: #5B21B6;

            transform:
                translateY(-1px);
        }


        /* ===============================
           FOOTER
        =============================== */

        footer {
            margin-top: 40px;

            text-align: center;

            color: #8A8494;

            font-size: 12px;
        }


        /* ===============================
           RESPONSIVE
        =============================== */

        @media (max-width: 800px) {

            .content-grid {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 600px) {

            .topbar-content {
                flex-direction: column;

                align-items: flex-start;
            }


            .page-header {
                padding: 20px;
            }


            .card {
                padding: 20px;
            }


            .data-list,
            .measurement-grid {
                grid-template-columns: 1fr;
            }


            .action-area {
                flex-direction:
                    column-reverse;
            }


            .button {
                width: 100%;
            }

        }

    </style>

</head>


<body>


    <!-- =================================
         HEADER
    ================================== -->

    <header class="topbar">

        <div class="topbar-content">


            <div class="brand">

                <div class="brand-icon">
                    🏥
                </div>


                <div class="brand-text">

                    <h1>
                        Puskesmas Seroja
                    </h1>

                    <p>
                        Sistem Informasi Gizi Anak
                    </p>

                </div>

            </div>


            <a
                href="{{ route('user.growth.index') }}"
                class="back-button"
            >
                ← Kembali
            </a>

        </div>

    </header>



    @php

        /*
         * Controller mungkin mengirim data
         * dengan nama $growthRecord atau $record.
         *
         * Kita terima keduanya supaya halaman
         * tidak error karena nama variabel.
         */

        $growthRecord =
            $growthRecord
            ?? $record
            ?? null;

    @endphp



    <main class="container">


        <!-- =================================
             CEK DATA
        ================================== -->

        @if (!$growthRecord)

            <div class="card">

                <div class="card-title">

                    <div class="card-title-icon">
                        ⚠️
                    </div>

                    <h3>
                        Data Tidak Ditemukan
                    </h3>

                </div>


                <p
                    style="
                        color: #6B7280;
                        font-size: 13px;
                        line-height: 1.7;
                    "
                >

                    Data pengukuran pertumbuhan tidak
                    ditemukan.

                </p>


                <div
                    style="
                        margin-top: 20px;
                    "
                >

                    <a
                        href="{{ route('user.growth.index') }}"
                        class="button edit-button"
                    >
                        ← Kembali ke Pertumbuhan
                    </a>

                </div>

            </div>


        @else


            @php

                /*
                 * Ambil data anak dari relasi.
                 */

                $child =
                    $growthRecord->child
                    ?? null;


                /*
                 * Ambil tanggal pengukuran.
                 */

                $recordDate =
                    $growthRecord->record_date
                    ?? $growthRecord->date
                    ?? null;


                /*
                 * Berat badan.
                 */

                $weight =
                    $growthRecord->weight
                    ?? 0;


                /*
                 * Tinggi badan.
                 */

                $height =
                    $growthRecord->height
                    ?? 0;

            @endphp



            <!-- =================================
                 PAGE HEADER
            ================================== -->

            <div class="page-header">

                <div class="page-icon">
                    📊
                </div>


                <div>

                    <h2>
                        Detail Pertumbuhan Anak
                    </h2>

                    <p>
                        Informasi lengkap hasil pengukuran
                        pertumbuhan anak.
                    </p>

                </div>

            </div>



            <!-- =================================
                 CONTENT
            ================================== -->

            <div class="content-grid">


                <!-- ===============================
                     INFORMASI ANAK
                ================================ -->

                <div class="card">

                    <div class="card-title">

                        <div class="card-title-icon">
                            👶
                        </div>

                        <h3>
                            Informasi Anak
                        </h3>

                    </div>


                    <div class="child-profile">

                        <div class="child-avatar">

                            @if ($child && $child->gender === 'L')

                                👦

                            @elseif ($child && $child->gender === 'P')

                                👧

                            @else

                                👶

                            @endif

                        </div>


                        <div>

                            <div class="child-name">

                                {{ $child->name ?? 'Data Anak' }}

                            </div>


                            <div class="child-gender">

                                @if ($child && $child->gender === 'L')

                                    Laki-laki

                                @elseif ($child && $child->gender === 'P')

                                    Perempuan

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </div>



                    <div class="data-list">


                        <!-- TANGGAL LAHIR -->

                        <div class="data-box">

                            <div class="data-label">
                                Tanggal Lahir
                            </div>


                            <div class="data-value">

                                @if (
                                    $child
                                    && $child->birth_date
                                )

                                    {{ \Carbon\Carbon::parse(
                                        $child->birth_date
                                    )->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>



                        <!-- JENIS KELAMIN -->

                        <div class="data-box">

                            <div class="data-label">
                                Jenis Kelamin
                            </div>


                            <div class="data-value">

                                @if (
                                    $child
                                    && $child->gender === 'L'
                                )

                                    Laki-laki

                                @elseif (
                                    $child
                                    && $child->gender === 'P'
                                )

                                    Perempuan

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </div>

                </div>



                <!-- ===============================
                     WAKTU
                ================================ -->

                <div class="card">

                    <div class="card-title">

                        <div class="card-title-icon">
                            📅
                        </div>

                        <h3>
                            Waktu Pengukuran
                        </h3>

                    </div>


                    <div class="info-row">

                        <span class="info-row-label">
                            Tanggal Pengukuran
                        </span>


                        <span class="info-row-value">

                            @if ($recordDate)

                                {{ \Carbon\Carbon::parse(
                                    $recordDate
                                )->format('d M Y') }}

                            @else

                                -

                            @endif

                        </span>

                    </div>



                    <!-- UMUR -->

                    @if (
                        $child
                        && $child->birth_date
                        && $recordDate
                    )

                        @php

                            $birthDate =
                                \Carbon\Carbon::parse(
                                    $child->birth_date
                                );

                            $measurementDate =
                                \Carbon\Carbon::parse(
                                    $recordDate
                                );

                            $totalMonths =
                                $birthDate->diffInMonths(
                                    $measurementDate
                                );

                            $ageYears =
                                intdiv(
                                    $totalMonths,
                                    12
                                );

                            $ageMonths =
                                $totalMonths % 12;

                        @endphp


                        <div class="info-row">

                            <span class="info-row-label">
                                Umur Saat Pengukuran
                            </span>


                            <span class="info-row-value">

                                @if (
                                    $ageYears > 0
                                    && $ageMonths > 0
                                )

                                    {{ $ageYears }}
                                    tahun
                                    {{ $ageMonths }}
                                    bulan

                                @elseif ($ageYears > 0)

                                    {{ $ageYears }}
                                    tahun

                                @elseif ($ageMonths > 0)

                                    {{ $ageMonths }}
                                    bulan

                                @else

                                    Kurang dari 1 bulan

                                @endif

                            </span>

                        </div>

                    @endif



                    <!-- ID -->

                    <div class="info-row">

                        <span class="info-row-label">
                            ID Pengukuran
                        </span>


                        <span class="info-row-value">
                            #{{ $growthRecord->id }}
                        </span>

                    </div>

                </div>



                <!-- ===============================
                     HASIL PENGUKURAN
                ================================ -->

                <div class="card">

                    <div class="card-title">

                        <div class="card-title-icon">
                            📏
                        </div>

                        <h3>
                            Hasil Pengukuran
                        </h3>

                    </div>


                    <div class="measurement-grid">


                        <!-- BERAT -->

                        <div class="measurement-card">

                            <div class="measurement-icon">
                                ⚖️
                            </div>


                            <div class="measurement-label">
                                Berat Badan
                            </div>


                            <div class="measurement-value">

                                {{ number_format(
                                    (float) $weight,
                                    2,
                                    ',',
                                    '.'
                                ) }}

                                <span class="measurement-unit">
                                    kg
                                </span>

                            </div>

                        </div>



                        <!-- TINGGI -->

                        <div class="measurement-card">

                            <div class="measurement-icon">
                                📏
                            </div>


                            <div class="measurement-label">
                                Tinggi Badan
                            </div>


                            <div class="measurement-value">

                                {{ number_format(
                                    (float) $height,
                                    2,
                                    ',',
                                    '.'
                                ) }}

                                <span class="measurement-unit">
                                    cm
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="status-box">

                        <div class="status-title">
                            Keterangan
                        </div>

                        <div class="status-text">
                            Data pengukuran pertumbuhan
                        </div>

                    </div>

                </div>



                <!-- ===============================
                     CATATAN
                ================================ -->

                <div class="card">

                    <div class="card-title">

                        <div class="card-title-icon">
                            📝
                        </div>

                        <h3>
                            Catatan
                        </h3>

                    </div>


                    <div class="note-box">

                        <div class="note-title">
                            Catatan Pengukuran
                        </div>


                        <div class="note-text">

                            @if (
                                isset($growthRecord->note)
                                && $growthRecord->note
                            )

                                {{ $growthRecord->note }}

                            @else

                                Tidak ada catatan
                                untuk pengukuran ini.

                            @endif

                        </div>

                    </div>



                    <div
                        class="info-row"
                        style="margin-top: 12px;"
                    >

                        <span class="info-row-label">
                            Data dibuat
                        </span>


                        <span class="info-row-value">

                            @if ($growthRecord->created_at)

                                {{ $growthRecord->created_at->format(
                                    'd M Y H:i'
                                ) }}

                            @else

                                -

                            @endif

                        </span>

                    </div>



                    <div class="info-row">

                        <span class="info-row-label">
                            Terakhir diperbarui
                        </span>


                        <span class="info-row-value">

                            @if ($growthRecord->updated_at)

                                {{ $growthRecord->updated_at->format(
                                    'd M Y H:i'
                                ) }}

                            @else

                                -

                            @endif

                        </span>

                    </div>

                </div>

            </div>



            <!-- =================================
                 BUTTON
            ================================== -->

            <div class="action-area">

                <a
                    href="{{ route('user.growth.index') }}"
                    class="button back-page-button"
                >
                    ← Kembali ke Pertumbuhan
                </a>


                <a
                    href="{{ route(
                        'user.growth.edit',
                        $growthRecord->id
                    ) }}"
                    class="button edit-button"
                >
                    ✏️ Edit Pengukuran
                </a>

            </div>


        @endif



        <!-- =================================
             FOOTER
        ================================== -->

        <footer>

            © {{ date('Y') }} Puskesmas Seroja
            • Sistem Informasi Gizi Anak

        </footer>


    </main>

</body>

</html>