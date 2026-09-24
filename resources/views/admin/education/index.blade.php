<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Edukasi Gizi - Gizi Cerdas
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f6fa;

            color: #282235;

        }


        /* =========================================================
           KONTEN UTAMA
        ========================================================= */

        .main-content {

            margin-left: 230px;

            min-height: 100vh;

        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {

            height: 70px;

            background: white;

            border-bottom:
                1px solid #e7e5eb;

            padding:
                0 25px;

            display: flex;

            justify-content:
                space-between;

            align-items: center;

        }


        .breadcrumb {

            font-size: 10px;

            color: #9a94a5;

            margin-bottom: 3px;

        }


        .page-title {

            font-size: 20px;

            font-weight: bold;

            color: #252131;

        }


        .logout-button {

            background: #ff3038;

            color: white;

            border: none;

            padding:
                10px 18px;

            border-radius: 10px;

            font-size: 12px;

            font-weight: bold;

            cursor: pointer;

        }


        .logout-button:hover {

            background: #dc2028;

        }


        /* =========================================================
           HALAMAN
        ========================================================= */

        .page {

            padding: 25px;

        }


        /* =========================================================
           HEADER
        ========================================================= */

        .page-header {

            background: white;

            padding: 26px;

            border-radius: 18px;

            margin-bottom: 20px;

            box-shadow:
                0 8px 22px
                rgba(40, 30, 70, 0.05);

        }


        .header-label {

            color: #9a43d0;

            font-size: 10px;

            font-weight: bold;

            letter-spacing: 0.7px;

            margin-bottom: 7px;

        }


        .page-header h1 {

            margin:
                0 0 9px;

            color: #40205d;

            font-size: 24px;

        }


        .page-header p {

            margin: 0;

            color: #817a8d;

            font-size: 13px;

            line-height: 1.8;

        }


        /* =========================================================
           INFORMASI
        ========================================================= */

        .info-box {

            background:
                #f5efff;

            border:
                1px solid #e8dbff;

            padding: 19px;

            border-radius: 15px;

            margin-bottom: 20px;

        }


        .info-box-title {

            color: #5b21b6;

            font-size: 13px;

            font-weight: bold;

            margin-bottom: 7px;

        }


        .info-box p {

            margin: 0;

            color: #776c89;

            font-size: 12px;

            line-height: 1.8;

        }


        /* =========================================================
           KARTU EDUKASI
        ========================================================= */

        .education-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;

        }


        .education-card {

            background: white;

            border:
                1px solid #ededf3;

            border-radius: 17px;

            padding: 22px;

            min-height: 220px;

            box-shadow:
                0 8px 22px
                rgba(40, 30, 70, 0.05);

            transition:
                transform 0.2s,
                box-shadow 0.2s;

        }


        .education-card:hover {

            transform:
                translateY(-4px);

            box-shadow:
                0 15px 30px
                rgba(40, 30, 70, 0.09);

        }


        .education-icon {

            width: 48px;

            height: 48px;

            border-radius: 13px;

            background:
                #f0e8ff;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 22px;

            margin-bottom: 15px;

        }


        .education-card h3 {

            margin:
                0 0 9px;

            font-size: 16px;

            color: #4c1d95;

        }


        .education-card p {

            margin: 0;

            color: #817a8d;

            font-size: 12px;

            line-height: 1.8;

        }


        .education-meta {

            margin-top: 15px;

            padding-top: 12px;

            border-top:
                1px solid #eeeeee;

            font-size: 10px;

            color: #aaa2b0;

        }


        /* =========================================================
           DATA DINAMIS
        ========================================================= */

        .database-section {

            margin-top: 22px;

            background: white;

            border-radius: 18px;

            padding: 22px;

            box-shadow:
                0 8px 22px
                rgba(40, 30, 70, 0.05);

        }


        .database-header {

            display: flex;

            justify-content:
                space-between;

            align-items: center;

            margin-bottom: 16px;

        }


        .database-header h2 {

            margin: 0;

            color: #403654;

            font-size: 16px;

        }


        .database-count {

            font-size: 11px;

            color: #8d8496;

        }


        .database-item {

            padding:
                15px 0;

            border-bottom:
                1px solid #eeeeee;

        }


        .database-item:last-child {

            border-bottom: none;

        }


        .database-item-title {

            font-size: 13px;

            font-weight: bold;

            color: #5b21b6;

            margin-bottom: 6px;

        }


        .database-item-content {

            font-size: 12px;

            color: #817a8d;

            line-height: 1.7;

        }


        .empty {

            padding: 18px;

            border-radius: 10px;

            background: #fff7df;

            color: #8f6a00;

            font-size: 12px;

        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {

            text-align: center;

            padding:
                30px 0 10px;

            color: #aaa3b1;

            font-size: 10px;

        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 950px) {

            .education-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }


        @media (max-width: 700px) {

            .main-content {

                margin-left: 220px;

            }


            .page {

                padding: 18px;

            }


            .education-grid {

                grid-template-columns:
                    1fr;

            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         SIDEBAR
    ========================================================= -->

    @include('admin.layouts.sidebar')



    <!-- =========================================================
         KONTEN UTAMA
    ========================================================= -->

    <div class="main-content">


        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <div class="breadcrumb">
                    Admin / Edukasi
                </div>

                <div class="page-title">
                    Edukasi Gizi
                </div>

            </div>


            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Logout
                </button>

            </form>

        </div>



        <!-- PAGE -->

        <main class="page">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="page-header">

                <div class="header-label">
                    PUSAT INFORMASI GIZI
                </div>

                <h1>
                    Edukasi Gizi Anak
                </h1>

                <p>

                    Halaman edukasi digunakan untuk menyediakan
                    informasi mengenai gizi, makanan bergizi,
                    pertumbuhan anak, dan hal-hal yang berkaitan
                    dengan kesehatan serta pemantauan gizi anak.

                </p>

            </div>



            <!-- =================================================
                 INFORMASI
            ================================================== -->

            <div class="info-box">

                <div class="info-box-title">
                    Mengapa Edukasi Gizi Penting?
                </div>

                <p>

                    Pengetahuan mengenai kebutuhan gizi dan
                    pertumbuhan anak membantu orang tua dalam
                    memberikan perhatian yang lebih baik terhadap
                    pola makan dan perkembangan anak.

                </p>

            </div>



            <!-- =================================================
                 EDUKASI INFORMASI
            ================================================== -->

            <div class="education-grid">


                <!-- =================================================
                     EDUKASI 1
                ================================================== -->

                <div class="education-card">

                    <div class="education-icon">
                        🥗
                    </div>

                    <h3>
                        Gizi Seimbang
                    </h3>

                    <p>

                        Gizi seimbang merupakan bagian penting
                        dalam mendukung pertumbuhan dan perkembangan
                        anak.

                        Perhatikan keberagaman makanan dan
                        kebutuhan anak sesuai tahap pertumbuhannya.

                    </p>

                    <div class="education-meta">
                        Informasi dasar gizi anak
                    </div>

                </div>



                <!-- =================================================
                     EDUKASI 2
                ================================================== -->

                <div class="education-card">

                    <div class="education-icon">
                        👶
                    </div>

                    <h3>
                        Pantau Pertumbuhan
                    </h3>

                    <p>

                        Lakukan pencatatan berat badan dan
                        tinggi atau panjang badan anak secara
                        berkala agar perkembangan anak dapat
                        dipantau dari waktu ke waktu.

                    </p>

                    <div class="education-meta">
                        Pemantauan pertumbuhan
                    </div>

                </div>



                <!-- =================================================
                     EDUKASI 3
                ================================================== -->

                <div class="education-card">

                    <div class="education-icon">
                        💚
                    </div>

                    <h3>
                        Peduli Kesehatan Anak
                    </h3>

                    <p>

                        Perhatian terhadap pola makan,
                        pertumbuhan, kebersihan, aktivitas,
                        dan kesehatan anak merupakan bagian
                        penting dari pengasuhan.

                    </p>

                    <div class="education-meta">
                        Kepedulian terhadap kesehatan
                    </div>

                </div>


            </div>



            <!-- =================================================
                 DATA EDUKASI DARI DATABASE
            ================================================== -->

            <div class="database-section">


                <div class="database-header">

                    <h2>
                        Materi Edukasi Tersimpan
                    </h2>

                    <div class="database-count">

                        Total:
                        {{ $educations->count() }}
                        data

                    </div>

                </div>



                @if ($educations->count() == 0)

                    <div class="empty">

                        Belum ada materi edukasi yang tersimpan
                        di database.

                    </div>

                @else


                    @foreach ($educations as $education)

                        <div class="database-item">


                            @php

                                $attributes =
                                    $education->getAttributes();

                                $title = null;

                                $content = [];

                                foreach ($attributes as $field => $value) {

                                    if (
                                        in_array(
                                            $field,
                                            [
                                                'id',
                                                'created_at',
                                                'updated_at'
                                            ]
                                        )
                                    ) {
                                        continue;
                                    }

                                    if (
                                        $value === null ||
                                        $value === ''
                                    ) {
                                        continue;
                                    }

                                    if ($title === null) {

                                        $title = $value;

                                    } else {

                                        $content[] = $value;

                                    }
                                }

                            @endphp


                            <div class="database-item-title">

                                {{ $title ?? 'Materi Edukasi' }}

                            </div>


                            @foreach ($content as $text)

                                <div class="database-item-content">

                                    {{ $text }}

                                </div>

                            @endforeach


                        </div>

                    @endforeach


                @endif


            </div>



            <!-- =================================================
                 FOOTER
            ================================================== -->

            <div class="footer">

                © {{ date('Y') }}
                Gizi Cerdas -
                Sistem Informasi Pemantauan Gizi Anak

            </div>


        </main>

    </div>


</body>

</html>