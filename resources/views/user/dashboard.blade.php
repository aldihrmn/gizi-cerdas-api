<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Puskesmas Seroja</title>

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

        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 30px 22px 50px;
        }

        /* HEADER */
        .topbar {
            background: linear-gradient(135deg, #6D28D9, #8B5CF6);
            color: white;
            padding: 22px 0;
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
            gap: 14px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.18);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;
        }

        .brand-text h1 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .brand-text p {
            font-size: 13px;
            opacity: 0.85;
        }

        .logout-form {
            display: inline;
        }

        .logout-button {
            border: 1px solid rgba(255,255,255,0.35);
            background: rgba(255,255,255,0.12);
            color: white;

            padding: 10px 16px;
            border-radius: 10px;

            cursor: pointer;
            font-size: 14px;
            font-weight: 600;

            transition: 0.2s ease;
        }

        .logout-button:hover {
            background: white;
            color: #6D28D9;
        }

        /* WELCOME */
        .welcome-card {
            margin-top: 28px;
            background: white;
            border-radius: 22px;
            padding: 28px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;

            box-shadow: 0 8px 25px rgba(52, 21, 111, 0.06);
            border: 1px solid #EEE7FF;
        }

        .welcome-text .small-title {
            color: #8B5CF6;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-text h2 {
            font-size: 29px;
            line-height: 1.25;
            color: #34156F;
            margin-bottom: 10px;
        }

        .welcome-text p {
            color: #6B7280;
            line-height: 1.6;
            font-size: 14px;
            max-width: 650px;
        }

        .welcome-icon {
            width: 90px;
            height: 90px;
            min-width: 90px;

            border-radius: 25px;
            background: #F3E8FF;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 42px;
        }

        /* SECTION TITLE */
        .section-header {
            margin-top: 34px;
            margin-bottom: 18px;
        }

        .section-header h3 {
            font-size: 21px;
            color: #34156F;
            margin-bottom: 5px;
        }

        .section-header p {
            color: #6B7280;
            font-size: 14px;
        }

        /* SERVICE GRID */
        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .service-card {
            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 20px;
            padding: 22px;

            min-height: 220px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            box-shadow: 0 7px 20px rgba(52, 21, 111, 0.05);

            transition: transform 0.2s ease,
                        box-shadow 0.2s ease,
                        border-color 0.2s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 28px rgba(52, 21, 111, 0.10);
            border-color: #D8C4FF;
        }

        .service-icon {
            width: 54px;
            height: 54px;

            border-radius: 15px;
            background: #F3E8FF;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 25px;
        }

        .service-content {
            margin-top: 18px;
        }

        .service-content h4 {
            font-size: 18px;
            color: #34156F;
            margin-bottom: 8px;
        }

        .service-content p {
            color: #6B7280;
            font-size: 13px;
            line-height: 1.6;
        }

        .service-footer {
            margin-top: 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .service-label {
            color: #6D28D9;
            font-size: 13px;
            font-weight: 700;
        }

        .arrow {
            width: 30px;
            height: 30px;
            border-radius: 50%;

            background: #F3E8FF;
            color: #6D28D9;

            display: flex;
            justify-content: center;
            align-items: center;

            font-weight: bold;
        }

        /* INFO */
        .info-section {
            margin-top: 34px;
        }

        .info-card {
            background: linear-gradient(
                135deg,
                #F3E8FF,
                #FFFFFF
            );

            border: 1px solid #E9D8FF;
            border-radius: 20px;
            padding: 24px;

            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .info-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;

            border-radius: 13px;
            background: #6D28D9;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 21px;
        }

        .info-card h4 {
            color: #34156F;
            margin-bottom: 6px;
            font-size: 16px;
        }

        .info-card p {
            color: #6B7280;
            font-size: 13px;
            line-height: 1.7;
        }

        /* STATISTIK MINI */
        .mini-stats {
            margin-top: 25px;

            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .mini-stat {
            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 18px;
            padding: 20px;

            display: flex;
            align-items: center;
            gap: 14px;

            box-shadow: 0 6px 18px rgba(52, 21, 111, 0.04);
        }

        .mini-stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 13px;
            background: #F3E8FF;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;
        }

        .mini-stat-number {
            font-size: 21px;
            color: #34156F;
            font-weight: 700;
        }

        .mini-stat-label {
            font-size: 12px;
            color: #6B7280;
            margin-top: 3px;
        }

        /* FOOTER */
        footer {
            margin-top: 45px;
            text-align: center;
            color: #8B819B;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .mini-stats {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 700px) {
            .topbar-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .welcome-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .welcome-icon {
                width: 70px;
                height: 70px;
                min-width: 70px;
                font-size: 32px;
            }

            .welcome-text h2 {
                font-size: 24px;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .mini-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="topbar">
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

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="logout-form"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Keluar
                </button>
            </form>

        </div>
    </div>


    <div class="container">

        <!-- WELCOME -->
        <div class="welcome-card">

            <div class="welcome-text">

                <div class="small-title">
                    DASHBOARD ORANG TUA
                </div>

                <h2>
                    Halo,
                    {{ auth()->user()->name ?? 'Pengguna' }} 👋
                </h2>

                <p>
                    Selamat datang di Sistem Informasi Gizi Anak
                    Puskesmas Seroja. Gunakan menu di bawah untuk
                    memantau pertumbuhan dan kebutuhan nutrisi anak
                    dengan lebih mudah.
                </p>

            </div>

            <div class="welcome-icon">
                🧒
            </div>

        </div>


        <!-- MENU LAYANAN -->
        <div class="section-header">

            <h3>
                Layanan Utama
            </h3>

            <p>
                Pilih layanan yang ingin kamu gunakan.
            </p>

        </div>


        <div class="service-grid">

            <!-- DATA ANAK -->
            <a
                href="{{ route('user.children.index') }}"
                class="service-card"
            >

                <div>

                    <div class="service-icon">
                        👶
                    </div>

                    <div class="service-content">

                        <h4>
                            Data Anak
                        </h4>

                        <p>
                            Kelola data anak seperti nama,
                            tanggal lahir, jenis kelamin,
                            berat badan dan tinggi badan.
                        </p>

                    </div>

                </div>

                <div class="service-footer">

                    <span class="service-label">
                        Buka Data Anak
                    </span>

                    <span class="arrow">
                        →
                    </span>

                </div>

            </a>


            <!-- PERTUMBUHAN -->
            <a
                href="{{ route('user.growth.index') }}"
                class="service-card"
            >

                <div>

                    <div class="service-icon">
                        📈
                    </div>

                    <div class="service-content">

                        <h4>
                            Pertumbuhan Anak
                        </h4>

                        <p>
                            Lihat perkembangan berat dan tinggi
                            badan anak dari waktu ke waktu.
                        </p>

                    </div>

                </div>

                <div class="service-footer">

                    <span class="service-label">
                        Lihat Pertumbuhan
                    </span>

                    <span class="arrow">
                        →
                    </span>

                </div>

            </a>


            <!-- NUTRISI -->
            <a
                href="{{ route('user.nutrition.create') }}"
                class="service-card"
            >

                <div>

                    <div class="service-icon">
                        🥗
                    </div>

                    <div class="service-content">

                        <h4>
                            Hitung Nutrisi
                        </h4>

                        <p>
                            Hitung kebutuhan energi, protein,
                            lemak dan karbohidrat anak.
                        </p>

                    </div>

                </div>

                <div class="service-footer">

                    <span class="service-label">
                        Hitung Nutrisi
                    </span>

                    <span class="arrow">
                        →
                    </span>

                </div>

            </a>


            <!-- CATATAN -->
            <a
                href="{{ route('user.notes.index') }}"
                class="service-card"
            >

                <div>

                    <div class="service-icon">
                        📝
                    </div>

                    <div class="service-content">

                        <h4>
                            Catatan Puskesmas
                        </h4>

                        <p>
                            Lihat catatan atau pesan yang diberikan
                            oleh petugas Puskesmas Seroja.
                        </p>

                    </div>

                </div>

                <div class="service-footer">

                    <span class="service-label">
                        Lihat Catatan
                    </span>

                    <span class="arrow">
                        →
                    </span>

                </div>

            </a>

        </div>


        <!-- RINGKASAN -->
        <div class="section-header">

            <h3>
                Ringkasan
            </h3>

            <p>
                Informasi singkat mengenai data kamu.
            </p>

        </div>


        <div class="mini-stats">

            <!-- TOTAL ANAK -->
            <div class="mini-stat">

                <div class="mini-stat-icon">
                    👶
                </div>

                <div>

                    <div class="mini-stat-number">
                        {{ $totalChildren ?? 0 }}
                    </div>

                    <div class="mini-stat-label">
                        Data Anak
                    </div>

                </div>

            </div>


            <!-- TOTAL PERTUMBUHAN -->
            <div class="mini-stat">

                <div class="mini-stat-icon">
                    📊
                </div>

                <div>

                    <div class="mini-stat-number">
                        {{ $totalGrowth ?? 0 }}
                    </div>

                    <div class="mini-stat-label">
                        Data Pertumbuhan
                    </div>

                </div>

            </div>


            <!-- TOTAL CATATAN -->
            <div class="mini-stat">

                <div class="mini-stat-icon">
                    📝
                </div>

                <div>

                    <div class="mini-stat-number">
                        {{ $totalNotes ?? 0 }}
                    </div>

                    <div class="mini-stat-label">
                        Catatan Puskesmas
                    </div>

                </div>

            </div>

        </div>


        <!-- INFORMASI -->
        <div class="info-section">

            <div class="info-card">

                <div class="info-icon">
                    💡
                </div>

                <div>

                    <h4>
                        Tips Penggunaan
                    </h4>

                    <p>
                        Pastikan data anak selalu diperbarui,
                        terutama berat dan tinggi badan. Data yang
                        lengkap membantu pemantauan pertumbuhan anak
                        menjadi lebih baik.
                    </p>

                </div>

            </div>

        </div>


        <!-- FOOTER -->
        <footer>
            © {{ date('Y') }} Puskesmas Seroja
            • Sistem Informasi Gizi Anak
        </footer>

    </div>

</body>
</html>