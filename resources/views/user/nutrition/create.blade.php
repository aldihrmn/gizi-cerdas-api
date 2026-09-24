<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Hitung Nutrisi - Puskesmas Seroja
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
        button {
            font-family: inherit;
        }


        /* =================================
           HEADER
        ================================= */

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
                0 8px 25px
                rgba(109, 40, 217, 0.18);
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


        /* =================================
           CONTAINER
        ================================= */

        .container {
            max-width: 1000px;

            margin: auto;

            padding: 30px 22px 50px;
        }


        /* =================================
           PAGE HEADER
        ================================= */

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

            font-size: 29px;
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


        /* =================================
           ERROR
        ================================= */

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


        /* =================================
           FORM CARD
        ================================= */

        .form-card {
            margin-top: 20px;

            background: white;

            border:
                1px solid #EEE7FF;

            border-radius: 22px;

            padding: 28px;

            box-shadow:
                0 8px 25px
                rgba(52,21,111,0.05);
        }


        .section-heading {
            margin-bottom: 22px;
        }


        .section-heading h3 {
            color: #34156F;

            font-size: 18px;

            margin-bottom: 5px;
        }


        .section-heading p {
            color: #6B7280;

            font-size: 12px;

            line-height: 1.6;
        }


        /* =================================
           INFO ANAK
        ================================= */

        .selected-child {
            margin-bottom: 24px;

            padding: 17px;

            border-radius: 17px;

            background:
                linear-gradient(
                    135deg,
                    #F3E8FF,
                    #FAF9FF
                );

            border:
                1px solid #E5D7FF;

            display: flex;

            align-items: center;

            gap: 14px;
        }


        .selected-child-icon {
            width: 49px;
            height: 49px;

            min-width: 49px;

            border-radius: 14px;

            background: white;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 24px;
        }


        .selected-child-content h4 {
            color: #34156F;

            font-size: 15px;

            margin-bottom: 4px;
        }


        .selected-child-content p {
            color: #6B7280;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =================================
           FORM
        ================================= */

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


        .form-control {
            width: 100%;

            height: 46px;

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


        .form-control:focus {
            background: white;

            border-color: #8B5CF6;

            box-shadow:
                0 0 0 3px
                rgba(139,92,246,0.10);
        }


        .form-help {
            margin-top: 6px;

            color: #8A8494;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =================================
           DATE
        ================================= */

        .date-control {
            position: relative;
        }


        /* =================================
           BUTTON
        ================================= */

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
            min-width: 140px;

            height: 45px;

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


        .calculate-button {
            border: none;

            background: #6D28D9;

            color: white;

            box-shadow:
                0 6px 15px
                rgba(109,40,217,0.20);
        }


        .calculate-button:hover {
            background: #5B21B6;

            transform:
                translateY(-1px);
        }


        /* =================================
           GUIDE
        ================================= */

        .guide-card {
            margin-top: 20px;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 12px;
        }


        .guide-item {
            background: white;

            border:
                1px solid #EEE7FF;

            border-radius: 16px;

            padding: 17px;

            box-shadow:
                0 6px 18px
                rgba(52,21,111,0.04);
        }


        .guide-icon {
            width: 40px;
            height: 40px;

            border-radius: 12px;

            background: #F3E8FF;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 19px;

            margin-bottom: 10px;
        }


        .guide-item h4 {
            color: #34156F;

            font-size: 13px;

            margin-bottom: 5px;
        }


        .guide-item p {
            color: #6B7280;

            font-size: 11px;

            line-height: 1.6;
        }


        /* =================================
           INFORMATION
        ================================= */

        .info-card {
            margin-top: 20px;

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
            width: 39px;
            height: 39px;

            min-width: 39px;

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


        /* =================================
           FOOTER
        ================================= */

        footer {
            margin-top: 38px;

            text-align: center;

            color: #8A8494;

            font-size: 12px;
        }


        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 700px) {

            .topbar-content {
                flex-direction: column;

                align-items: flex-start;
            }


            .form-grid {
                grid-template-columns: 1fr;
            }


            .full-width {
                grid-column: auto;
            }


            .guide-card {
                grid-template-columns: 1fr;
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


    <!-- =================================
         HEADER
    ================================= -->

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
                href="{{ route('user.dashboard') }}"
                class="back-button"
            >
                ← Dashboard
            </a>

        </div>

    </header>



    <main class="container">


        <!-- =================================
             JUDUL
        ================================= -->

        <div class="page-header">

            <div class="page-icon">
                🥗
            </div>


            <div>

                <h2>
                    Hitung Kebutuhan Nutrisi
                </h2>


                <p>
                    Masukkan data anak untuk menghitung
                    kebutuhan energi dan zat gizi secara otomatis.
                </p>

            </div>

        </div>



        <!-- =================================
             ERROR
        ================================= -->

        @if ($errors->any())

            <div class="error-box">

                <strong>
                    ⚠️ Data belum dapat diproses.
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



        <!-- =================================
             FORM
        ================================= -->

        <form
            action="{{ route('user.nutrition.store') }}"
            method="POST"
        >

            @csrf


            <div class="form-card">


                <div class="section-heading">

                    <h3>
                        Data Perhitungan
                    </h3>


                    <p>
                        Pilih anak dan tentukan tanggal
                        perhitungan yang akan digunakan.
                    </p>

                </div>



                <!-- =================================
                     PILIH ANAK
                ================================= -->

                <div class="form-grid">

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


                            @foreach ($children as $child)

                                <option
                                    value="{{ $child->id }}"
                                    {{
                                        old(
                                            'child_id',
                                            request('child_id')
                                        ) == $child->id
                                            ? 'selected'
                                            : ''
                                    }}
                                >

                                    {{ $child->name }}

                                </option>

                            @endforeach

                        </select>


                        <div class="form-help">

                            Pilih anak yang akan dihitung kebutuhan
                            nutrisinya.

                        </div>

                    </div>



                    <!-- =================================
                         TANGGAL
                    ================================= -->

                    <div class="form-group">

                        <label for="calculation_date">

                            Tanggal Perhitungan

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="date"
                            name="calculation_date"
                            id="calculation_date"
                            class="form-control"
                            value="{{
                                old(
                                    'calculation_date',
                                    date('Y-m-d')
                                )
                            }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >


                        <div class="form-help">

                            Tanggal yang digunakan untuk menentukan
                            usia anak.

                        </div>

                    </div>



                    <!-- =================================
                         INFORMASI
                    ================================= -->

                    <div class="form-group">

                        <label>
                            Data yang Digunakan
                        </label>


                        <div
                            style="
                                min-height: 46px;
                                padding: 12px 14px;
                                border: 1px solid #E5D7FF;
                                border-radius: 11px;
                                background: #F3E8FF;
                                color: #6D28D9;
                                font-size: 12px;
                                line-height: 1.5;
                            "
                        >

                            Berat dan tinggi badan
                            tersimpan pada data anak.

                        </div>


                        <div class="form-help">

                            Pastikan data anak sudah diperbarui
                            sebelum melakukan perhitungan.

                        </div>

                    </div>

                </div>



                <!-- =================================
                     BUTTON
                ================================= -->

                <div class="form-actions">

                    <a
                        href="{{ route('user.dashboard') }}"
                        class="button cancel-button"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="button calculate-button"
                    >
                        🧮 Hitung Nutrisi
                    </button>

                </div>

            </div>

        </form>



        <!-- =================================
             PANDUAN
        ================================= -->

        <div class="guide-card">


            <div class="guide-item">

                <div class="guide-icon">
                    👶
                </div>


                <h4>
                    1. Pilih Anak
                </h4>


                <p>
                    Pilih data anak yang akan digunakan
                    dalam perhitungan.
                </p>

            </div>



            <div class="guide-item">

                <div class="guide-icon">
                    📅
                </div>


                <h4>
                    2. Tentukan Tanggal
                </h4>


                <p>
                    Sistem menggunakan tanggal perhitungan
                    untuk menentukan usia anak.
                </p>

            </div>



            <div class="guide-item">

                <div class="guide-icon">
                    📊
                </div>


                <h4>
                    3. Lihat Hasil
                </h4>


                <p>
                    Sistem akan menampilkan hasil kebutuhan
                    nutrisi berdasarkan data yang tersedia.
                </p>

            </div>

        </div>



        <!-- =================================
             INFORMASI
        ================================= -->

        <div class="info-card">

            <div class="info-icon">
                💡
            </div>


            <div>

                <h4>
                    Perhatikan Data Anak
                </h4>


                <p>
                    Pastikan berat badan, tinggi badan,
                    tanggal lahir dan jenis kelamin anak
                    sudah benar sebelum melakukan perhitungan.
                    Hasil pada website ini digunakan sebagai
                    media informasi dan pemantauan.
                </p>

            </div>

        </div>



        <!-- =================================
             FOOTER
        ================================= -->

        <footer>

            © {{ date('Y') }} Puskesmas Seroja
            • Sistem Informasi Gizi Anak

        </footer>


    </main>


</body>

</html>