<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard Admin - Gizi Cerdas
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

            color: #27213a;

        }


        /* =========================================================
           CONTENT UTAMA
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
                1px solid #e6e6ed;

            padding:
                0 25px;

            display: flex;

            justify-content: space-between;

            align-items: center;

        }


        .topbar-left {

            display: flex;

            flex-direction: column;

            gap: 3px;

        }


        .breadcrumb {

            font-size: 10px;

            color: #9a94a5;

        }


        .page-title {

            font-size: 20px;

            font-weight: bold;

            color: #242033;

        }


        .logout-button {

            border: none;

            background: #ff3038;

            color: white;

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
           PAGE
        ========================================================= */

        .page {

            padding: 25px;

        }


        /* =========================================================
           HERO
        ========================================================= */

        .hero {

            position: relative;

            overflow: hidden;

            min-height: 160px;

            padding:
                28px;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    #67149b,
                    #8b1fc4,
                    #c500d9
                );

            color: white;

            box-shadow:
                0 15px 35px
                rgba(110, 25, 150, 0.18);

        }


        .hero-decoration-one {

            position: absolute;

            width: 170px;
            height: 170px;

            border-radius: 50%;

            background:
                rgba(255,255,255,0.08);

            right: 100px;

            top: -75px;

        }


        .hero-decoration-two {

            position: absolute;

            width: 100px;
            height: 100px;

            border-radius: 50%;

            background:
                rgba(255,255,255,0.07);

            right: 35px;

            bottom: -45px;

        }


        .hero-content {

            position: relative;

            z-index: 2;

            max-width: 750px;

        }


        .hero-label {

            font-size: 10px;

            font-weight: bold;

            letter-spacing: 0.5px;

            color:
                rgba(255,255,255,0.80);

            margin-bottom: 9px;

        }


        .hero h1 {

            margin: 0 0 8px;

            font-size: 25px;

        }


        .hero p {

            margin: 0;

            font-size: 12px;

            line-height: 1.7;

            color:
                rgba(255,255,255,0.84);

        }


        /* =========================================================
           SECTION TITLE
        ========================================================= */

        .section-title {

            margin-top: 27px;

            margin-bottom: 15px;

        }


        .section-title small {

            display: block;

            color: #a04cda;

            font-size: 10px;

            font-weight: bold;

            letter-spacing: 0.7px;

            margin-bottom: 4px;

        }


        .section-title h2 {

            margin: 0;

            font-size: 17px;

            color: #242033;

        }


        /* =========================================================
           STATISTICS
        ========================================================= */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 16px;

        }


        .stat-card {

            background: white;

            min-height: 135px;

            padding: 20px;

            border-radius: 15px;

            border:
                1px solid #ededf2;

            box-shadow:
                0 7px 20px
                rgba(40,35,60,0.05);

            display: flex;

            flex-direction: column;

            justify-content: space-between;

        }


        .stat-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

        }


        .stat-title {

            font-size: 11px;

            color: #817a8d;

        }


        .stat-icon {

            width: 38px;

            height: 38px;

            border-radius: 11px;

            background: #f0e8ff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

        }


        .stat-number {

            margin-top: 11px;

            font-size: 27px;

            font-weight: bold;

            color: #211c2e;

        }


        .stat-description {

            font-size: 10px;

            color: #07a74b;

        }


        /* =========================================================
           MENU CEPAT
        ========================================================= */

        .quick-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 16px;

        }


        .quick-card {

            background: white;

            min-height: 170px;

            padding: 20px;

            border-radius: 15px;

            border:
                1px solid #ededf2;

            box-shadow:
                0 7px 20px
                rgba(40,35,60,0.05);

            transition:
                transform 0.2s,
                box-shadow 0.2s;

        }


        .quick-card:hover {

            transform:
                translateY(-4px);

            box-shadow:
                0 13px 28px
                rgba(40,35,60,0.09);

        }


        .quick-icon {

            font-size: 23px;

            margin-bottom: 11px;

        }


        .quick-card h3 {

            margin: 0 0 7px;

            font-size: 14px;

            color: #241f31;

        }


        .quick-card p {

            margin: 0 0 12px;

            color: #888193;

            font-size: 11px;

            line-height: 1.6;

        }


        .quick-link {

            display: inline-block;

            color: #8d1ec5;

            font-size: 11px;

            font-weight: bold;

        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {

            padding:

                25px 0 10px;

            text-align: center;

            color: #aaa4b2;

            font-size: 10px;

        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1050px) {

            .stats-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

            .quick-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }


        @media (max-width: 700px) {

            .main-content {

                margin-left: 220px;

            }

            .topbar {

                padding: 0 18px;

            }

            .page {

                padding: 18px;

            }

            .hero {

                padding: 22px;

            }

            .hero h1 {

                font-size: 21px;

            }

            .stats-grid {

                grid-template-columns: 1fr;

            }

            .quick-grid {

                grid-template-columns: 1fr;

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

            <div class="topbar-left">

                <div class="breadcrumb">
                    Dashboard Administrator
                </div>

                <div class="page-title">
                    Selamat datang, {{ Auth::user()->name }} 👋
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


            <!-- HERO -->

            <section class="hero">

                <div class="hero-decoration-one"></div>

                <div class="hero-decoration-two"></div>


                <div class="hero-content">

                    <div class="hero-label">
                        GIZI CERDAS ADMIN
                    </div>

                    <h1>
                        Kelola Sistem Gizi Anak
                    </h1>

                    <p>

                        Pantau dan kelola data pengguna,
                        data anak, pertumbuhan, status gizi,
                        standar pertumbuhan, dan edukasi
                        melalui satu dashboard.

                    </p>

                </div>

            </section>



            <!-- STATISTIK -->

            <div class="section-title">

                <small>
                    RINGKASAN SISTEM
                </small>

                <h2>
                    Statistik Data
                </h2>

            </div>


            <div class="stats-grid">


                <!-- USER -->

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            Total User
                        </div>

                        <div class="stat-icon">
                            👥
                        </div>

                    </div>

                    <div class="stat-number">
                        {{ $totalUsers }}
                    </div>

                    <div class="stat-description">
                        Data pengguna sistem
                    </div>

                </div>


                <!-- ANAK -->

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            Total Anak
                        </div>

                        <div class="stat-icon">
                            👶
                        </div>

                    </div>

                    <div class="stat-number">
                        {{ $totalChildren }}
                    </div>

                    <div class="stat-description">
                        Data anak terdaftar
                    </div>

                </div>


                <!-- PERTUMBUHAN -->

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            Data Pertumbuhan
                        </div>

                        <div class="stat-icon">
                            📈
                        </div>

                    </div>

                    <div class="stat-number">
                        {{ $totalGrowth }}
                    </div>

                    <div class="stat-description">
                        Riwayat pertumbuhan
                    </div>

                </div>


                <!-- NUTRISI -->

                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            Perhitungan Gizi
                        </div>

                        <div class="stat-icon">
                            🥗
                        </div>

                    </div>

                    <div class="stat-number">
                        {{ $totalNutrition }}
                    </div>

                    <div class="stat-description">
                        Perhitungan pengguna
                    </div>

                </div>


            </div>



            <!-- MENU CEPAT -->

            <div class="section-title">

                <small>
                    AKSES CEPAT
                </small>

                <h2>
                    Menu Cepat
                </h2>

            </div>


            <div class="quick-grid">


                <!-- USER -->

                <div class="quick-card">

                    <div class="quick-icon">
                        👥
                    </div>

                    <h3>
                        Manajemen User
                    </h3>

                    <p>
                        Kelola akun pengguna
                        aplikasi Gizi Cerdas.
                    </p>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="quick-link"
                    >
                        Kelola →
                    </a>

                </div>



                <!-- STANDAR -->

                <div class="quick-card">

                    <div class="quick-icon">
                        📊
                    </div>

                    <h3>
                        Standar Pertumbuhan
                    </h3>

                    <p>
                        Lihat data standar
                        pertumbuhan anak.
                    </p>

                    <a
                        href="{{ route('admin.growth-standards.index') }}"
                        class="quick-link"
                    >
                        Lihat Data →
                    </a>

                </div>



                <!-- EDUKASI -->

                <div class="quick-card">

                    <div class="quick-icon">
                        📚
                    </div>

                    <h3>
                        Edukasi Gizi
                    </h3>

                    <p>
                        Kelola informasi
                        dan materi edukasi gizi.
                    </p>

                    <a
                        href="{{ route('admin.education.index') }}"
                        class="quick-link"
                    >
                        Kelola →
                    </a>

                </div>



                <!-- DATA ANAK -->

                <div class="quick-card">

                    <div class="quick-icon">
                        👶
                    </div>

                    <h3>
                        Data Anak
                    </h3>

                    <p>
                        Kelola seluruh data
                        anak yang terdaftar.
                    </p>

                    <a
                        href="{{ route('admin.children.index') }}"
                        class="quick-link"
                    >
                        Kelola →
                    </a>

                </div>



                <!-- PERTUMBUHAN -->

                <div class="quick-card">

                    <div class="quick-icon">
                        📈
                    </div>

                    <h3>
                        Pertumbuhan
                    </h3>

                    <p>
                        Pantau dan kelola data
                        pertumbuhan anak.
                    </p>

                    <a
                        href="{{ route('admin.growth.index') }}"
                        class="quick-link"
                    >
                        Kelola →
                    </a>

                </div>



                <!-- NUTRISI -->

                <div class="quick-card">

                    <div class="quick-icon">
                        🥗
                    </div>

                    <h3>
                        Data Nutrisi
                    </h3>

                    <p>
                        Lihat dan kelola hasil
                        perhitungan status gizi.
                    </p>

                    <a
                        href="{{ route('admin.nutrition.index') }}"
                        class="quick-link"
                    >
                        Kelola →
                    </a>

                </div>


            </div>



            <!-- FOOTER -->

            <div class="footer">

                © {{ date('Y') }}
                Gizi Cerdas -
                Sistem Informasi Pemantauan Gizi Anak

            </div>


        </main>

    </div>


</body>

</html>