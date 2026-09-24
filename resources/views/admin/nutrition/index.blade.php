<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perhitungan Gizi - Gizi Cerdas</title>

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
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            opacity: .7;
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
            background: rgba(255, 255, 255, .15);
        }

        .menu a.active {
            background: white;
            color: #5b21b6;
            font-weight: bold;
        }

        .logout {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 25px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: rgba(255, 255, 255, .15);
            color: white;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: rgba(255, 255, 255, .25);
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .add-button {
            display: inline-block;
            background: #6d28d9;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #5b21b6;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 19px;
            color: #111827;
        }

        .total {
            background: #ede9fe;
            color: #6d28d9;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
        }

        thead {
            background: #f5f3ff;
        }

        th {
            text-align: left;
            padding: 14px;
            color: #5b21b6;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 15px 14px;
            border-bottom: 1px solid #eeeeee;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #faf9ff;
        }

        .child-name {
            font-weight: bold;
            color: #111827;
        }

        .parent-name {
            color: #6b7280;
            font-size: 13px;
        }

        .bmi {
            display: inline-block;
            background: #ede9fe;
            color: #6d28d9;
            padding: 6px 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            background: #f3f4f6;
            color: #4b5563;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            max-width: 300px;
            line-height: 1.5;
        }

        .recommendation {
            max-width: 300px;
            color: #6b7280;
            font-size: 12px;
            line-height: 1.5;
        }

        .actions {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .btn-view {
            background: #ede9fe;
            color: #6d28d9;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-view:hover {
            background: #ddd6fe;
        }

        .btn-edit {
            background: #f3e8ff;
            color: #7e22ce;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-edit:hover {
            background: #e9d5ff;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .empty h3 {
            color: #374151;
            margin-bottom: 8px;
        }

        .empty a {
            display: inline-block;
            margin-top: 18px;
            background: #6d28d9;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 9px;
            font-weight: bold;
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
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
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

            <a
                href="{{ route('admin.nutrition.index') }}"
                class="active"
            >
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

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button type="submit">
                    Keluar
                </button>

            </form>

        </div>

    </aside>


    <main class="content">


        <div class="topbar">

            <div>

                <h1>
                    Perhitungan Gizi
                </h1>

                <p>
                    Kelola hasil penilaian antropometri anak
                </p>

            </div>


            <a
                href="{{ route('admin.nutrition.create') }}"
                class="add-button"
            >
                + Tambah Perhitungan
            </a>

        </div>


        @if(session('success'))

            <div class="alert-success">

                {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div class="alert-error">

                {{ session('error') }}

            </div>

        @endif


        <div class="card">


            <div class="card-header">

                <h2>
                    Daftar Perhitungan Gizi
                </h2>

                <div class="total">

                    {{ $calculations->count() }} Data

                </div>

            </div>


            @if($calculations->count() > 0)


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Anak
                                </th>

                                <th>
                                    Orang Tua
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Umur
                                </th>

                                <th>
                                    Berat
                                </th>

                                <th>
                                    Tinggi
                                </th>

                                <th>
                                    IMT
                                </th>

                                <th>
                                    Status Gizi
                                </th>

                                <th>
                                    Rekomendasi
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($calculations as $calculation)

                                <tr>


                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>

                                        <div class="child-name">

                                            {{ $calculation->child->name ?? '-' }}

                                        </div>

                                    </td>


                                    <td>

                                        <div class="parent-name">

                                            {{ $calculation->child->user->name ?? '-' }}

                                        </div>

                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse($calculation->calculation_date)->format('d-m-Y') }}

                                    </td>


                                    <td>

                                        {{ $calculation->age_in_months }}

                                        bulan

                                    </td>


                                    <td>

                                        {{ number_format($calculation->weight, 2) }}

                                        kg

                                    </td>


                                    <td>

                                        {{ number_format($calculation->height, 1) }}

                                        cm

                                    </td>


                                    <td>

                                        <span class="bmi">

                                            {{ number_format($calculation->bmi, 2) }}

                                        </span>

                                    </td>


                                    <td>

                                        <span class="status">

                                            {{ $calculation->nutrition_status ?? 'Belum ditentukan' }}

                                        </span>

                                    </td>


                                    <td>

                                        <div class="recommendation">

                                            {{ $calculation->recommendation ?? '-' }}

                                        </div>

                                    </td>


                                    <td>

                                        <div class="actions">


                                            <a
                                                href="{{ route('admin.nutrition.show', $calculation->id) }}"
                                                class="btn-view"
                                            >
                                                Lihat
                                            </a>


                                            <a
                                                href="{{ route('admin.nutrition.edit', $calculation->id) }}"
                                                class="btn-edit"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('admin.nutrition.destroy', $calculation->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data perhitungan ini?')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn-delete"
                                                >
                                                    Hapus
                                                </button>

                                            </form>


                                        </div>

                                    </td>


                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


            @else


                <div class="empty">

                    <div class="empty-icon">
                        🧮
                    </div>

                    <h3>
                        Belum ada perhitungan gizi
                    </h3>

                    <p>
                        Silakan tambahkan data perhitungan gizi anak.
                    </p>


                    <a
                        href="{{ route('admin.nutrition.create') }}"
                    >
                        + Tambah Perhitungan
                    </a>

                </div>


            @endif


        </div>


    </main>


</body>

</html>