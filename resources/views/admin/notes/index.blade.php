<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Catatan Admin - Gizi Cerdas
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


        .main-content {
            margin-left: 230px;

            min-height: 100vh;
        }


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


        .page {
            padding: 25px;
        }


        .header {
            background: white;

            padding: 25px;

            border-radius: 18px;

            margin-bottom: 20px;

            box-shadow:
                0 8px 22px
                rgba(40,30,70,0.05);
        }


        .header h1 {
            margin: 0 0 7px;

            color: #4c1d95;

            font-size: 24px;
        }


        .header p {
            margin: 0;

            color: #817a8d;

            font-size: 13px;

            line-height: 1.7;
        }


        .success {
            background: #dcfce7;

            color: #166534;

            padding: 13px 15px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 12px;
        }


        .table-card {
            background: white;

            border-radius: 18px;

            padding: 20px;

            box-shadow:
                0 8px 22px
                rgba(40,30,70,0.05);

            overflow-x: auto;
        }


        table {
            width: 100%;

            min-width: 900px;

            border-collapse: collapse;
        }


        th {
            background: #f5efff;

            color: #512078;

            padding: 12px;

            text-align: left;

            font-size: 11px;
        }


        td {
            padding: 12px;

            border-bottom:
                1px solid #eeeeee;

            font-size: 11px;

            color: #665e70;

            vertical-align: top;
        }


        tr:hover {
            background: #faf8ff;
        }


        .badge {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 6px;

            background: #eee5ff;

            color: #6d28d9;

            font-size: 9px;

            font-weight: bold;
        }


        .note-text {
            max-width: 350px;

            line-height: 1.6;
        }


        .action {
            display: inline-block;

            padding:
                7px 10px;

            border-radius: 7px;

            background: #f0e8ff;

            color: #6d28d9;

            font-size: 10px;

            font-weight: bold;

            text-decoration: none;
        }


        .empty {
            padding: 20px;

            background: #fff7df;

            color: #8c6900;

            border-radius: 10px;

            font-size: 12px;
        }


        .delete-button {
            background: #fee2e2;

            border: none;

            color: #b91c1c;

            padding:
                7px 10px;

            border-radius: 7px;

            font-size: 10px;

            font-weight: bold;

            cursor: pointer;

            margin-left: 5px;
        }


        .footer {
            text-align: center;

            padding:
                30px 0 10px;

            color: #aaa3b1;

            font-size: 10px;
        }

    </style>

</head>


<body>


    @include('admin.layouts.sidebar')


    <div class="main-content">


        <div class="topbar">

            <div>

                <div class="breadcrumb">
                    Admin / Catatan
                </div>

                <div class="page-title">
                    Catatan Admin
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


        <main class="page">


            <div class="header">

                <h1>
                    Catatan Admin
                </h1>

                <p>

                    Halaman ini digunakan untuk melihat
                    catatan yang diberikan Admin kepada
                    orang tua berdasarkan kondisi dan
                    pemantauan anak.

                </p>

            </div>


            @if (session('success'))

                <div class="success">

                    {{ session('success') }}

                </div>

            @endif


            <div class="table-card">


                @if ($notes->count() == 0)

                    <div class="empty">

                        Belum ada catatan Admin.

                    </div>

                @else

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
                                    Admin
                                </th>

                                <th>
                                    Catatan
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($notes as $index => $note)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>


                                    <td>

                                        <span class="badge">
                                            {{ $note->child->name }}
                                        </span>

                                    </td>


                                    <td>

                                        {{ $note->user->name }}

                                        <br>

                                        {{ $note->user->email }}

                                    </td>


                                    <td>
                                        {{ $note->admin->name }}
                                    </td>


                                    <td>

                                        <div class="note-text">

                                            {{ $note->note }}

                                        </div>

                                    </td>


                                    <td>

                                        {{ $note->created_at->format('d-m-Y H:i') }}

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('admin.notes.show', $note->id) }}"
                                            class="action"
                                        >
                                            Lihat
                                        </a>


                                        <form
                                            action="{{ route('admin.notes.destroy', $note->id) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Hapus catatan ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-button"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @endif


            </div>


            <div class="footer">

                © {{ date('Y') }}
                Gizi Cerdas -
                Sistem Informasi Pemantauan Gizi Anak

            </div>


        </main>

    </div>


</body>

</html>