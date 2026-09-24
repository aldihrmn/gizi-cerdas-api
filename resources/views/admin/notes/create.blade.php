<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Beri Catatan Anak - Gizi Cerdas</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f3ff;
            color: #1f2937;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(
                135deg,
                #6d28d9,
                #7c3aed,
                #8b5cf6
            );

            color: white;
            padding: 35px 20px;
        }

        .header-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .brand {
            font-size: 14px;
            font-weight: 600;
            color: #ede9fe;
            margin-bottom: 8px;
        }

        .title {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
        }

        .subtitle {
            margin-top: 10px;
            color: #ede9fe;
            font-size: 15px;
        }

        .content {
            max-width: 900px;
            margin: 0 auto;
            padding: 35px 20px 50px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            margin: 0;
            color: #4c1d95;
            font-size: 22px;
            font-weight: 700;
        }

        .card-description {
            margin-top: 8px;
            margin-bottom: 28px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
        }

        .selected-box {
            background: #f3e8ff;
            border: 1px solid #ddd6fe;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .selected-label {
            font-size: 13px;
            color: #6d28d9;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .selected-name {
            font-size: 20px;
            font-weight: 700;
            color: #4c1d95;
        }

        .selected-owner {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
            color: #374151;
        }

        .form-help {
            margin-top: -3px;
            margin-bottom: 9px;
            font-size: 12px;
            color: #9ca3af;
        }

        .form-select,
        .form-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 13px 14px;
            font-size: 15px;
            background: white;
            color: #1f2937;
            outline: none;
            transition: 0.2s;
        }

        .form-select:focus,
        .form-textarea:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12);
        }

        .form-textarea {
            min-height: 200px;
            resize: vertical;
            line-height: 1.7;
        }

        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 25px;
        }

        .error-box-title {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 12px;
            padding: 13px 22px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;
        }

        .btn-primary:hover {
            background: #6d28d9;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .btn-dashboard {
            background: #f3e8ff;
            color: #6d28d9;
        }

        .btn-dashboard:hover {
            background: #e9d5ff;
        }

        .empty-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 22px;
            line-height: 1.6;
            font-size: 14px;
        }

        .footer-note {
            margin-top: 22px;
            padding: 14px 16px;
            background: #f9fafb;
            border-radius: 12px;
            color: #6b7280;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 640px) {

            .header {
                padding: 28px 15px;
            }

            .title {
                font-size: 25px;
            }

            .content {
                padding: 20px 15px 35px;
            }

            .card {
                padding: 20px;
                border-radius: 16px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    {{-- =========================================================
         HEADER
         ========================================================= --}}
    <header class="header">

        <div class="header-inner">

            <div class="brand">
                Gizi Cerdas
            </div>

            <h1 class="title">
                📝 Beri Catatan Anak
            </h1>

            <p class="subtitle">
                Tambahkan catatan pemantauan dari admin untuk anak.
            </p>

        </div>

    </header>


    {{-- =========================================================
         CONTENT
         ========================================================= --}}
    <main class="content">

        <div class="card">

            <h2 class="card-title">
                Form Catatan Admin
            </h2>

            <p class="card-description">
                Gunakan form ini untuk memberikan catatan atau
                informasi tambahan terkait kondisi dan pemantauan anak.
            </p>


            {{-- =====================================================
                 ERROR VALIDASI
                 ===================================================== --}}
            @if ($errors->any())

                <div class="error-box">

                    <div class="error-box-title">
                        Terjadi kesalahan:
                    </div>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =====================================================
                 JIKA BELUM ADA DATA ANAK
                 ===================================================== --}}
            @if ($children->count() === 0)

                <div class="empty-box">

                    <strong>Belum ada data anak.</strong>

                    <br>

                    Silakan tambahkan data anak terlebih dahulu
                    sebelum membuat catatan.

                </div>

            @endif


            {{-- =====================================================
                 ANAK YANG SUDAH DIPILIH
                 ===================================================== --}}
            @if ($selectedChild)

                <div class="selected-box">

                    <div class="selected-label">
                        ANAK YANG DIPILIH
                    </div>

                    <div class="selected-name">
                        {{ $selectedChild->name }}
                    </div>

                    @if ($selectedChild->user)

                        <div class="selected-owner">
                            Pemilik:
                            {{ $selectedChild->user->name }}
                        </div>

                    @endif

                </div>

            @endif


            {{-- =====================================================
                 FORM
                 ===================================================== --}}
            <form
                action="{{ route('admin.notes.store') }}"
                method="POST"
            >

                @csrf


                {{-- =================================================
                     PILIH ANAK
                     ================================================= --}}
                <div class="form-group">

                    <label
                        for="child_id"
                        class="form-label"
                    >
                        Pilih Anak
                    </label>

                    <div class="form-help">
                        Pilih anak yang akan menerima catatan.
                    </div>

                    <select
                        id="child_id"
                        name="child_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Anak --
                        </option>


                        @foreach ($children as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected(
                                    old(
                                        'child_id',
                                        $selectedChild?->id
                                    ) == $item->id
                                )
                            >

                                {{ $item->name }}

                                @if ($item->user)

                                    -
                                    {{ $item->user->name }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                     CATATAN
                     ================================================= --}}
                <div class="form-group">

                    <label
                        for="note"
                        class="form-label"
                    >
                        Catatan Admin
                    </label>

                    <div class="form-help">
                        Tulis catatan yang ingin disampaikan
                        kepada pemilik anak.
                    </div>

                    <textarea
                        id="note"
                        name="note"
                        class="form-textarea"
                        placeholder="Contoh: Berat badan anak perlu dipantau kembali pada pemeriksaan berikutnya."
                        required
                    >{{ old('note') }}</textarea>

                </div>


                {{-- =================================================
                     BUTTON
                     ================================================= --}}
                <div class="button-group">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        💾 Simpan Catatan
                    </button>


                    <a
                        href="{{ route('admin.notes.index') }}"
                        class="btn btn-secondary"
                    >
                        ← Kembali
                    </a>


                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-dashboard"
                    >
                        🏠 Dashboard
                    </a>

                </div>


                {{-- =================================================
                     CATATAN BAWAH
                     ================================================= --}}
                <div class="footer-note">

                    Catatan yang disimpan akan tercatat sebagai
                    catatan dari admin dan dikaitkan dengan anak
                    yang dipilih.

                </div>

            </form>

        </div>

    </main>

</div>

</body>

</html>