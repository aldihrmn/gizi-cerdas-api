<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pertumbuhan Anak</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 1250px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .header-left h1 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 7px;
        }

        .header-left p {
            color: #64748b;
            font-size: 14px;
        }

        .btn-add {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #1d4ed8;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 15px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 22px 25px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 18px;
            color: #1e293b;
        }

        .total-data {
            background: #eff6ff;
            color: #2563eb;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 13px;
            color: #475569;
            border-bottom: 1px solid #e5e7eb;
            font-weight: bold;
        }

        td {
            padding: 16px 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .number {
            font-weight: bold;
            color: #64748b;
        }

        .child-name {
            font-weight: bold;
            color: #1e293b;
        }

        .parent-name {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        .badge-date {
            background: #f1f5f9;
            padding: 7px 10px;
            border-radius: 6px;
            font-size: 13px;
            display: inline-block;
        }

        .badge-weight {
            background: #ecfdf5;
            color: #047857;
            padding: 7px 11px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
        }

        .badge-height {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 7px 11px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
            text-decoration: none;
            border: none;
            padding: 8px 13px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 13px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .empty-state {
            padding: 70px 20px;
            text-align: center;
        }

        .empty-state h3 {
            color: #334155;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .empty-state p {
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .btn-empty {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 7px;
            font-size: 14px;
        }

        .footer-info {
            padding: 18px 25px;
            color: #64748b;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
                text-align: center;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">

            <div class="header-left">
                <h1>📈 Data Pertumbuhan Anak</h1>
                <p>Kelola dan pantau data berat badan serta tinggi badan anak.</p>
            </div>

            <a href="{{ route('admin.growth.create') }}" class="btn-add">
                + Tambah Data Pertumbuhan
            </a>

        </div>


        {{-- NOTIFIKASI BERHASIL --}}
        @if(session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

        @endif


        <div class="card">

            <div class="card-header">

                <h2>Daftar Riwayat Pertumbuhan</h2>

                <div class="total-data">
                    Total: {{ $growthRecords->count() }} Data
                </div>

            </div>


            @if($growthRecords->count() > 0)

                <div class="table-responsive">

                    <table>

                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Orang Tua</th>
                                <th>Tanggal Pemeriksaan</th>
                                <th>Berat Badan</th>
                                <th>Tinggi Badan</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($growthRecords as $index => $growth)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="number">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- NAMA ANAK --}}
                                    <td>

                                        <div class="child-name">
                                            {{ $growth->child->name ?? '-' }}
                                        </div>

                                    </td>


                                    {{-- ORANG TUA --}}
                                    <td>

                                        @if(isset($growth->child) && $growth->child->user)

                                            <div class="child-name">
                                                {{ $growth->child->user->name }}
                                            </div>

                                            <div class="parent-name">
                                                {{ $growth->child->user->email }}
                                            </div>

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>

                                        <span class="badge-date">

                                            {{ \Carbon\Carbon::parse($growth->record_date)->translatedFormat('d F Y') }}

                                        </span>

                                    </td>


                                    {{-- BERAT --}}
                                    <td>

                                        <span class="badge-weight">

                                            {{ number_format($growth->weight, 2, ',', '.') }} kg

                                        </span>

                                    </td>


                                    {{-- TINGGI --}}
                                    <td>

                                        <span class="badge-height">

                                            {{ number_format($growth->height, 2, ',', '.') }} cm

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="action-buttons">

                                            <a
                                                href="{{ route('admin.growth.edit', $growth->id) }}"
                                                class="btn-edit"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('admin.growth.destroy', $growth->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data pertumbuhan ini?')"
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


                <div class="footer-info">

                    Menampilkan {{ $growthRecords->count() }} data pertumbuhan anak.

                </div>


            @else

                {{-- DATA KOSONG --}}
                <div class="empty-state">

                    <h3>Belum Ada Data Pertumbuhan</h3>

                    <p>
                        Saat ini belum ada riwayat pertumbuhan anak yang tersimpan.
                    </p>

                    <a
                        href="{{ route('admin.growth.create') }}"
                        class="btn-empty"
                    >
                        + Tambah Data Pertumbuhan
                    </a>

                </div>

            @endif

        </div>

    </div>

</body>
</html>