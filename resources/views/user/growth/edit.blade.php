<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Edit Pengukuran - Puskesmas Seroja
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

        input,
        select,
        textarea,
        button {
            font-family: inherit;
        }

        /* =========================
           HEADER
        ========================= */

        .topbar {
            background: linear-gradient(
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
            max-width: 1000px;
            margin: auto;
            padding: 0 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;

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
                rgba(255, 255, 255, 0.17);

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
                1px solid rgba(255, 255, 255, 0.30);

            border-radius: 10px;

            background:
                rgba(255, 255, 255, 0.10);

            color: white;

            font-size: 13px;
            font-weight: 600;

            transition: 0.2s ease;
        }

        .back-button:hover {
            background: white;
            color: #6D28D9;
        }


        /* =========================
           CONTAINER
        ========================= */

        .container {
            max-width: 1000px;

            margin: auto;

            padding:
                30px 22px 50px;
        }


        /* =========================
           HEADER HALAMAN
        ========================= */

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
                0 8px 25px rgba(52, 21, 111, 0.05);
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
            color: #34156F;

            font-size: 25px;

            margin-bottom: 6px;
        }

        .page-header p {
            color: #6B7280;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =========================
           ERROR
        ========================= */

        .error-box {
            margin-top: 20px;

            background: #FFF1F2;

            border:
                1px solid #FECDD3;

            color: #BE123C;

            padding: 15px 17px;

            border-radius: 13px;

            font-size: 13px;
        }

        .error-box strong {
            display: block;

            margin-bottom: 8px;
        }

        .error-box ul {
            margin-left: 18px;
        }

        .error-box li {
            margin-bottom: 4px;
        }


        /* =========================
           FORM CARD
        ========================= */

        .form-card {
            margin-top: 20px;

            background: white;

            border:
                1px solid #EEE7FF;

            border-radius: 22px;

            padding: 28px;

            box-shadow:
                0 8px 25px rgba(52, 21, 111, 0.05);
        }

        .form-title {
            margin-bottom: 22px;
        }

        .form-title h3 {
            color: #34156F;

            font-size: 18px;

            margin-bottom: 5px;
        }

        .form-title p {
            color: #6B7280;

            font-size: 12px;
        }


        /* =========================
           INFO ANAK
        ========================= */

        .child-card {
            margin-bottom: 23px;

            padding: 17px;

            background: #F3E8FF;

            border:
                1px solid #E5D7FF;

            border-radius: 16px;

            display: flex;
            align-items: center;

            gap: 13px;
        }

        .child-avatar {
            width: 48px;
            height: 48px;

            min-width: 48px;

            border-radius: 14px;

            background: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 23px;
        }

        .child-name {
            color: #34156F;

            font-size: 15px;

            font-weight: 700;

            margin-bottom: 4px;
        }

        .child-gender {
            color: #6B7280;

            font-size: 12px;
        }


        /* =========================
           FORM GRID
        ========================= */

        .form-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;

            color: #34156F;

            font-size: 13px;

            font-weight: 700;
        }

        .required {
            color: #BE123C;
        }


        /* =========================
           INPUT
        ========================= */

        .form-control {
            width: 100%;

            min-height: 46px;

            padding: 0 14px;

            border:
                1px solid #DDD6FE;

            border-radius: 11px;

            background: #FCFBFF;

            color: #34156F;

            font-size: 13px;

            outline: none;

            transition: 0.2s ease;
        }

        textarea.form-control {
            min-height: 105px;

            padding-top: 13px;

            resize: vertical;
        }

        .form-control:focus {
            background: white;

            border-color: #8B5CF6;

            box-shadow:
                0 0 0 3px
                rgba(139, 92, 246, 0.10);
        }

        .form-help {
            margin-top: 6px;

            color: #8A8494;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =========================
           INPUT UNIT
        ========================= */

        .input-unit {
            position: relative;
        }

        .input-unit .form-control {
            padding-right: 50px;
        }

        .unit {
            position: absolute;

            right: 14px;

            top: 50%;

            transform:
                translateY(-50%);

            color: #8A8494;

            font-size: 12px;

            font-weight: 700;
        }


        /* =========================
           TOMBOL
        ========================= */

        .form-actions {
            margin-top: 28px;

            padding-top: 22px;

            border-top:
                1px solid #F0EBFF;

            display: flex;

            justify-content: flex-end;

            gap: 10px;
        }

        .button {
            min-width: 135px;

            height: 44px;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s ease;
        }

        .cancel-button {
            background: white;

            border:
                1px solid #DDD6FE;

            color: #6B7280;
        }

        .cancel-button:hover {
            background: #FAF9FF;

            color: #6D28D9;
        }

        .save-button {
            border: none;

            background: #6D28D9;

            color: white;

            box-shadow:
                0 6px 15px
                rgba(109, 40, 217, 0.20);
        }

        .save-button:hover {
            background: #5B21B6;

            transform:
                translateY(-1px);
        }


        /* =========================
           INFO
        ========================= */

        .info-card {
            margin-top: 18px;

            display: flex;
            align-items: flex-start;

            gap: 13px;

            background: #F3E8FF;

            border:
                1px solid #E5D7FF;

            border-radius: 16px;

            padding: 17px;
        }

        .info-icon {
            width: 38px;
            height: 38px;

            min-width: 38px;

            border-radius: 11px;

            background: #6D28D9;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
        }

        .info-card h4 {
            color: #34156F;

            font-size: 14px;

            margin-bottom: 5px;
        }

        .info-card p {
            color: #6B7280;

            font-size: 12px;

            line-height: 1.7;
        }


        /* =========================
           FOOTER
        ========================= */

        footer {
            margin-top: 35px;

            text-align: center;

            color: #8A8494;

            font-size: 12px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 650px) {

            .topbar-content {
                flex-direction: column;

                align-items: flex-start;
            }

            .container {
                padding-top: 20px;
            }

            .page-header {
                align-items: flex-start;
            }

            .form-card {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .button {
                width: 100%;
            }

        }

    </style>

</head>


<body>


    <!-- ======================================
         HEADER
    ======================================= -->

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
         * Tetap mendukung $growthRecord yang dikirim
         * oleh GrowthController.
         *
         * Tidak mengubah alur data.
         */

        $record =
            $growthRecord
            ?? $record
            ?? null;

    @endphp



    <main class="container">


        @if (!$record)

            <!-- ==================================
                 DATA TIDAK ADA
            =================================== -->

            <div class="page-header">

                <div class="page-icon">
                    ⚠️
                </div>

                <div>

                    <h2>
                        Data Pengukuran Tidak Ditemukan
                    </h2>

                    <p>
                        Data pengukuran yang ingin diedit
                        tidak tersedia.
                    </p>

                </div>

            </div>


            <div class="form-card">

                <a
                    href="{{ route('user.growth.index') }}"
                    class="button save-button"
                >
                    ← Kembali ke Pertumbuhan
                </a>

            </div>


        @else


            @php

                /*
                 * Ambil data anak dari relasi.
                 */

                $child =
                    $record->child
                    ?? null;


                /*
                 * Ambil tanggal pengukuran.
                 */

                $recordDate =
                    $record->record_date
                    ?? $record->date
                    ?? '';


                /*
                 * Nilai berat badan.
                 */

                $weight =
                    $record->weight
                    ?? '';


                /*
                 * Nilai tinggi badan.
                 */

                $height =
                    $record->height
                    ?? '';


                /*
                 * Catatan.
                 */

                $note =
                    $record->note
                    ?? '';

            @endphp



            <!-- ==================================
                 JUDUL HALAMAN
            =================================== -->

            <div class="page-header">

                <div class="page-icon">
                    ✏️
                </div>

                <div>

                    <h2>
                        Edit Pengukuran
                    </h2>

                    <p>
                        Perbarui hasil pengukuran pertumbuhan
                        anak yang sudah tersimpan.
                    </p>

                </div>

            </div>



            <!-- ==================================
                 ERROR
            =================================== -->

            @if ($errors->any())

                <div class="error-box">

                    <strong>
                        ⚠️ Data belum dapat diperbarui.
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <!-- ==================================
                 FORM
            =================================== -->

            <form
                action="{{ route(
                    'user.growth.update',
                    $record->id
                ) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="form-card">


                    <div class="form-title">

                        <h3>
                            Data Pengukuran
                        </h3>

                        <p>
                            Pastikan data yang diperbarui
                            sesuai dengan hasil pengukuran.
                        </p>

                    </div>



                    <!-- ==================================
                         INFO ANAK
                    =================================== -->

                    <div class="child-card">


                        <div class="child-avatar">

                            @if (
                                $child &&
                                $child->gender === 'L'
                            )

                                👦

                            @elseif (
                                $child &&
                                $child->gender === 'P'
                            )

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

                                @if (
                                    $child &&
                                    $child->gender === 'L'
                                )

                                    Laki-laki

                                @elseif (
                                    $child &&
                                    $child->gender === 'P'
                                )

                                    Perempuan

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </div>



                    <!-- ==================================
                         FORM GRID
                    =================================== -->

                    <div class="form-grid">


                        <!-- ANAK -->

                        <div class="form-group full-width">

                            <label for="child_id">

                                Anak

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <select
                                name="child_id"
                                id="child_id"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    -- Pilih Anak --
                                </option>


                                @if (
                                    isset($children) &&
                                    $children->count() > 0
                                )

                                    @foreach (
                                        $children as $item
                                    )

                                        <option
                                            value="{{ $item->id }}"
                                            {{ old('child_id', $record->child_id) == $item->id ? 'selected' : '' }}
                                        >

                                            {{ $item->name }}

                                        </option>

                                    @endforeach

                                @elseif ($child)

                                    <option
                                        value="{{ $child->id }}"
                                        selected
                                    >

                                        {{ $child->name }}

                                    </option>

                                @endif

                            </select>


                            <div class="form-help">

                                Pilih anak yang sesuai
                                dengan pengukuran.

                            </div>

                        </div>



                        <!-- TANGGAL -->

                        <div class="form-group">

                            <label for="record_date">

                                Tanggal Pengukuran

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="date"
                                name="record_date"
                                id="record_date"
                                class="form-control"
                                value="{{ old('record_date', $recordDate) }}"
                                max="{{ date('Y-m-d') }}"
                                required
                            >


                            <div class="form-help">

                                Tanggal saat pengukuran
                                dilakukan.

                            </div>

                        </div>



                        <!-- BERAT -->

                        <div class="form-group">

                            <label for="weight">

                                Berat Badan

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <div class="input-unit">

                                <input
                                    type="number"
                                    name="weight"
                                    id="weight"
                                    class="form-control"
                                    value="{{ old('weight', $weight) }}"
                                    placeholder="Contoh: 18.50"
                                    min="0"
                                    max="300"
                                    step="0.01"
                                    required
                                >


                                <span class="unit">
                                    kg
                                </span>

                            </div>


                            <div class="form-help">

                                Berat badan dalam kilogram.

                            </div>

                        </div>



                        <!-- TINGGI -->

                        <div class="form-group">

                            <label for="height">

                                Tinggi Badan

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <div class="input-unit">

                                <input
                                    type="number"
                                    name="height"
                                    id="height"
                                    class="form-control"
                                    value="{{ old('height', $height) }}"
                                    placeholder="Contoh: 108.00"
                                    min="0"
                                    max="250"
                                    step="0.01"
                                    required
                                >


                                <span class="unit">
                                    cm
                                </span>

                            </div>


                            <div class="form-help">

                                Tinggi badan dalam sentimeter.

                            </div>

                        </div>



                        <!-- CATATAN -->

                        <div class="form-group">

                            <label for="note">
                                Catatan
                            </label>


                            <textarea
                                name="note"
                                id="note"
                                class="form-control"
                                placeholder="Contoh: Pengukuran dilakukan di Puskesmas."
                            >{{ old('note', $note) }}</textarea>


                            <div class="form-help">

                                Catatan bersifat opsional.

                            </div>

                        </div>

                    </div>



                    <!-- ==================================
                         BUTTON
                    =================================== -->

                    <div class="form-actions">


                        <a
                            href="{{ route('user.growth.index') }}"
                            class="button cancel-button"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="button save-button"
                        >
                            ✓ Simpan Perubahan
                        </button>


                    </div>

                </div>

            </form>



            <!-- ==================================
                 INFO
            =================================== -->

            <div class="info-card">


                <div class="info-icon">
                    💡
                </div>


                <div>

                    <h4>
                        Perhatikan Data Terbaru
                    </h4>


                    <p>

                        Pastikan berat dan tinggi badan
                        yang diperbarui sesuai dengan hasil
                        pengukuran terbaru agar riwayat
                        pertumbuhan tetap akurat.

                    </p>

                </div>

            </div>

        @endif


        <!-- ==================================
             FOOTER
        =================================== -->

        <footer>

            © {{ date('Y') }} Puskesmas Seroja
            • Sistem Informasi Gizi Anak

        </footer>


    </main>


</body>

</html>