<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pertumbuhan {{ $child->name }} - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">

<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Pertumbuhan {{ $child->name }}
            </h1>

            <p class="text-gray-500 mt-1">
                Pantau perkembangan berat dan tinggi badan anak
            </p>
        </div>

        <a
            href="{{ route('user.growth.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg"
        >
            Kembali
        </a>

    </div>


    {{-- INFORMASI ANAK --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <h2 class="text-xl font-bold text-gray-800 mb-5">
            Data Anak
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-500">
                    Nama
                </p>

                <p class="font-bold text-gray-800 mt-1">
                    {{ $child->name }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-500">
                    Jenis Kelamin
                </p>

                <p class="font-bold text-gray-800 mt-1">
                    {{ $child->gender }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-500">
                    Tanggal Lahir
                </p>

                <p class="font-bold text-gray-800 mt-1">
                    {{ \Carbon\Carbon::parse($child->birth_date)->format('d-m-Y') }}
                </p>
            </div>

        </div>

    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl mb-6">

            {{ session('success') }}

        </div>

    @endif


    {{-- GRAFIK BERAT BADAN --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <div class="mb-5">

            <h2 class="text-xl font-bold text-gray-800">
                Grafik Pertumbuhan Berat Badan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbandingan berat badan anak dengan median standar pertumbuhan
            </p>

        </div>

        <div class="relative h-96">

            <canvas id="weightChart"></canvas>

        </div>

        <div class="mt-4 text-sm text-gray-500">

            <p>
                <strong>Garis anak:</strong>
                hasil pengukuran berat badan anak.
            </p>

            <p>
                <strong>Garis standar:</strong>
                median berat badan berdasarkan usia dan jenis kelamin.
            </p>

        </div>

    </div>


    {{-- GRAFIK TINGGI BADAN --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <div class="mb-5">

            <h2 class="text-xl font-bold text-gray-800">
                Grafik Pertumbuhan Tinggi Badan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbandingan tinggi badan anak dengan median standar pertumbuhan
            </p>

        </div>

        <div class="relative h-96">

            <canvas id="heightChart"></canvas>

        </div>

        <div class="mt-4 text-sm text-gray-500">

            <p>
                <strong>Garis anak:</strong>
                hasil pengukuran tinggi badan anak.
            </p>

            <p>
                <strong>Garis standar:</strong>
                median tinggi badan berdasarkan usia dan jenis kelamin.
            </p>

        </div>

    </div>


    {{-- RIWAYAT PENGUKURAN --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <div class="flex justify-between items-center mb-5">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Riwayat Pengukuran
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Riwayat hasil pengukuran pertumbuhan anak
                </p>

            </div>

            <a
                href="{{ route('user.growth.create', $child->id) }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg"
            >
                + Tambah Pengukuran
            </a>

        </div>


        @if($growthRecords->count() > 0)

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-left">

                            <th class="py-3 px-2">
                                No
                            </th>

                            <th class="py-3 px-2">
                                Tanggal
                            </th>

                            <th class="py-3 px-2">
                                Usia
                            </th>

                            <th class="py-3 px-2">
                                Berat Badan
                            </th>

                            <th class="py-3 px-2">
                                Tinggi Badan
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($growthRecords as $record)

                            @php

                                $birthDate = \Carbon\Carbon::parse($child->birth_date);

                                $recordDate = \Carbon\Carbon::parse($record->record_date);

                                $ageMonths = $birthDate->diffInMonths($recordDate);

                            @endphp

                            <tr class="border-b hover:bg-gray-50">

                                <td class="py-3 px-2">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="py-3 px-2">
                                    {{ $recordDate->format('d-m-Y') }}
                                </td>

                                <td class="py-3 px-2">
                                    {{ $ageMonths }} bulan
                                </td>

                                <td class="py-3 px-2 font-semibold">
                                    {{ $record->weight }} kg
                                </td>

                                <td class="py-3 px-2 font-semibold">
                                    {{ $record->height }} cm
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center py-10">

                <p class="text-gray-500">
                    Belum ada data pengukuran.
                </p>

                <a
                    href="{{ route('user.growth.create', $child->id) }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg mt-4"
                >
                    Tambah Pengukuran
                </a>

            </div>

        @endif

    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | DATA DARI CONTROLLER
    |--------------------------------------------------------------------------
    */

    const labels = @json($labels);

    const weights = @json($weights);

    const heights = @json($heights);

    const weightMedian = @json($weightMedian);

    const heightMedian = @json($heightMedian);


    /*
    |--------------------------------------------------------------------------
    | GRAFIK BERAT BADAN
    |--------------------------------------------------------------------------
    */

    const weightCanvas = document.getElementById('weightChart');

    new Chart(weightCanvas, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [

                {
                    label: 'Berat Badan Anak (kg)',

                    data: weights,

                    borderWidth: 3,

                    tension: 0.3,

                    pointRadius: 5,

                    pointHoverRadius: 7,

                    fill: false
                },

                {
                    label: 'Median Standar (kg)',

                    data: weightMedian,

                    borderWidth: 2,

                    borderDash: [7, 5],

                    tension: 0.3,

                    pointRadius: 3,

                    fill: false
                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {

                legend: {
                    display: true,
                    position: 'top'
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return context.dataset.label +
                                ': ' +
                                context.parsed.y +
                                ' kg';

                        }

                    }

                }

            },

            scales: {

                x: {

                    title: {

                        display: true,

                        text: 'Tanggal Pengukuran'

                    }

                },

                y: {

                    title: {

                        display: true,

                        text: 'Berat Badan (kg)'

                    }

                }

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | GRAFIK TINGGI BADAN
    |--------------------------------------------------------------------------
    */

    const heightCanvas = document.getElementById('heightChart');

    new Chart(heightCanvas, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [

                {
                    label: 'Tinggi Badan Anak (cm)',

                    data: heights,

                    borderWidth: 3,

                    tension: 0.3,

                    pointRadius: 5,

                    pointHoverRadius: 7,

                    fill: false
                },

                {
                    label: 'Median Standar (cm)',

                    data: heightMedian,

                    borderWidth: 2,

                    borderDash: [7, 5],

                    tension: 0.3,

                    pointRadius: 3,

                    fill: false
                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {

                legend: {
                    display: true,
                    position: 'top'
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return context.dataset.label +
                                ': ' +
                                context.parsed.y +
                                ' cm';

                        }

                    }

                }

            },

            scales: {

                x: {

                    title: {

                        display: true,

                        text: 'Tanggal Pengukuran'

                    }

                },

                y: {

                    title: {

                        display: true,

                        text: 'Tinggi Badan (cm)'

                    }

                }

            }

        }

    });

</script>

</body>
</html>
