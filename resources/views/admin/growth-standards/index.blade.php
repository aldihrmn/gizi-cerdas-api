<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Standar Gizi - Gizi Cerdas</title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
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
            border-bottom: 1px solid #e7e5eb;
            padding: 0 25px;

            display: flex;
            justify-content: space-between;
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
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #dc2028;
        }

        .page {
            padding: 25px;
        }

        .page-header {
            background: white;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 20px;

            box-shadow:
                0 8px 22px rgba(40, 30, 70, 0.05);
        }

        .header-label {
            color: #9a43d0;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 0.7px;
            margin-bottom: 7px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            color: #40205d;
            font-size: 24px;
        }

        .page-header p {
            margin: 0;
            color: #817a8d;
            font-size: 13px;
            line-height: 1.7;
        }

        .info-box {
            background: #f5efff;
            border: 1px solid #e8dbff;
            border-radius: 15px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .info-box strong {
            color: #5b21b6;
            font-size: 13px;
        }

        .info-box p {
            margin: 7px 0 0;
            color: #776c89;
            font-size: 12px;
            line-height: 1.7;
        }

        .filter-card {
            background: white;
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 20px;

            box-shadow:
                0 8px 22px rgba(40, 30, 70, 0.05);
        }

        .filter-title {
            font-size: 14px;
            font-weight: bold;
            color: #3f3650;
            margin-bottom: 15px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .filter-group label {
            display: block;
            font-size: 11px;
            color: #777080;
            margin-bottom: 6px;
        }

        .filter-group select {
            width: 100%;
            border: 1px solid #ded9e8;
            border-radius: 9px;
            padding: 10px;
            font-size: 12px;
            background: white;
        }

        .table-card {
            background: white;
            border-radius: 18px;
            padding: 20px;

            box-shadow:
                0 8px 22px rgba(40, 30, 70, 0.05);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 15px;
        }

        .table-title {
            font-size: 15px;
            font-weight: bold;
            color: #3f3650;
        }

        .total-data {
            font-size: 11px;
            color: #8b8296;
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

        th {
            background: #f6f1ff;
            color: #512078;
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            white-space: nowrap;
        }

        td {
            padding: 11px 10px;
            border-bottom: 1px solid #eeeeee;
            color: #625b6b;
            font-size: 11px;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #faf8ff;
        }

        .badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: bold;
            background: #eee5ff;
            color: #6d28d9;
        }

        .bottom-info {
            margin-top: 15px;
            color: #928a9b;
            font-size: 10px;
        }

        .footer {
            text-align: center;
            padding: 30px 0 5px;
            color: #aaa3b1;
            font-size: 10px;
        }

        @media (max-width: 900px) {

            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

        }

        @media (max-width: 700px) {

            .main-content {
                margin-left: 220px;
            }

            .page {
                padding: 18px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         SIDEBAR ADMIN
    ========================================================= -->

    @include('admin.layouts.sidebar')


    <!-- =========================================================
         KONTEN UTAMA
    ========================================================= -->

    <div class="main-content">


        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <div class="breadcrumb">
                    Admin / Standar Gizi
                </div>

                <div class="page-title">
                    Standar Gizi
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



        <!-- =====================================================
             HALAMAN
        ====================================================== -->

        <main class="page">


            <!-- HEADER -->

            <div class="page-header">

                <div class="header-label">
                    DATA STANDAR PERTUMBUHAN
                </div>

                <h1>
                    Standar Gizi Anak
                </h1>

                <p>

                    Halaman ini menampilkan data standar
                    pertumbuhan yang tersimpan di dalam
                    sistem Gizi Cerdas.

                </p>

            </div>



            <!-- INFORMASI -->

            <div class="info-box">

                <strong>
                    Informasi Standar Gizi
                </strong>

                <p>

                    Data standar pertumbuhan digunakan
                    sebagai data pendukung dalam proses
                    pemantauan pertumbuhan dan status gizi
                    anak.

                </p>

            </div>



            <!-- FILTER -->

            <div class="filter-card">

                <div class="filter-title">
                    Filter Data
                </div>


                <div class="filter-grid">


                    <!-- JENIS KELAMIN -->

                    <div class="filter-group">

                        <label>
                            Jenis Kelamin
                        </label>

                        <select id="genderFilter">

                            <option value="">
                                Semua
                            </option>

                            <option value="male">
                                Laki-laki
                            </option>

                            <option value="female">
                                Perempuan
                            </option>

                        </select>

                    </div>



                    <!-- INDEKS -->

                    <div class="filter-group">

                        <label>
                            Indeks Pertumbuhan
                        </label>

                        <select id="indexFilter">

                            <option value="">
                                Semua
                            </option>

                            <option value="wfa">
                                BB/U
                            </option>

                            <option value="lfa">
                                PB/U
                            </option>

                            <option value="hfa">
                                TB/U
                            </option>

                            <option value="wfl">
                                BB/PB
                            </option>

                            <option value="wfh">
                                BB/TB
                            </option>

                            <option value="bmiu">
                                IMT/U
                            </option>

                        </select>

                    </div>



                    <!-- UMUR -->

                    <div class="filter-group">

                        <label>
                            Umur Maksimal
                        </label>

                        <select id="ageFilter">

                            <option value="">
                                Semua
                            </option>

                            <option value="6">
                                0 - 6 bulan
                            </option>

                            <option value="12">
                                0 - 12 bulan
                            </option>

                            <option value="24">
                                0 - 24 bulan
                            </option>

                            <option value="60">
                                0 - 60 bulan
                            </option>

                        </select>

                    </div>


                </div>

            </div>



            <!-- TABEL -->

            <div class="table-card">


                <div class="table-header">

                    <div class="table-title">
                        Data Standar Pertumbuhan
                    </div>

                    <div class="total-data">

                        Total:
                        <span id="totalVisible">
                            {{ $standards->count() }}
                        </span>
                        data

                    </div>

                </div>



                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Jenis Kelamin</th>

                                <th>Indeks</th>

                                <th>Umur</th>

                                <th>Nilai Pengukuran</th>

                                <th>Unit</th>

                                <th>-3 SD</th>

                                <th>-2 SD</th>

                                <th>-1 SD</th>

                                <th>Median</th>

                                <th>+1 SD</th>

                                <th>+2 SD</th>

                                <th>+3 SD</th>

                            </tr>

                        </thead>


                        <tbody id="standardTable">


                            @foreach ($standards as $index => $standard)

                                <tr

                                    data-gender="{{ $standard->gender }}"

                                    data-index="{{ $standard->index_type }}"

                                    data-age="{{ $standard->age_month }}"

                                >


                                    <td>
                                        {{ $index + 1 }}
                                    </td>


                                    <td>

                                        @if ($standard->gender === 'male')

                                            <span class="badge">
                                                Laki-laki
                                            </span>

                                        @elseif ($standard->gender === 'female')

                                            <span class="badge">
                                                Perempuan
                                            </span>

                                        @else

                                            {{ $standard->gender }}

                                        @endif

                                    </td>


                                    <td>

                                        @switch($standard->index_type)

                                            @case('wfa')

                                                BB/U

                                                @break

                                            @case('lfa')

                                                PB/U

                                                @break

                                            @case('hfa')

                                                TB/U

                                                @break

                                            @case('wfl')

                                                BB/PB

                                                @break

                                            @case('wfh')

                                                BB/TB

                                                @break

                                            @case('bmiu')

                                                IMT/U

                                                @break

                                            @default

                                                {{ strtoupper($standard->index_type) }}

                                        @endswitch

                                    </td>


                                    <td>

                                        @if (!is_null($standard->age_month))

                                            {{ $standard->age_month }}
                                            bulan

                                        @else

                                            -

                                        @endif

                                    </td>


                                    <td>
                                        {{ $standard->measurement_value ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->measurement_unit ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->sd_minus_3 ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->sd_minus_2 ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->sd_minus_1 ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->median ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->sd_plus_1 ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->sd_plus_2 ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $standard->sd_plus_3 ?? '-' }}
                                    </td>


                                </tr>

                            @endforeach


                        </tbody>

                    </table>

                </div>



                <div class="bottom-info">

                    Data standar yang ditampilkan berasal
                    dari tabel growth_standards.

                </div>


            </div>



            <div class="footer">

                © {{ date('Y') }}
                Gizi Cerdas -
                Sistem Informasi Pemantauan Gizi Anak

            </div>


        </main>

    </div>



    <!-- =========================================================
         FILTER JAVASCRIPT
    ========================================================= -->

    <script>

        const genderFilter =
            document.getElementById('genderFilter');


        const indexFilter =
            document.getElementById('indexFilter');


        const ageFilter =
            document.getElementById('ageFilter');


        const rows =
            document.querySelectorAll(
                '#standardTable tr'
            );


        const totalVisible =
            document.getElementById(
                'totalVisible'
            );


        function filterData() {

            const gender =
                genderFilter.value;


            const index =
                indexFilter.value;


            const age =
                ageFilter.value;


            let total = 0;


            rows.forEach(function(row) {

                const rowGender =
                    row.dataset.gender;


                const rowIndex =
                    row.dataset.index;


                const rowAge =
                    row.dataset.age;


                let show = true;


                if (
                    gender !== '' &&
                    rowGender !== gender
                ) {

                    show = false;

                }


                if (
                    index !== '' &&
                    rowIndex !== index
                ) {

                    show = false;

                }


                if (
                    age !== '' &&
                    rowAge !== ''
                ) {

                    if (
                        parseInt(rowAge) >
                        parseInt(age)
                    ) {

                        show = false;

                    }

                }


                if (show) {

                    row.style.display = '';

                    total++;

                } else {

                    row.style.display = 'none';

                }

            });


            totalVisible.textContent = total;

        }


        genderFilter.addEventListener(
            'change',
            filterData
        );


        indexFilter.addEventListener(
            'change',
            filterData
        );


        ageFilter.addEventListener(
            'change',
            filterData
        );

    </script>


</body>

</html>