<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Detail Catatan - Gizi Cerdas
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


        .card {
            max-width: 850px;

            margin: auto;

            background: white;

            border-radius: 18px;

            padding: 28px;

            box-shadow:
                0 8px 22px
                rgba(40,30,70,0.05);
        }


        .back {
            color: #6d28d9;

            text-decoration: none;

            font-size: 12px;

            display: inline-block;

            margin-bottom: 20px;
        }


        h1 {
            margin:
                0 0 22px;

            color: #4c1d95;

            font-size: 24px;
        }


        .info {
            background: #f5efff;

            border-radius: 12px;

            padding: 18px;

            font-size: 12px;

            color: #6d6380;

            line-height: 1.9;

            margin-bottom: 20px;
        }


        .info strong {
            color: #512078;
        }


        .note {
            background: #faf9ff;

            border:
                1px solid #eeeaf6;

            border-radius: 14px;

            padding: 22px;

            color: #665e70;

            font-size: 13px;

            line-height: 1.9;

            white-space: pre-line;
        }

    </style>

</head>


<body>


    @include('admin.layouts.sidebar')


    <div class="main-content">


        <div class="topbar">

            <div class="page-title">
                Detail Catatan
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


            <div class="card">


                <a
                    href="{{ route('admin.notes.index') }}"
                    class="back"
                >
                    ← Kembali ke Catatan
                </a>


                <h1>
                    Detail Catatan Admin
                </h1>


                <div class="info">

                    <strong>
                        Anak:
                    </strong>

                    {{ $note->child->name }}

                    <br>


                    <strong>
                        Orang Tua:
                    </strong>

                    {{ $note->user->name }}

                    <br>


                    <strong>
                        Admin:
                    </strong>

                    {{ $note->admin->name }}

                    <br>


                    <strong>
                        Tanggal:
                    </strong>

                    {{ $note->created_at->format('d-m-Y H:i') }}

                </div>


                <div class="note">

                    {{ $note->note }}

                </div>


            </div>


        </main>

    </div>


</body>

</html>