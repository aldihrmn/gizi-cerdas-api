<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Anak - Puskesmas Seroja</title>

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
        button {
            font-family: inherit;
        }

        /* =========================
           HEADER
        ========================= */

        .topbar {
            background: linear-gradient(135deg, #6D28D9, #8B5CF6);
            color: white;
            padding: 20px 0;
            box-shadow: 0 8px 25px rgba(109, 40, 217, 0.18);
        }

        .topbar-content {
            max-width: 1000px;
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

        /* =========================
           CONTAINER
        ========================= */

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 30px 22px 50px;
        }

        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 22px;

            padding: 25px;

            display: flex;
            align-items: center;
            gap: 16px;

            box-shadow: 0 8px 25px rgba(52, 21, 111, 0.05);
        }

        .page-icon {
            width: 58px;
            height: 58px;

            border-radius: 17px;
            background: #F3E8FF;

            display: flex;
            justify-content: center;
            align-items: center;

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

        /* =========================
           ERROR
        ========================= */

        .error-box {
            margin-top: 20px;
            margin-bottom: 20px;

            background: #FFF1F2;
            border: 1px solid #FECDD3;
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
            margin-bottom: 3px;
        }

        /* =========================
           FORM CARD
        ========================= */

        .form-card {
            margin-top: 20px;

            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 22px;

            padding: 28px;

            box-shadow: 0 8px 25px rgba(52, 21, 111, 0.05);
        }

        .form-section-title {
            margin-bottom: 22px;
        }

        .form-section-title h3 {
            font-size: 18px;
            color: #34156F;
            margin-bottom: 5px;
        }

        .form-section-title p {
            color: #6B7280;
            font-size: 12px;
        }

        /* =========================
           GRID
        ========================= */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            margin-bottom: 8px;

            font-size: 13px;
            font-weight: 700;
            color: #34156F;
        }

        .required {
            color: #BE123C;
        }

        .form-control {
            width: 100%;
            height: 46px;

            padding: 0 14px;

            border: 1px solid #DDD6FE;
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
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.10);
        }

        .form-help {
            margin-top: 6px;
            color: #8A8494;
            font-size: 11px;
        }

        /* =========================
           GENDER
        ========================= */

        .gender-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .gender-option {
            position: relative;
        }

        .gender-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .gender-option label {
            height: 70px;

            border: 1px solid #E4D9FF;
            border-radius: 13px;

            background: #FCFBFF;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            cursor: pointer;

            color: #6B7280;
            font-size: 13px;
            font-weight: 700;

            transition: 0.2s ease;
        }

        .gender-option label:hover {
            border-color: #BCA4F8;
            background: #F9F6FF;
        }

        .gender-option input:checked + label {
            border-color: #6D28D9;
            background: #F3E8FF;
            color: #6D28D9;
        }

        .gender-icon {
            font-size: 22px;
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

            transform: translateY(-50%);

            color: #8A8494;
            font-size: 12px;
            font-weight: 700;
        }

        /* =========================
           BUTTON
        ========================= */

        .form-actions {
            margin-top: 28px;
            padding-top: 22px;

            border-top: 1px solid #F0EBFF;

            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .button {
            min-width: 125px;
            height: 44px;

            border-radius: 11px;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: 0.2s ease;
        }

        .cancel-button {
            background: white;
            border: 1px solid #DDD6FE;
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

            box-shadow: 0 6px 15px rgba(109, 40, 217, 0.20);
        }

        .save-button:hover {
            background: #5B21B6;
            transform: translateY(-1px);
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
            border: 1px solid #E5D7FF;

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
            line-height: 1.6;
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

    <!-- HEADER -->
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
                href="{{ route('user.children.index') }}"
                class="back-button"
            >
                ← Kembali
            </a>

        </div>

    </header>


    <main class="container">

        <!-- JUDUL -->
        <div class="page-header">

            <div class="page-icon">
                ✏️
            </div>

            <div>

                <h2>
                    Edit Data Anak
                </h2>

                <p>
                    Perbarui informasi anak yang sudah tersimpan
                    agar data pertumbuhan dan nutrisi tetap sesuai.
                </p>

            </div>

        </div>


        <!-- ERROR -->
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


        <!-- FORM -->
        <form
            action="{{ route('user.children.update', $child->id) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            <div class="form-card">

                <div class="form-section-title">

                    <h3>
                        Informasi Anak
                    </h3>

                    <p>
                        Pastikan data yang diperbarui sudah benar.
                    </p>

                </div>


                <div class="form-grid">

                    <!-- NAMA -->
                    <div class="form-group full-width">

                        <label for="name">
                            Nama Anak
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $child->name) }}"
                            placeholder="Contoh: Budi Santoso"
                            maxlength="100"
                            required
                        >

                        <div class="form-help">
                            Masukkan nama lengkap anak.
                        </div>

                    </div>


                    <!-- TANGGAL LAHIR -->
                    <div class="form-group">

                        <label for="birth_date">
                            Tanggal Lahir
                            <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            id="birth_date"
                            name="birth_date"
                            class="form-control"
                            value="{{ old('birth_date', $child->birth_date) }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >

                        <div class="form-help">
                            Tanggal lahir tidak boleh melebihi hari ini.
                        </div>

                    </div>


                    <!-- JENIS KELAMIN -->
                    <div class="form-group">

                        <label>
                            Jenis Kelamin
                            <span class="required">*</span>
                        </label>

                        <div class="gender-options">

                            <!-- LAKI-LAKI -->
                            <div class="gender-option">

                                <input
                                    type="radio"
                                    name="gender"
                                    id="gender_l"
                                    value="L"
                                    {{ old('gender', $child->gender) === 'L' ? 'checked' : '' }}
                                    required
                                >

                                <label for="gender_l">

                                    <span class="gender-icon">
                                        👦
                                    </span>

                                    Laki-laki

                                </label>

                            </div>


                            <!-- PEREMPUAN -->
                            <div class="gender-option">

                                <input
                                    type="radio"
                                    name="gender"
                                    id="gender_p"
                                    value="P"
                                    {{ old('gender', $child->gender) === 'P' ? 'checked' : '' }}
                                >

                                <label for="gender_p">

                                    <span class="gender-icon">
                                        👧
                                    </span>

                                    Perempuan

                                </label>

                            </div>

                        </div>

                    </div>


                    <!-- BERAT -->
                    <div class="form-group">

                        <label for="weight">
                            Berat Badan
                            <span class="required">*</span>
                        </label>

                        <div class="input-unit">

                            <input
                                type="number"
                                id="weight"
                                name="weight"
                                class="form-control"
                                value="{{ old('weight', $child->weight) }}"
                                placeholder="Contoh: 18.5"
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
                            Gunakan hasil pengukuran terbaru.
                        </div>

                    </div>


                    <!-- TINGGI -->
                    <div class="form-group">

                        <label for="height">
                            Tinggi Badan
                            <span class="required">*</span>
                        </label>

                        <div class="input-unit">

                            <input
                                type="number"
                                id="height"
                                name="height"
                                class="form-control"
                                value="{{ old('height', $child->height) }}"
                                placeholder="Contoh: 108"
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
                            Gunakan hasil pengukuran terbaru.
                        </div>

                    </div>

                </div>


                <!-- BUTTON -->
                <div class="form-actions">

                    <a
                        href="{{ route('user.children.index') }}"
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


        <!-- INFO -->
        <div class="info-card">

            <div class="info-icon">
                💡
            </div>

            <div>

                <h4>
                    Periksa Kembali Data
                </h4>

                <p>
                    Setelah data diperbarui, informasi tersebut akan
                    digunakan pada pemantauan pertumbuhan dan
                    perhitungan nutrisi anak.
                </p>

            </div>

        </div>


        <!-- FOOTER -->
        <footer>
            © {{ date('Y') }} Puskesmas Seroja
            • Sistem Informasi Gizi Anak
        </footer>

    </main>

</body>
</html>