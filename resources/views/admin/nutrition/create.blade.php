<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Perhitungan Gizi - Gizi Cerdas</title>

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
            min-height: 100vh;
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
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 40px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            opacity: 0.7;
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
            background: rgba(255, 255, 255, 0.15);
        }

        .menu a.active {
            background: white;
            color: #5b21b6;
            font-weight: bold;
        }

        .logout {
            position: absolute;
            bottom: 25px;
            left: 20px;
            right: 20px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
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

        .form-card {
            max-width: 850px;
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .info-box {
            background: #f5f3ff;
            border-left: 4px solid #6d28d9;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .info-box strong {
            color: #5b21b6;
        }

        .info-box p {
            color: #6b7280;
            font-size: 13px;
            margin-top: 5px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
            color: #374151;
        }

        .required {
            color: #dc2626;
        }

        input,
        select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: white;
        }

        input:focus,
        select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .unit-input {
            position: relative;
        }

        .unit-input input {
            padding-right: 55px;
        }

        .unit {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 13px;
            font-weight: bold;
        }

        .error-box {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin-left: 20px;
        }

        .button-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            gap: 15px;
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            color: #4b5563;
            background: #f3f4f6;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-back:hover {
            background: #e5e7eb;
        }

        .btn-save {
            border: none;
            background: #6d28d9;
            color: white;
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #5b21b6;
        }

        .empty-data {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            padding: 15px;
            border-radius: 10px;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
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
            }

            .form-row {
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

            <a href="{{ route('admin.nutrition.index') }}" class="active">
                Perhitungan Gizi
            </a>

        </div>

        <div class="menu-title">
            Sistem
        </div>

        <div class="menu">

            <a href="{{ route('user.dashboard') }}">
                Dashboard User
            </a>

        </div>

        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    Keluar
                </button>
            </form>

        </div>

    </aside>


    <main class="content">

        <div class="topbar">

            <h1>
                Tambah Perhitungan Gizi
            </h1>

            <p>
                Masukkan hasil pengukuran anak untuk dilakukan penilaian antropometri.
            </p>

        </div>


        @if($errors->any())

            <div class="error-box">

                <strong>
                    Data belum dapat disimpan.
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="form-card">

            <div class="info-box">

                <strong>
                    Acuan Penilaian
                </strong>

                <p>
                    Perhitungan menggunakan data umur, jenis kelamin, berat badan,
                    dan tinggi badan anak untuk penilaian berdasarkan standar
                    antropometri yang digunakan pada sistem.
                </p>

            </div>


            @if($children->count() > 0)

                <form
                    action="{{ route('admin.nutrition.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="form-group">

                        <label for="child_id">
                            Pilih Anak <span class="required">*</span>
                        </label>

                        <select
                            name="child_id"
                            id="child_id"
                            required
                        >

                            <option value="">
                                -- Pilih Anak --
                            </option>

                            @foreach($children as $child)

                                <option
                                    value="{{ $child->id }}"
                                    {{ old('child_id') == $child->id ? 'selected' : '' }}
                                >
                                    {{ $child->name }}
                                    -
                                    {{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}

                                    @if($child->user)
                                        - {{ $child->user->name }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="calculation_date">
                            Tanggal Perhitungan <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            name="calculation_date"
                            id="calculation_date"
                            value="{{ old('calculation_date', date('Y-m-d')) }}"
                            required
                        >

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="weight">
                                Berat Badan <span class="required">*</span>
                            </label>

                            <div class="unit-input">

                                <input
                                    type="number"
                                    name="weight"
                                    id="weight"
                                    step="0.01"
                                    min="0.1"
                                    placeholder="Contoh: 20.50"
                                    value="{{ old('weight') }}"
                                    required
                                >

                                <span class="unit">
                                    kg
                                </span>

                            </div>

                        </div>


                        <div class="form-group">

                            <label for="height">
                                Tinggi Badan <span class="required">*</span>
                            </label>

                            <div class="unit-input">

                                <input
                                    type="number"
                                    name="height"
                                    id="height"
                                    step="0.1"
                                    min="1"
                                    placeholder="Contoh: 110.5"
                                    value="{{ old('height') }}"
                                    required
                                >

                                <span class="unit">
                                    cm
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="button-area">

                        <a
                            href="{{ route('admin.nutrition.index') }}"
                            class="btn-back"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="btn-save"
                        >
                            Hitung & Simpan
                        </button>

                    </div>

                </form>

            @else

                <div class="empty-data">

                    <strong>
                        Belum ada data anak.
                    </strong>

                    <p style="margin-top: 5px;">
                        Tambahkan data anak terlebih dahulu sebelum melakukan
                        perhitungan gizi.
                    </p>

                    <a
                        href="{{ route('admin.children.create') }}"
                        style="
                            display:inline-block;
                            margin-top:12px;
                            background:#6d28d9;
                            color:white;
                            text-decoration:none;
                            padding:10px 15px;
                            border-radius:8px;
                            font-weight:bold;
                        "
                    >
                        + Tambah Data Anak
                    </a>

                </div>

            @endif

        </div>

    </main>

</body>
</html>