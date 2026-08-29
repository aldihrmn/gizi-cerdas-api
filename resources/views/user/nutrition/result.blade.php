<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Perhitungan - Gizi Cerdas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-4xl mx-auto px-6 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Hasil Perhitungan Gizi
            </h1>

            <p class="text-gray-500 mt-1">
                Hasil untuk {{ $child->name }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-6">

            <h2 class="text-xl font-bold text-gray-800 mb-4">
                Data Anak
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <p class="text-gray-500">Nama</p>
                    <p class="font-medium">
                        {{ $child->name }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Jenis Kelamin</p>
                    <p class="font-medium">
                        {{ $child->gender }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Usia</p>
                    <p class="font-medium">
                        {{ $calculation->age }} bulan
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Berat Badan</p>
                    <p class="font-medium">
                        {{ $calculation->weight }} kg
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tinggi Badan</p>
                    <p class="font-medium">
                        {{ $calculation->height }} cm
                    </p>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-6">

            <h2 class="text-xl font-bold text-gray-800 mb-2">
                Grafik Pertumbuhan
            </h2>

            <p class="text-gray-500 text-sm mb-6">
                Grafik menunjukkan perkembangan berat dan tinggi badan
                berdasarkan riwayat pengukuran anak.
            </p>

            <div class="relative h-80">
                <canvas id="growthChart"></canvas>
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-6">

            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Kebutuhan Gizi Harian
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="bg-green-50 rounded-xl p-5">

                    <p class="text-gray-500">
                        Energi
                    </p>

                    <p class="text-3xl font-bold text-green-600 mt-1">
                        {{ number_format($calculation->energy, 0) }}
                    </p>

                    <p class="text-sm text-gray-500">
                        kkal/hari
                    </p>

                </div>

                <div class="bg-blue-50 rounded-xl p-5">

                    <p class="text-gray-500">
                        Protein
                    </p>

                    <p class="text-3xl font-bold text-blue-600 mt-1">
                        {{ number_format($calculation->protein, 2) }}
                    </p>

                    <p class="text-sm text-gray-500">
                        gram/hari
                    </p>

                </div>

                <div class="bg-orange-50 rounded-xl p-5">

                    <p class="text-gray-500">
                        Lemak
                    </p>

                    <p class="text-3xl font-bold text-orange-500 mt-1">
                        {{ number_format($calculation->fat, 2) }}
                    </p>

                    <p class="text-sm text-gray-500">
                        gram/hari
                    </p>

                </div>

                <div class="bg-purple-50 rounded-xl p-5">

                    <p class="text-gray-500">
                        Karbohidrat
                    </p>

                    <p class="text-3xl font-bold text-purple-600 mt-1">
                        {{ number_format($calculation->carbohydrate, 2) }}
                    </p>

                    <p class="text-sm text-gray-500">
                        gram/hari
                    </p>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-6">

            <h2 class="text-xl font-bold text-gray-800 mb-4">
                Riwayat Pengukuran
            </h2>

            @if($growthRecords->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead>
                            <tr class="border-b">
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Berat</th>
                                <th class="py-3">Tinggi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($growthRecords as $record)

                                <tr class="border-b">

                                    <td class="py-3">
                                        {{ $record->record_date->format('d-m-Y') }}
                                    </td>

                                    <td class="py-3">
                                        {{ $record->weight }} kg
                                    </td>

                                    <td class="py-3">
                                        {{ $record->height }} cm
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <p class="text-gray-500">
                    Belum ada riwayat pengukuran.
                </p>

            @endif

        </div>

        <div class="flex flex-col md:flex-row gap-4">

            <a
                href="{{ route('user.nutrition.create') }}"
                class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg"
            >
                Hitung Lagi
            </a>

            <a
                href="{{ route('user.children.index') }}"
                class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg"
            >
                Data Anak
            </a>

            <a
                href="{{ route('user.dashboard') }}"
                class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg"
            >
                Dashboard
            </a>

        </div>

    </div>

    <script>
        const labels = [
            @foreach($growthRecords as $record)
                "{{ $record->record_date->format('d-m-Y') }}",
            @endforeach
        ];

        const weights = [
            @foreach($growthRecords as $record)
                {{ $record->weight }},
            @endforeach
        ];

        const heights = [
            @foreach($growthRecords as $record)
                {{ $record->height }},
            @endforeach
        ];

        const ctx = document.getElementById('growthChart');

        new Chart(ctx, {
            type: 'line',

            data: {
                labels: labels,

                datasets: [
                    {
                        label: 'Berat Badan (kg)',
                        data: weights,
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Tinggi Badan (cm)',
                        data: heights,
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Hasil Pengukuran'
                        }
                    },

                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal Pengukuran'
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>

</body>
</html>
