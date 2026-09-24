<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Riwayat Pertumbuhan - Puskesmas Seroja
    </title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F8F7FC;
            color: #34156F;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        select,
        input {
            font-family: inherit;
        }

        /* =====================================================
           LAYOUT
        ===================================================== */

        .app {
            min-height: 100vh;
            display: flex;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 210px;
            min-width: 210px;
            background: #FFFFFF;
            border-right: 1px solid #EEE7FF;
            min-height: 100vh;
            padding: 20px 14px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .brand-area {
            padding: 3px 7px 25px;
        }

        .brand-top {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* =====================================================
           LOGO PUSKESMAS
        ===================================================== */

        .brand-logo {
            width: 39px;
            min-width: 39px;
            height: 39px;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 7px 18px
                rgba(109, 40, 217, 0.20);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .brand-title {
            font-size: 15px;
            color: #4C1D95;
            font-weight: 800;
        }

        .brand-subtitle {
            font-size: 8px;
            color: #9B93A8;
            margin-top: 2px;
        }

        .menu-title {
            padding: 0 7px;
            margin-bottom: 8px;
            color: #9B93A8;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .menu-item {
            height: 38px;
            border-radius: 12px;
            padding: 0 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6B7280;
            font-size: 11px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .menu-item:hover {
            background: #F8F4FF;
            color: #6D28D9;
        }

        .menu-item.active {
            background: #F6F0FF;
            color: #6D28D9;
            font-weight: 800;
        }

        .menu-icon {
            width: 18px;
            min-width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .active-dot {
            width: 5px;
            height: 5px;
            background: #F4A7D7;
            border-radius: 50%;
            margin-left: auto;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 12px 7px 0;
        }

        .motivation-card {
            background:
                linear-gradient(
                    145deg,
                    #6D28D9,
                    #7C2FD0
                );
            border-radius: 15px;
            color: white;
            padding: 14px;
            box-shadow:
                0 10px 23px
                rgba(109, 40, 217, 0.18);
        }

        .motivation-icon {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            background: rgba(255,255,255,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .motivation-card h4 {
            font-size: 12px;
            line-height: 1.35;
            margin-bottom: 6px;
        }

        .motivation-card p {
            font-size: 9px;
            line-height: 1.6;
            color: rgba(255,255,255,0.88);
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main-area {
            flex: 1;
            min-width: 0;
        }

        /* =====================================================
           TOP HEADER
        ===================================================== */

        .top-header {
            min-height: 74px;
            background:
                linear-gradient(
                    135deg,
                    #6D28D9,
                    #7C2FD0
                );
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow:
                0 8px 23px
                rgba(109, 40, 217, 0.16);
        }

        .header-left small {
            display: block;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1.4px;
            color: rgba(255,255,255,0.68);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .header-left h1 {
            font-size: 20px;
            font-weight: 800;
        }

        .header-left p {
            margin-top: 3px;
            font-size: 9px;
            color: rgba(255,255,255,0.78);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-badge {
            padding: 7px 12px;
            border-radius: 20px;
            background: rgba(255,255,255,0.13);
            color: white;
            font-size: 9px;
            font-weight: 700;
            border: 1px solid rgba(255,255,255,0.10);
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            border: none;
            padding: 7px 12px;
            border-radius: 20px;
            background: rgba(255,255,255,0.13);
            color: white;
            font-size: 9px;
            font-weight: 700;
            cursor: pointer;
        }

        .logout-button:hover {
            background: rgba(255,255,255,0.20);
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            max-width: 900px;
            margin: 0 auto;
            padding: 26px 28px 45px;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            margin-bottom: 17px;
            border-radius: 13px;
            padding: 13px 15px;
            font-size: 11px;
            font-weight: 600;
        }

        .alert-success {
            background: #ECFDF5;
            color: #047857;
            border: 1px solid #A7F3D0;
        }

        .alert-error {
            background: #FFF1F2;
            color: #BE123C;
            border: 1px solid #FECDD3;
        }

        /* =====================================================
           HERO CARD
        ===================================================== */

        .hero-card {
            background: white;
            border: 1px solid #EEE7FF;
            border-radius: 21px;
            padding: 21px;
            box-shadow:
                0 8px 28px
                rgba(52, 21, 111, 0.06);
        }

        .hero-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
        }

        .hero-title-wrap {
            display: flex;
            align-items: flex-start;
            gap: 11px;
        }

        .hero-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 12px;
            background: #F3E8FF;
            color: #6D28D9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .eyebrow {
            color: #6D28D9;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .hero-title {
            color: #2F145E;
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .hero-description {
            color: #8A8494;
            font-size: 9px;
            line-height: 1.5;
        }

        .primary-button {
            border: none;
            background: #6D28D9;
            color: white;
            padding: 10px 15px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 800;
            cursor: pointer;
            box-shadow:
                0 6px 14px
                rgba(109,40,217,0.18);
            transition: 0.2s ease;
            white-space: nowrap;
        }

        .primary-button:hover {
            background: #5B21B6;
            transform: translateY(-1px);
        }

        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-row {
            margin-top: 20px;
            padding-top: 17px;
            border-top: 1px solid #F2EDFB;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
        }

        .profile-group {
            flex: 1;
            max-width: 330px;
        }

        .label {
            display: block;
            margin-bottom: 7px;
            color: #9B93A8;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .select-wrap {
            position: relative;
        }

        .child-select {
            width: 100%;
            height: 39px;
            border:
                1px solid #DDD6FE;
            background: #FCFBFF;
            color: #4C1D95;
            border-radius: 10px;
            padding: 0 37px 0 12px;
            outline: none;
            appearance: none;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .child-select:focus {
            border-color: #8B5CF6;
            box-shadow:
                0 0 0 3px
                rgba(139,92,246,0.10);
        }

        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #7C3AED;
            pointer-events: none;
            font-size: 11px;
        }

        /* =====================================================
           METRIC TABS
        ===================================================== */

        .metric-tabs {
            display: flex;
            align-items: center;
            gap: 3px;
            padding: 3px;
            background: #F5F2FA;
            border-radius: 11px;
        }

        .metric-tab {
            border: none;
            background: transparent;
            color: #746D7E;
            height: 32px;
            padding: 0 13px;
            border-radius: 9px;
            font-size: 9px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .metric-tab.active {
            background: white;
            color: #6D28D9;
            box-shadow:
                0 3px 9px
                rgba(52,21,111,0.08);
        }

        /* =====================================================
           GRAPH HEADER
        ===================================================== */

        .chart-summary {
            margin-top: 20px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
        }

        .summary-label {
            color: #9B93A8;
            font-size: 8px;
            margin-bottom: 4px;
        }

        .latest-value {
            color: #2F145E;
            font-size: 21px;
            font-weight: 900;
        }

        .latest-unit {
            color: #6B7280;
            font-size: 9px;
            font-weight: 600;
        }

        .record-count {
            color: #9B93A8;
            font-size: 8px;
            font-weight: 700;
        }

        /* =====================================================
           CHART
        ===================================================== */

        .chart-box {
            margin-top: 7px;
            height: 280px;
            position: relative;
        }

        .empty-chart {
            height: 100%;
            border:
                1px dashed #DDD6FE;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            color: #9B93A8;
            background: #FCFBFF;
        }

        .empty-chart-icon {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .empty-chart strong {
            color: #5B21B6;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .empty-chart span {
            font-size: 9px;
        }

        /* =====================================================
           TREND NOTE
        ===================================================== */

        .trend-note {
            margin-top: 13px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #FAF7FF;
            border: 1px solid #EFE7FF;
            color: #7B7188;
            font-size: 8px;
            line-height: 1.6;
        }

        /* =====================================================
           HISTORY
        ===================================================== */

        .history-card {
            margin-top: 17px;
            background: white;
            border:
                1px solid #EEE7FF;
            border-radius: 21px;
            padding: 21px;
            box-shadow:
                0 8px 28px
                rgba(52,21,111,0.05);
        }

        .history-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 15px;
        }

        .history-title-wrap {
            display: flex;
            gap: 11px;
            align-items: center;
        }

        .history-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 12px;
            background: #F3E8FF;
            color: #6D28D9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .history-title {
            font-size: 16px;
            color: #2F145E;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .history-subtitle {
            color: #9B93A8;
            font-size: 8px;
        }

        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: #6D28D9;
            color: white;
            padding: 9px 13px;
            border-radius: 11px;
            font-size: 8px;
            font-weight: 800;
            white-space: nowrap;
            box-shadow:
                0 6px 14px
                rgba(109,40,217,0.15);
        }

        .secondary-button:hover {
            background: #5B21B6;
        }

        /* =====================================================
           RECORD LIST
        ===================================================== */

        .record-list {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .record-item {
            min-height: 61px;
            border:
                1px solid #EEF0F5;
            background: #FBFCFE;
            border-radius: 13px;
            padding: 10px 11px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: 0.2s ease;
        }

        .record-item:hover {
            border-color: #E4D7FB;
            background: #FEFCFF;
        }

        .record-main {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .record-avatar {
            width: 37px;
            height: 37px;
            min-width: 37px;
            border-radius: 11px;
            background: white;
            border:
                1px solid #EAE5F2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .record-info {
            min-width: 0;
        }

        .record-name {
            color: #2F145E;
            font-size: 10px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .record-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
            color: #8A8494;
            font-size: 7px;
            line-height: 1.5;
        }

        .record-status {
            display: inline-flex;
            align-items: center;
            padding: 3px 6px;
            border-radius: 8px;
            background: #ECFDF5;
            color: #059669;
            font-size: 6px;
            font-weight: 900;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .record-actions {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
        }

        .action-link {
            border: none;
            background: transparent;
            font-size: 7px;
            font-weight: 800;
            cursor: pointer;
            padding: 7px 6px;
            border-radius: 7px;
        }

        .detail-link {
            color: #6D28D9;
        }

        .detail-link:hover {
            background: #F5F0FF;
        }

        .edit-link {
            color: #4F46E5;
        }

        .edit-link:hover {
            background: #EEF2FF;
        }

        .delete-button {
            color: #E11D48;
        }

        .delete-button:hover {
            background: #FFF1F2;
        }

        .delete-form {
            margin: 0;
        }

        /* =====================================================
           EMPTY HISTORY
        ===================================================== */

        .empty-history {
            border:
                1px dashed #DDD6FE;
            border-radius: 14px;
            padding: 28px 18px;
            text-align: center;
            background: #FCFBFF;
        }

        .empty-history-icon {
            font-size: 28px;
            margin-bottom: 9px;
        }

        .empty-history h3 {
            color: #5B21B6;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .empty-history p {
            color: #9B93A8;
            font-size: 9px;
            line-height: 1.6;
            max-width: 410px;
            margin: 0 auto 13px;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            text-align: center;
            color: #9B93A8;
            font-size: 8px;
            margin-top: 19px;
            line-height: 1.6;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 185px;
                min-width: 185px;
            }

            .content {
                padding-left: 18px;
                padding-right: 18px;
            }
        }

        @media (max-width: 720px) {

            .app {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-width: 0;
                height: auto;
                min-height: auto;
                position: relative;
                padding: 12px;
                border-right: none;
                border-bottom: 1px solid #EEE7FF;
            }

            .brand-area {
                padding-bottom: 10px;
            }

            .menu-title {
                display: none;
            }

            .menu {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 2px;
            }

            .menu-item {
                min-width: max-content;
                padding: 0 12px;
            }

            .sidebar-bottom {
                display: none;
            }

            .top-header {
                padding: 13px 15px;
            }

            .header-right {
                display: none;
            }

            .hero-top {
                flex-direction: column;
            }

            .primary-button {
                width: 100%;
            }

            .profile-row {
                flex-direction: column;
                align-items: stretch;
            }

            .profile-group {
                max-width: none;
            }

            .metric-tabs {
                width: max-content;
            }

            .record-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .record-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .history-header {
                flex-direction: column;
            }

            .secondary-button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {

            .content {
                padding: 15px 12px 35px;
            }

            .top-header {
                height: auto;
                min-height: 70px;
            }

            .header-left h1 {
                font-size: 17px;
            }

            .hero-card,
            .history-card {
                padding: 16px;
                border-radius: 17px;
            }

            .chart-box {
                height: 240px;
            }

            .record-meta {
                gap: 5px;
            }
        }
    </style>
</head>


<body>

    @php

        /*
         * =====================================================
         * MENYIAPKAN DATA
         * =====================================================
         */

        $childrenData = $children ?? collect();

        $recordsData =
            $growthRecords
            ?? $records
            ?? collect();

        if (!($recordsData instanceof \Illuminate\Support\Collection)) {
            $recordsData = collect($recordsData);
        }

        /*
         * Anak yang dipilih.
         */
        $selectedChildId =
            $selectedChildId
            ?? request('child_id')
            ?? ($childrenData->first()->id ?? null);

        $selectedChildIdString =
            $selectedChildId !== null
                ? (string) $selectedChildId
                : null;

        /*
         * Data pertumbuhan untuk anak yang dipilih.
         */
        $filteredRecords = $recordsData;

        if (
            $selectedChildIdString !== null
            && $recordsData->count() > 0
        ) {

            $hasMultipleChildren =
                $recordsData
                    ->pluck('child_id')
                    ->filter()
                    ->unique()
                    ->count() > 1;

            if ($hasMultipleChildren) {

                $filteredRecords =
                    $recordsData->where(
                        'child_id',
                        $selectedChildId
                    );

            }

        }

        /*
         * Urutkan untuk grafik.
         */
        $filteredRecords =
            $filteredRecords
                ->sortBy(function ($item) {

                    return $item->record_date
                        ?? $item->date
                        ?? $item->created_at
                        ?? '';

                })
                ->values();

        /*
         * Anak aktif.
         */
        $selectedChild =
            $childrenData->firstWhere(
                'id',
                $selectedChildId
            );

        /*
         * Kalau tidak ditemukan,
         * ambil dari record.
         */
        if (
            !$selectedChild
            && $filteredRecords->count() > 0
        ) {

            $selectedChild =
                $filteredRecords->first()->child
                ?? null;

        }

        /*
         * Data terakhir.
         */
        $latestRecord =
            $filteredRecords->last()
            ?? null;

        /*
         * Data grafik.
         */
        $chartLabels = [];

        $chartWeights = [];

        $chartHeights = [];


        foreach ($filteredRecords as $item) {

            $dateValue =
                $item->record_date
                ?? $item->date
                ?? $item->created_at
                ?? null;


            if ($dateValue instanceof \Carbon\Carbon) {

                $dateLabel =
                    $dateValue->translatedFormat(
                        'd M'
                    );

            } elseif ($dateValue) {

                try {

                    $dateLabel =
                        \Carbon\Carbon::parse(
                            $dateValue
                        )->translatedFormat(
                            'd M'
                        );

                } catch (\Throwable $e) {

                    $dateLabel =
                        (string) $dateValue;

                }

            } else {

                $dateLabel = '-';

            }


            $chartLabels[] =
                $dateLabel;


            $chartWeights[] =
                $item->weight !== null
                    ? (float) $item->weight
                    : null;


            $chartHeights[] =
                $item->height !== null
                    ? (float) $item->height
                    : null;

        }


        /*
         * Nama anak.
         */
        $activeChildName =
            $selectedChild->name
            ?? 'Anak';


        /*
         * Gender.
         */
        $activeGender =
            $selectedChild->gender
            ?? null;


        /*
         * Avatar.
         */
        $activeAvatar = '👶';

        if ($activeGender === 'L') {

            $activeAvatar = '👦';

        } elseif ($activeGender === 'P') {

            $activeAvatar = '👧';

        }


        /*
         * Nilai terbaru.
         */
        $latestWeight =
            $latestRecord->weight
            ?? null;

        $latestHeight =
            $latestRecord->height
            ?? null;

    @endphp


    <div class="app">


        <!-- =================================================
             SIDEBAR
        ================================================= -->

        <aside class="sidebar">

            <div class="brand-area">

                <div class="brand-top">

                    <!-- LOGO ASLI PUSKESMAS -->

                    <div class="brand-logo">

                        <img
                            src="{{ asset('images/logo-puskes-seroja.jpeg') }}"
                            alt="Logo Puskesmas Seroja"
                        >

                    </div>


                    <div>

                        <div class="brand-title">
                            Gizi Cerdas
                        </div>

                        <div class="brand-subtitle">
                            Teman tumbuh si kecil
                        </div>

                    </div>

                </div>

            </div>


            <div class="menu-title">
                Menu Utama
            </div>


            <nav class="menu">

                <!-- BERANDA -->

                <a
                    href="{{ route('user.dashboard') }}"
                    class="menu-item"
                >

                    <span class="menu-icon">
                        ⌂
                    </span>

                    <span>
                        Beranda
                    </span>

                </a>


                <!-- HITUNG GIZI -->

                <a
                    href="{{ route('user.nutrition.create') }}"
                    class="menu-item"
                >

                    <span class="menu-icon">
                        ▤
                    </span>

                    <span>
                        Hitung gizi
                    </span>

                </a>


                <!-- RIWAYAT -->

                <a
                    href="{{ route('user.growth.index') }}"
                    class="menu-item active"
                >

                    <span class="menu-icon">
                        ▣
                    </span>

                    <span>
                        Riwayat
                    </span>

                    <span class="active-dot"></span>

                </a>


                <!-- MENU SEHAT -->

                <a
                    href="{{ route('user.nutrition.create') }}"
                    class="menu-item"
                >

                    <span class="menu-icon">
                        🍽
                    </span>

                    <span>
                        Menu sehat
                    </span>

                </a>


                <!-- EDUKASI -->

                <a
                    href="{{ route('user.notes.index') }}"
                    class="menu-item"
                >

                    <span class="menu-icon">
                        ▣
                    </span>

                    <span>
                        Edukasi
                    </span>

                </a>

            </nav>


            <!-- MOTIVASI -->

            <div class="sidebar-bottom">

                <div class="motivation-card">

                    <div class="motivation-icon">
                        💛
                    </div>

                    <h4>
                        Tumbuh dengan cinta
                    </h4>

                    <p>
                        Setiap sapuan kecil berarti
                        untuk masa depan hebat.
                    </p>

                </div>

            </div>

        </aside>


        <!-- =================================================
             MAIN AREA
        ================================================= -->

        <main class="main-area">


            <!-- =================================================
                 TOP HEADER
            ================================================= -->

            <header class="top-header">

                <div class="header-left">

                    <small>
                        Catatan perjalanan
                    </small>

                    <h1>
                        Riwayat pertumbuhan
                    </h1>

                    <p>
                        Edit hasil pengukuran atau hapus profil anak beserta seluruh riwayatnya.
                    </p>

                </div>


                <div class="header-right">

                    <div class="header-badge">
                        ♥ Akurat · Praktis · Terpercaya
                    </div>


                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="logout-form"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="logout-button"
                        >
                            Keluar →
                        </button>

                    </form>

                </div>

            </header>


            <!-- =================================================
                 CONTENT
            ================================================= -->

            <div class="content">


                <!-- =================================================
                     SUCCESS
                ================================================= -->

                @if (session('success'))

                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>

                @endif


                <!-- =================================================
                     ERROR
                ================================================= -->

                @if (session('error'))

                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>

                @endif


                <!-- =================================================
                     GRAFIK
                ================================================= -->

                <section class="hero-card">


                    <!-- JUDUL -->

                    <div class="hero-top">

                        <div class="hero-title-wrap">

                            <div class="hero-icon">
                                ↗
                            </div>


                            <div>

                                <div class="eyebrow">
                                    Tumbuh kembang
                                </div>

                                <div class="hero-title">
                                    Tren pertumbuhan anak
                                </div>

                                <div class="hero-description">
                                    Pantau perubahan berat dan tinggi dari setiap catatan.
                                </div>

                            </div>

                        </div>


                        <a
                            href="{{ route('user.growth.create') }}"
                            class="primary-button"
                        >
                            Catat pengukuran →
                        </a>

                    </div>


                    <!-- PROFIL -->

                    <div class="profile-row">


                        <div class="profile-group">

                            <label
                                for="child_id"
                                class="label"
                            >
                                Profil anak
                            </label>


                            <div class="select-wrap">

                                <select
                                    id="child_id"
                                    class="child-select"
                                    onchange="changeChild(this.value)"
                                >

                                    @forelse (
                                        $childrenData
                                        as $child
                                    )

                                        <option
                                            value="{{ $child->id }}"
                                            {{ (string) $child->id === $selectedChildIdString ? 'selected' : '' }}
                                        >
                                            {{ $child->name }}
                                        </option>

                                    @empty

                                        <option value="">
                                            Belum ada data anak
                                        </option>

                                    @endforelse

                                </select>


                                <span class="select-arrow">
                                    ▾
                                </span>

                            </div>

                        </div>


                        <!-- TAB BERAT / TINGGI -->

                        <div class="metric-tabs">

                            <button
                                type="button"
                                id="weightTab"
                                class="metric-tab active"
                                onclick="switchMetric('weight')"
                            >
                                ⚖ Berat
                            </button>


                            <button
                                type="button"
                                id="heightTab"
                                class="metric-tab"
                                onclick="switchMetric('height')"
                            >
                                ◇ Tinggi
                            </button>

                        </div>

                    </div>


                    <!-- SUMMARY -->

                    <div class="chart-summary">


                        <div>

                            <div class="summary-label">
                                Pengukuran terbaru
                            </div>


                            <div>

                                <span
                                    id="latestValue"
                                    class="latest-value"
                                >

                                    @if ($latestWeight !== null)

                                        {{ number_format(
                                            (float) $latestWeight,
                                            2,
                                            ',',
                                            '.'
                                        ) }}

                                    @elseif ($latestHeight !== null)

                                        {{ number_format(
                                            (float) $latestHeight,
                                            1,
                                            ',',
                                            '.'
                                        ) }}

                                    @else

                                        -

                                    @endif

                                </span>


                                <span
                                    id="latestUnit"
                                    class="latest-unit"
                                >
                                    kg
                                </span>

                            </div>

                        </div>


                        <div class="record-count">

                            {{ $filteredRecords->count() }}

                            catatan

                        </div>

                    </div>


                    <!-- CHART -->

                    <div class="chart-box">

                        @if ($filteredRecords->count() > 0)

                            <canvas
                                id="growthChart"
                            ></canvas>

                        @else

                            <div class="empty-chart">

                                <div class="empty-chart-icon">
                                    📈
                                </div>

                                <strong>
                                    Belum ada riwayat pengukuran
                                </strong>

                                <span>
                                    Tambahkan pengukuran untuk melihat grafik pertumbuhan.
                                </span>

                            </div>

                        @endif

                    </div>


                    <!-- CATATAN GRAFIK -->

                    <div class="trend-note">

                        Grafik membantu melihat perubahan
                        pengukuran anak dari waktu ke waktu.
                        Gunakan data terbaru sebagai bahan
                        pemantauan pertumbuhan secara berkala.

                    </div>

                </section>


                <!-- =================================================
                     SEMUA HASIL TERSIMPAN
                ================================================= -->

                <section class="history-card">


                    <div class="history-header">


                        <div class="history-title-wrap">


                            <div class="history-icon">
                                ▣
                            </div>


                            <div>

                                <div class="history-title">
                                    Semua hasil tersimpan
                                </div>

                                <div class="history-subtitle">

                                    {{ $filteredRecords->count() }}

                                    perhitungan tersimpan

                                </div>

                            </div>

                        </div>


                        <a
                            href="{{ route('user.growth.create') }}"
                            class="secondary-button"
                        >
                            Hitung lagi →
                        </a>

                    </div>


                    @if ($filteredRecords->count() > 0)


                        <div class="record-list">


                            @foreach (
                                $filteredRecords->sortByDesc(function ($item) {

                                    return $item->record_date
                                        ?? $item->date
                                        ?? $item->created_at
                                        ?? '';

                                })
                                as $record
                            )


                                @php

                                    $recordChild =
                                        $record->child
                                        ?? $selectedChild;


                                    $recordDate =
                                        $record->record_date
                                        ?? $record->date
                                        ?? $record->created_at
                                        ?? null;


                                    /*
                                     * Format tanggal.
                                     */

                                    if (
                                        $recordDate
                                        instanceof \Carbon\Carbon
                                    ) {

                                        $displayDate =
                                            $recordDate->translatedFormat(
                                                'd F Y'
                                            );

                                    } elseif ($recordDate) {

                                        try {

                                            $displayDate =
                                                \Carbon\Carbon::parse(
                                                    $recordDate
                                                )->translatedFormat(
                                                    'd F Y'
                                                );

                                        } catch (\Throwable $e) {

                                            $displayDate =
                                                (string) $recordDate;

                                        }

                                    } else {

                                        $displayDate = '-';

                                    }


                                    /*
                                     * Umur saat pengukuran.
                                     */

                                    $ageText = '';


                                    if (
                                        $recordChild
                                        && $recordDate
                                        && $recordChild->birth_date
                                    ) {

                                        try {

                                            $birthDate =
                                                \Carbon\Carbon::parse(
                                                    $recordChild->birth_date
                                                );


                                            $measurementDate =
                                                \Carbon\Carbon::parse(
                                                    $recordDate
                                                );


                                            if (
                                                $measurementDate
                                                    ->greaterThanOrEqualTo(
                                                        $birthDate
                                                    )
                                            ) {

                                                $totalMonths =
                                                    $birthDate
                                                        ->diffInMonths(
                                                            $measurementDate
                                                        );


                                                $years =
                                                    intdiv(
                                                        $totalMonths,
                                                        12
                                                    );


                                                $months =
                                                    $totalMonths % 12;


                                                if ($years > 0) {

                                                    $ageText =
                                                        $years
                                                        . ' tahun '
                                                        . $months
                                                        . ' bulan';

                                                } else {

                                                    $ageText =
                                                        $months
                                                        . ' bulan';

                                                }

                                            }

                                        } catch (\Throwable $e) {

                                            $ageText = '';

                                        }

                                    }


                                    /*
                                     * Avatar anak.
                                     */

                                    $recordGender =
                                        $recordChild->gender
                                        ?? null;


                                    $recordAvatar = '👶';


                                    if (
                                        $recordGender === 'L'
                                    ) {

                                        $recordAvatar = '👦';

                                    } elseif (
                                        $recordGender === 'P'
                                    ) {

                                        $recordAvatar = '👧';

                                    }


                                    /*
                                     * Berat dan tinggi.
                                     */

                                    $recordWeight =
                                        $record->weight
                                        ?? null;


                                    $recordHeight =
                                        $record->height
                                        ?? null;

                                @endphp


                                <div class="record-item">


                                    <div class="record-main">


                                        <div class="record-avatar">

                                            {{ $recordAvatar }}

                                        </div>


                                        <div class="record-info">


                                            <div class="record-name">

                                                {{ $recordChild->name ?? 'Anak' }}

                                            </div>


                                            <div class="record-meta">


                                                @if ($ageText)

                                                    <span>
                                                        {{ $ageText }}
                                                    </span>

                                                @endif


                                                <span>
                                                    📅 {{ $displayDate }}
                                                </span>


                                                @if ($recordWeight !== null)

                                                    <span>
                                                        ⚖
                                                        {{
                                                            number_format(
                                                                (float) $recordWeight,
                                                                2,
                                                                ',',
                                                                '.'
                                                            )
                                                        }}
                                                        kg
                                                    </span>

                                                @endif


                                                @if ($recordHeight !== null)

                                                    <span>
                                                        ↕
                                                        {{
                                                            number_format(
                                                                (float) $recordHeight,
                                                                1,
                                                                ',',
                                                                '.'
                                                            )
                                                        }}
                                                        cm
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    <!-- ACTION -->

                                    <div class="record-actions">


                                        <!-- DETAIL -->

                                        <a
                                            href="{{ route(
                                                'user.growth.show',
                                                $record->id
                                            ) }}"
                                            class="action-link detail-link"
                                        >
                                            Detail ›
                                        </a>


                                        <!-- EDIT -->

                                        <a
                                            href="{{ route(
                                                'user.growth.edit',
                                                $record->id
                                            ) }}"
                                            class="action-link edit-link"
                                        >
                                            ✎ Edit
                                        </a>


                                        <!-- HAPUS -->

                                        <form
                                            action="{{ route(
                                                'user.growth.destroy',
                                                $record->id
                                            ) }}"
                                            method="POST"
                                            class="delete-form"
                                            onsubmit="return confirmDelete()"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-link delete-button"
                                            >
                                                🗑 Hapus
                                            </button>

                                        </form>


                                    </div>

                                </div>


                            @endforeach


                        </div>


                    @else


                        <!-- EMPTY -->

                        <div class="empty-history">

                            <div class="empty-history-icon">
                                📋
                            </div>

                            <h3>
                                Belum ada hasil pengukuran
                            </h3>

                            <p>
                                Belum ada data pertumbuhan untuk anak ini.
                                Tambahkan pengukuran pertama agar grafik
                                dan riwayat dapat ditampilkan.
                            </p>


                            <a
                                href="{{ route('user.growth.create') }}"
                                class="secondary-button"
                                style="
                                    display:inline-flex;
                                    width:auto;
                                "
                            >
                                + Catat pengukuran
                            </a>

                        </div>


                    @endif

                </section>


                <!-- =================================================
                     FOOTER
                ================================================= -->

                <footer>

                    Riwayat membantu melihat perubahan,
                    namun angka tetap merupakan estimasi edukatif.

                    <br>

                    © {{ date('Y') }}
                    Puskesmas Seroja
                    • Sistem Informasi Gizi Anak

                </footer>


            </div>

        </main>

    </div>


    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

    <script>

        /*
         * =====================================================
         * DATA GRAFIK DARI LARAVEL
         * =====================================================
         */

        const chartLabels =
            @json($chartLabels);


        const chartWeights =
            @json($chartWeights);


        const chartHeights =
            @json($chartHeights);


        /*
         * =====================================================
         * VARIABEL GRAFIK
         * =====================================================
         */

        let growthChart = null;

        let currentMetric = 'weight';


        /*
         * =====================================================
         * BUAT GRAFIK
         * =====================================================
         */

        function createGrowthChart(metric) {

            const canvas =
                document.getElementById(
                    'growthChart'
                );


            if (!canvas) {
                return;
            }


            /*
             * Hapus grafik sebelumnya.
             */

            if (growthChart) {

                growthChart.destroy();

                growthChart = null;

            }


            const context =
                canvas.getContext('2d');


            const isWeight =
                metric === 'weight';


            const values =
                isWeight
                    ? chartWeights
                    : chartHeights;


            const label =
                isWeight
                    ? 'Berat badan'
                    : 'Tinggi badan';


            const unit =
                isWeight
                    ? 'kg'
                    : 'cm';


            /*
             * Warna grafik.
             */

            const lineColor =
                isWeight
                    ? '#F97316'
                    : '#6D28D9';


            /*
             * Bersihkan data.
             */

            const cleanValues =
                values.map(function (value) {

                    if (
                        value === null
                        || value === undefined
                        || value === ''
                    ) {

                        return null;

                    }


                    return Number(value);

                });


            /*
             * Buat Chart.js.
             */

            growthChart =
                new Chart(
                    context,
                    {

                        type: 'line',


                        data: {

                            labels:
                                chartLabels,


                            datasets: [

                                {

                                    label:
                                        label,


                                    data:
                                        cleanValues,


                                    borderColor:
                                        lineColor,


                                    backgroundColor:
                                        'transparent',


                                    borderWidth:
                                        2.3,


                                    tension:
                                        0.28,


                                    fill:
                                        false,


                                    spanGaps:
                                        true,


                                    pointRadius:
                                        4,


                                    pointHoverRadius:
                                        6,


                                    pointBorderWidth:
                                        2,


                                    pointBackgroundColor:
                                        '#FFFFFF',


                                    pointBorderColor:
                                        lineColor,

                                }

                            ]

                        },


                        options: {

                            responsive:
                                true,


                            maintainAspectRatio:
                                false,


                            interaction: {

                                intersect:
                                    false,

                                mode:
                                    'index'

                            },


                            plugins: {

                                legend: {

                                    display:
                                        false

                                },


                                tooltip: {

                                    backgroundColor:
                                        '#34156F',


                                    titleColor:
                                        '#FFFFFF',


                                    bodyColor:
                                        '#FFFFFF',


                                    padding:
                                        10,


                                    displayColors:
                                        false,


                                    callbacks: {

                                        label:
                                            function (
                                                context
                                            ) {

                                                const value =
                                                    context.parsed.y;


                                                return (
                                                    label
                                                    + ': '
                                                    + Number(
                                                        value
                                                    ).toLocaleString(
                                                        'id-ID',
                                                        {
                                                            maximumFractionDigits:
                                                                isWeight
                                                                    ? 2
                                                                    : 1
                                                        }
                                                    )
                                                    + ' '
                                                    + unit
                                                );

                                            }

                                    }

                                }

                            },


                            scales: {

                                x: {

                                    grid: {

                                        display:
                                            false

                                    },


                                    border: {

                                        display:
                                            false

                                    },


                                    ticks: {

                                        color:
                                            '#9B93A8',


                                        font: {

                                            size:
                                                8

                                        },


                                        maxRotation:
                                            0,


                                        autoSkip:
                                            true,


                                        maxTicksLimit:
                                            6

                                    }

                                },


                                y: {

                                    beginAtZero:
                                        false,


                                    border: {

                                        display:
                                            false

                                    },


                                    grid: {

                                        color:
                                            '#EDE9FE',


                                        drawBorder:
                                            false,


                                        borderDash:
                                            [
                                                3,
                                                4
                                            ]

                                    },


                                    ticks: {

                                        color:
                                            '#9B93A8',


                                        font: {

                                            size:
                                                8

                                        },


                                        padding:
                                            7

                                    }

                                }

                            }

                        }

                    }
                );

        }


        /*
         * =====================================================
         * GANTI BERAT / TINGGI
         * =====================================================
         */

        function switchMetric(metric) {

            currentMetric =
                metric;


            const weightTab =
                document.getElementById(
                    'weightTab'
                );


            const heightTab =
                document.getElementById(
                    'heightTab'
                );


            /*
             * Tombol aktif.
             */

            if (metric === 'weight') {

                weightTab.classList.add(
                    'active'
                );

                heightTab.classList.remove(
                    'active'
                );

            } else {

                heightTab.classList.add(
                    'active'
                );

                weightTab.classList.remove(
                    'active'
                );

            }


            /*
             * Ubah nilai terbaru.
             */

            const latestValue =
                document.getElementById(
                    'latestValue'
                );


            const latestUnit =
                document.getElementById(
                    'latestUnit'
                );


            const values =
                metric === 'weight'
                    ? chartWeights
                    : chartHeights;


            let latest =
                null;


            /*
             * Ambil nilai terakhir.
             */

            for (
                let i = values.length - 1;
                i >= 0;
                i--
            ) {

                if (
                    values[i] !== null
                    && values[i] !== undefined
                    && values[i] !== ''
                ) {

                    latest =
                        Number(
                            values[i]
                        );

                    break;

                }

            }


            if (latest !== null) {

                latestValue.textContent =
                    latest.toLocaleString(
                        'id-ID',
                        {
                            maximumFractionDigits:
                                metric === 'weight'
                                    ? 2
                                    : 1
                        }
                    );

            } else {

                latestValue.textContent =
                    '-';

            }


            latestUnit.textContent =
                metric === 'weight'
                    ? 'kg'
                    : 'cm';


            /*
             * Gambar ulang grafik.
             */

            createGrowthChart(
                metric
            );

        }


        /*
         * =====================================================
         * PILIH ANAK
         * =====================================================
         */

        function changeChild(childId) {

            if (!childId) {
                return;
            }


            const currentUrl =
                new URL(
                    window.location.href
                );


            currentUrl.searchParams.set(
                'child_id',
                childId
            );


            window.location.href =
                currentUrl.toString();

        }


        /*
         * =====================================================
         * KONFIRMASI HAPUS
         * =====================================================
         */

        function confirmDelete() {

            return confirm(
                'Apakah kamu yakin ingin menghapus data pengukuran ini?'
            );

        }


        /*
         * =====================================================
         * JALANKAN GRAFIK
         * =====================================================
         */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                @if ($filteredRecords->count() > 0)

                    createGrowthChart(
                        'weight'
                    );

                @endif

            }
        );

    </script>

</body>

</html>