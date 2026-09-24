<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anak - Gizi Cerdas</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fb;
            color: #1e293b;
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #3b0764, #6b21a8);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
        }

        .brand {
            padding: 25px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .brand h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .brand p {
            font-size: 12px;
            color: #ddd6fe;
        }

        .menu-title {
            font-size: 11px;
            color: #c4b5fd;
            padding: 25px 20px 10px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #ede9fe;
            padding: 13px 20px;
            margin: 4px 10px;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        /* CONTENT */
        .content {
            width: calc(100% - 250px);
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 75px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
            border-bottom: 1px solid #e2e8f0;
        }

        .topbar-left h3 {
            font-size: 19px;
            margin-bottom: 3px;
        }

        .topbar-left p {
            font-size: 12px;
            color: #64748b;
        }

        .admin-box {
            text-align: right;
        }

        .admin-box strong {
            font-size: 14px;
            display: block;
        }

        .admin-box span {
            font-size: 12px;
            color: #64748b;
        }

        .main {
            padding: 35px;
            max-width: 1100px;
            margin: auto;
        }

        .breadcrumb {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 15px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #7e22ce;
            font-weight: bold;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .page-title p {
            color: #64748b;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(15,23,42,0.07);
            border: 1px solid #e2e8f0;
        }

        .form-title {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-title h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .form-title p {
            font-size: 13px;
            color: #64748b;
        }

        .alert {
            background: #fef2f2;
            color: #b91c1c;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #fecaca;
        }

        .alert ul {
            margin-left: 20px;
            margin-top: 7px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 5px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #334155;
        }

        input,
        select {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            transition: 0.2s;
            background: white;
        }

        input:focus,
        select:focus {
            border-color: #7e22ce;
            box-shadow: 0 0 0 3px rgba(126,34,206,0.1);
        }

        .help-text {
            display: block;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 6px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 12px 22px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-cancel {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-cancel:hover {
            background: #cbd5e1;
        }

        .btn-save {
            background: linear-gradient(135deg, #6b21a8, #9333ea);
            color: white;
            box-shadow: 0 6px 15px rgba(126,34,206,0.2);
        }

        .btn-save:hover {
            opacity: 0.9;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 210px;
            }

            .content {
                width: calc(100% - 210px);
                margin-left: 210px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <aside class="sidebar">

        <div class="brand">
            <h2>🥗 Gizi Cerdas</h2>
            <p>Sistem Informasi Gizi Anak</p>
        </div>

        <div class="menu-title">Menu Admin</div>

        <a href="{{ route('admin.dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}">
            👥 Manajemen User
        </a>

        <a href="{{ route('admin.children.index') }}" class="active">
            👶 Data Anak
        </a>

    </aside>


    <div class="content">

        <header class="topbar">

            <div class="topbar-left">
                <h3>Dashboard Administrator</h3>
                <p>Kelola data sistem Gizi Cerdas</p>
            </div>

            <div class="admin-box">
                <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                <span>Administrator</span>
            </div>

        </header>


        <main class="main">

            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                /
                <a href="{{ route('admin.children.index') }}">Data Anak</a>
                /
                Tambah Data Anak
            </div>


            <div class="page-title">
                <h1>Tambah Data Anak</h1>
                <p>Masukkan informasi anak yang akan disimpan ke dalam sistem.</p>
            </div>


            <div class="card">

                <div class="form-title">
                    <h3>Form Data Anak</h3>
                    <p>Lengkapi seluruh data dengan benar.</p>
                </div>


                @if ($errors->any())
                    <div class="alert">
                        <strong>Data belum berhasil disimpan.</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('admin.children.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        {{-- NAMA ANAK --}}
                        <div class="form-group full">

                            <label for="name">
                                Nama Anak
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap anak"
                                required
                            >

                        </div>


                        {{-- TANGGAL LAHIR --}}
                        <div class="form-group">

                            <label for="birth_date">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date') }}"
                                required
                            >

                        </div>


                        {{-- JENIS KELAMIN --}}
                        <div class="form-group">

                            <label for="gender">
                                Jenis Kelamin
                            </label>

                            <select
                                id="gender"
                                name="gender"
                                required
                            >

                                <option value="">
                                    -- Pilih Jenis Kelamin --
                                </option>

                                <option
                                    value="L"
                                    {{ old('gender') == 'L' ? 'selected' : '' }}
                                >
                                    Laki-laki
                                </option>

                                <option
                                    value="P"
                                    {{ old('gender') == 'P' ? 'selected' : '' }}
                                >
                                    Perempuan
                                </option>

                            </select>

                        </div>


                        {{-- BERAT BADAN --}}
                        <div class="form-group">

                            <label for="weight">
                                Berat Badan (kg)
                            </label>

                            <input
                                type="number"
                                id="weight"
                                name="weight"
                                value="{{ old('weight') }}"
                                step="0.01"
                                min="0"
                                placeholder="Contoh: 12.50"
                                required
                            >

                            <span class="help-text">
                                Masukkan berat badan dalam kilogram.
                            </span>

                        </div>


                        {{-- TINGGI BADAN --}}
                        <div class="form-group">

                            <label for="height">
                                Tinggi Badan (cm)
                            </label>

                            <input
                                type="number"
                                id="height"
                                name="height"
                                value="{{ old('height') }}"
                                step="0.01"
                                min="0"
                                placeholder="Contoh: 95.50"
                                required
                            >

                            <span class="help-text">
                                Masukkan tinggi badan dalam centimeter.
                            </span>

                        </div>

                    </div>


                    <div class="button-group">

                        <a
                            href="{{ route('admin.children.index') }}"
                            class="btn btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-save"
                        >
                            💾 Simpan Data Anak
                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</div>

</body>
</html>