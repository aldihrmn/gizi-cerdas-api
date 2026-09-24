<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Login - Gizi Cerdas
    </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #F8F5FF 0%,
                    #F1ECFF 100%
                );

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

            color: #24113F;
        }

        button,
        input {
            font-family: inherit;
        }

        /* =====================================================
           WRAPPER LOGIN
        ===================================================== */

        .login-wrapper {
            width: 100%;
            max-width: 1180px;
            min-height: 650px;

            background: #FFFFFF;

            border-radius: 28px;

            overflow: hidden;

            display: grid;

            grid-template-columns: 1fr 1fr;

            box-shadow:
                0 25px 70px
                rgba(91, 33, 182, 0.15);
        }

        /* =====================================================
           PANEL KIRI
        ===================================================== */

        .left-panel {
            position: relative;
            overflow: hidden;

            padding: 58px;

            background:
                linear-gradient(
                    145deg,
                    #7442C5 0%,
                    #6D36B2 45%,
                    #59308F 100%
                );

            color: white;

            display: flex;
            flex-direction: column;
        }

        /* Lingkaran dekorasi */

        .circle-one {
            position: absolute;

            width: 290px;
            height: 290px;

            border-radius: 50%;

            background:
                rgba(255,255,255,0.08);

            top: -110px;
            right: -85px;
        }

        .circle-two {
            position: absolute;

            width: 230px;
            height: 230px;

            border-radius: 50%;

            background:
                rgba(255,255,255,0.07);

            bottom: -105px;
            left: -90px;
        }

        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;

            gap: 16px;
        }

        /* LOGO */

        .brand-logo {
            width: 64px;
            height: 64px;
            min-width: 64px;

            border-radius: 17px;

            background: #FFFFFF;

            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 5px;

            box-shadow:
                0 8px 22px
                rgba(0,0,0,0.14);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            display: block;

            border-radius: 12px;
        }

        .brand-text h2 {
            font-size: 24px;
            font-weight: 800;

            line-height: 1.1;
        }

        .brand-text p {
            margin-top: 6px;

            font-size: 13px;

            color:
                rgba(255,255,255,0.84);
        }

        /* =====================================================
           BADGE
        ===================================================== */

        .system-badge {
            position: relative;
            z-index: 2;

            display: inline-flex;
            align-items: center;

            gap: 7px;

            width: fit-content;

            margin-top: 32px;

            padding:
                8px 14px;

            border-radius: 20px;

            border:
                1px solid
                rgba(255,255,255,0.18);

            background:
                rgba(255,255,255,0.10);

            color: white;

            font-size: 11px;

            font-weight: 700;
        }

        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome-section {
            position: relative;
            z-index: 2;

            margin-top: 30px;

            max-width: 530px;
        }

        .welcome-section h1 {
            font-size: 48px;

            line-height: 1.08;

            font-weight: 800;

            letter-spacing: -1.4px;
        }

        .welcome-section p {
            margin-top: 23px;

            font-size: 17px;

            line-height: 1.8;

            color:
                rgba(255,255,255,0.90);

            max-width: 520px;
        }

        /* =====================================================
           FITUR
        ===================================================== */

        .features {
            position: relative;
            z-index: 2;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 12px;

            margin-top: 35px;
        }

        .feature-card {
            min-height: 128px;

            padding: 17px;

            border-radius: 17px;

            border:
                1px solid
                rgba(255,255,255,0.13);

            background:
                rgba(255,255,255,0.09);

            backdrop-filter:
                blur(4px);
        }

        .feature-icon {
            width: 31px;
            height: 31px;

            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                rgba(255,255,255,0.15);

            font-size: 16px;

            margin-bottom: 12px;
        }

        .feature-card h3 {
            font-size: 13px;

            margin-bottom: 7px;
        }

        .feature-card p {
            font-size: 10px;

            line-height: 1.5;

            color:
                rgba(255,255,255,0.77);
        }

        /* =====================================================
           FOOTER KIRI
        ===================================================== */

        .left-footer {
            position: relative;
            z-index: 2;

            margin-top: auto;

            padding-top: 25px;

            font-size: 11px;

            color:
                rgba(255,255,255,0.78);
        }

        /* =====================================================
           PANEL KANAN
        ===================================================== */

        .right-panel {
            padding:
                74px 72px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }

        .login-header {
            max-width: 520px;
        }

        .login-header h1 {
            color: #271442;

            font-size: 38px;

            font-weight: 800;

            line-height: 1.15;
        }

        .login-header p {
            margin-top: 13px;

            font-size: 15px;

            line-height: 1.7;

            color: #81788F;
        }

        /* =====================================================
           ERROR
        ===================================================== */

        .error-box {
            margin-top: 24px;

            padding:
                13px 15px;

            background: #FFF1F2;

            border:
                1px solid #FECDD3;

            border-radius: 12px;

            color: #BE123C;

            font-size: 12px;

            line-height: 1.6;
        }

        .error-box ul {
            margin-top: 5px;

            margin-left: 17px;
        }

        /* =====================================================
           FORM
        ===================================================== */

        .login-form {
            margin-top: 31px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;

            margin-bottom: 9px;

            color: #372054;

            font-size: 13px;

            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 17px;

            top: 50%;

            transform:
                translateY(-50%);

            font-size: 16px;

            color: #887D97;

            pointer-events: none;
        }

        .form-input {
            width: 100%;

            height: 56px;

            border:
                1px solid #D8D2E5;

            border-radius: 13px;

            background: #F4F7FF;

            color: #1F1730;

            padding:
                0 48px;

            font-size: 14px;

            outline: none;

            transition: 0.2s ease;
        }

        .form-input::placeholder {
            color: #9D96A8;
        }

        .form-input:focus {
            background: white;

            border-color: #7C4BC5;

            box-shadow:
                0 0 0 4px
                rgba(124,75,197,0.10);
        }

        /* =====================================================
           PASSWORD
        ===================================================== */

        .password-toggle {
            position: absolute;

            right: 15px;

            top: 50%;

            transform:
                translateY(-50%);

            border: none;

            background: transparent;

            color: #8A779F;

            font-size: 12px;

            cursor: pointer;

            font-weight: 600;
        }

        .password-toggle:hover {
            color: #6D28D9;
        }

        /* =====================================================
           REMEMBER
        ===================================================== */

        .remember-row {
            display: flex;

            align-items: center;

            gap: 9px;

            margin-top: 4px;

            margin-bottom: 25px;
        }

        .remember-row input {
            width: 17px;

            height: 17px;

            accent-color: #6D28D9;

            cursor: pointer;
        }

        .remember-row label {
            font-size: 12px;

            color: #877D91;

            cursor: pointer;
        }

        /* =====================================================
           BUTTON LOGIN
        ===================================================== */

        .login-button {
            width: 100%;

            height: 57px;

            border: none;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #774BC5,
                    #603399
                );

            color: white;

            font-size: 15px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 12px 24px
                rgba(109,40,217,0.20);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .login-button:hover {
            transform:
                translateY(-1px);

            box-shadow:
                0 15px 28px
                rgba(109,40,217,0.25);
        }

        .login-button:active {
            transform:
                translateY(0);
        }

        /* =====================================================
           FOOTER KANAN
        ===================================================== */

        .right-footer {
            margin-top: 29px;

            padding-top: 27px;

            border-top:
                1px solid #E9E4EF;

            text-align: center;
        }

        .right-footer p {
            color: #8D8497;

            font-size: 11px;

            line-height: 1.7;
        }

        .right-footer strong {
            display: block;

            margin-top: 2px;

            color: #372054;

            font-size: 12px;
        }

        /* =====================================================
           RESPONSIVE TABLET
        ===================================================== */

        @media (max-width: 1000px) {

            .login-wrapper {
                max-width: 900px;
            }

            .left-panel {
                padding: 42px;
            }

            .right-panel {
                padding:
                    55px 45px;
            }

            .welcome-section h1 {
                font-size: 39px;
            }
        }

        /* =====================================================
           RESPONSIVE MOBILE
        ===================================================== */

        @media (max-width: 800px) {

            body {
                align-items: flex-start;
            }

            .login-wrapper {
                grid-template-columns: 1fr;

                max-width: 600px;

                margin-top: 10px;

                margin-bottom: 10px;
            }

            .left-panel {
                min-height: auto;

                padding: 35px;
            }

            .welcome-section h1 {
                font-size: 37px;
            }

            .right-panel {
                padding:
                    45px 35px;
            }
        }

        /* =====================================================
           RESPONSIVE HP
        ===================================================== */

        @media (max-width: 600px) {

            body {
                padding: 10px;
            }

            .login-wrapper {
                border-radius: 21px;
            }

            .left-panel {
                padding:
                    28px 23px;
            }

            .brand-logo {
                width: 56px;
                height: 56px;
                min-width: 56px;

                padding: 4px;
            }

            .brand-text h2 {
                font-size: 20px;
            }

            .brand-text p {
                font-size: 11px;
            }

            .welcome-section {
                margin-top: 25px;
            }

            .welcome-section h1 {
                font-size: 31px;

                letter-spacing: -0.6px;
            }

            .welcome-section p {
                font-size: 14px;

                line-height: 1.7;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .feature-card {
                min-height: auto;
            }

            .right-panel {
                padding:
                    35px 23px;
            }

            .login-header h1 {
                font-size: 31px;
            }

            .login-header p {
                font-size: 14px;
            }
        }

    </style>

</head>


<body>


    <div class="login-wrapper">


        <!-- =====================================================
             PANEL KIRI
        ===================================================== -->

        <section class="left-panel">


            <!-- DEKORASI -->

            <div class="circle-one"></div>

            <div class="circle-two"></div>


            <!-- BRAND -->

            <div class="brand">


                <div class="brand-logo">

                    <img
                        src="{{ asset('images/logo puskes seroja.jpeg') }}"
                        alt="Logo Puskesmas Seroja"
                    >

                </div>


                <div class="brand-text">

                    <h2>
                        Gizi Cerdas
                    </h2>

                    <p>
                        Puskesmas Seroja
                    </p>

                </div>

            </div>


            <!-- BADGE -->

            <div class="system-badge">

                📊

                <span>
                    Sistem Informasi Gizi
                </span>

            </div>


            <!-- WELCOME -->

            <div class="welcome-section">

                <h1>

                    Selamat Datang di
                    <br>
                    Gizi Cerdas

                </h1>


                <p>

                    Sistem pemantauan pertumbuhan
                    dan kebutuhan gizi anak untuk
                    membantu pengelolaan data secara
                    lebih mudah, teratur, dan informatif.

                </p>

            </div>


            <!-- FITUR -->

            <div class="features">


                <!-- PERTUMBUHAN -->

                <div class="feature-card">

                    <div class="feature-icon">
                        📈
                    </div>

                    <h3>
                        Pertumbuhan
                    </h3>

                    <p>
                        Pantau perkembangan anak
                    </p>

                </div>


                <!-- NUTRISI -->

                <div class="feature-card">

                    <div class="feature-icon">
                        🍲
                    </div>

                    <h3>
                        Nutrisi
                    </h3>

                    <p>
                        Perhitungan kebutuhan gizi
                    </p>

                </div>


                <!-- DATA ANAK -->

                <div class="feature-card">

                    <div class="feature-icon">
                        👶
                    </div>

                    <h3>
                        Data Anak
                    </h3>

                    <p>
                        Kelola data dengan rapi
                    </p>

                </div>


            </div>


            <!-- FOOTER KIRI -->

            <div class="left-footer">

                © {{ date('Y') }}
                Gizi Cerdas — Puskesmas Seroja

            </div>


        </section>


        <!-- =====================================================
             PANEL KANAN
        ===================================================== -->

        <section class="right-panel">


            <!-- HEADER LOGIN -->

            <div class="login-header">

                <h1>
                    Masuk ke Akun
                </h1>


                <p>

                    Silakan masuk menggunakan akun
                    yang sudah terdaftar untuk
                    melanjutkan ke sistem Gizi Cerdas.

                </p>

            </div>


            <!-- ERROR -->

            @if ($errors->any())

                <div class="error-box">

                    <strong>
                        Login tidak berhasil.
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


            <!-- FORM LOGIN -->

            <form
                action="{{ route('login') }}"
                method="POST"
                class="login-form"
            >

                @csrf


                <!-- EMAIL -->

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉
                        </span>


                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-input"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>


                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            id="passwordToggle"
                        >
                            Tampilkan
                        </button>

                    </div>

                </div>


                <!-- INGAT SAYA -->

                <div class="remember-row">

                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        value="1"
                    >

                    <label for="remember">
                        Ingat saya
                    </label>

                </div>


                <!-- LOGIN -->

                <button
                    type="submit"
                    class="login-button"
                >

                    Masuk
                    &nbsp; →

                </button>


            </form>


            <!-- FOOTER KANAN -->

            <div class="right-footer">

                <p>
                    Sistem informasi pemantauan pertumbuhan dan nutrisi anak.
                </p>


                <strong>
                    Gizi Cerdas — Puskesmas Seroja
                </strong>

            </div>


        </section>


    </div>


    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

    <script>

        function togglePassword() {

            const password =
                document.getElementById(
                    'password'
                );


            const button =
                document.getElementById(
                    'passwordToggle'
                );


            if (
                password.type === 'password'
            ) {

                password.type = 'text';

                button.textContent =
                    'Sembunyikan';

            } else {

                password.type = 'password';

                button.textContent =
                    'Tampilkan';

            }

        }

    </script>


</body>

</html>