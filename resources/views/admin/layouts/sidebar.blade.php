<!-- =========================================================
     SIDEBAR ADMIN GIZI CERDAS
========================================================= -->

<aside class="sidebar">

    <!-- =====================================================
         BRAND
    ====================================================== -->

    <div class="sidebar-brand">

        <div class="brand-logo">
            +
        </div>

        <div class="brand-text">

            <div class="brand-name">
                Gizi Cerdas
            </div>

            <div class="brand-subtitle">
                Sistem Informasi Gizi Anak
            </div>

        </div>

    </div>


    <!-- =====================================================
         MENU ADMIN
    ====================================================== -->

    <div class="sidebar-menu">

        <div class="menu-title">
            MENU ADMIN
        </div>


        <!-- DASHBOARD -->

        <a
            href="{{ route('admin.dashboard') }}"
            class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                🏠
            </span>

            <span class="menu-text">
                Dashboard
            </span>

        </a>


        <!-- MANAJEMEN USER -->

        <a
            href="{{ route('admin.users.index') }}"
            class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                👥
            </span>

            <span class="menu-text">
                Manajemen User
            </span>

        </a>


        <!-- DATA ANAK -->

        <a
            href="{{ route('admin.children.index') }}"
            class="menu-item {{ request()->routeIs('admin.children.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                👶
            </span>

            <span class="menu-text">
                Data Anak
            </span>

        </a>


        <!-- PERTUMBUHAN -->

        <a
            href="{{ route('admin.growth.index') }}"
            class="menu-item {{ request()->routeIs('admin.growth.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                📈
            </span>

            <span class="menu-text">
                Pertumbuhan
            </span>

        </a>


        <!-- STANDAR GIZI -->

        <a
            href="{{ route('admin.growth-standards.index') }}"
            class="menu-item {{ request()->routeIs('admin.growth-standards.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                📊
            </span>

            <span class="menu-text">
                Standar Gizi
            </span>

        </a>


        <!-- EDUKASI -->

        <a
            href="{{ route('admin.education.index') }}"
            class="menu-item {{ request()->routeIs('admin.education.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                📚
            </span>

            <span class="menu-text">
                Edukasi
            </span>

        </a>


        <!-- CATATAN ADMIN -->

        <a
            href="{{ route('admin.notes.index') }}"
            class="menu-item {{ request()->routeIs('admin.notes.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                📝
            </span>

            <span class="menu-text">
                Catatan Admin
            </span>

        </a>


        <!-- DATA NUTRISI -->

        <a
            href="{{ route('admin.nutrition.index') }}"
            class="menu-item {{ request()->routeIs('admin.nutrition.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                🥗
            </span>

            <span class="menu-text">
                Data Nutrisi
            </span>

        </a>

    </div>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <div class="sidebar-footer">

        <div class="login-label">
            Login sebagai
        </div>

        <div class="login-user">
            {{ Auth::user()->name }}
        </div>

    </div>

</aside>


<style>

    /* =========================================================
       SIDEBAR UTAMA
    ========================================================= */

    .sidebar {

        position: fixed;

        top: 0;
        left: 0;
        bottom: 0;

        width: 230px;

        background:
            linear-gradient(
                180deg,
                #4b0876 0%,
                #5c0d8a 45%,
                #6d159d 100%
            );

        color: white;

        z-index: 9999;

        display: flex;

        flex-direction: column;

        box-shadow:
            8px 0 25px
            rgba(30, 0, 50, 0.12);

    }


    /* =========================================================
       BRAND
    ========================================================= */

    .sidebar-brand {

        min-height: 78px;

        padding: 18px;

        display: flex;

        align-items: center;

        gap: 11px;

        border-bottom:
            1px solid
            rgba(255,255,255,0.12);

    }


    .brand-logo {

        width: 40px;

        height: 40px;

        border-radius: 10px;

        background:
            rgba(255,255,255,0.15);

        display: flex;

        justify-content: center;

        align-items: center;

        font-size: 25px;

        font-weight: bold;

        flex-shrink: 0;

    }


    .brand-name {

        font-size: 16px;

        font-weight: bold;

        line-height: 1.2;

    }


    .brand-subtitle {

        margin-top: 3px;

        font-size: 9px;

        color:
            rgba(255,255,255,0.70);

    }


    /* =========================================================
       MENU
    ========================================================= */

    .sidebar-menu {

        flex: 1;

        padding: 21px 15px;

        overflow-y: auto;

    }


    .menu-title {

        margin-bottom: 11px;

        color:
            rgba(255,255,255,0.62);

        font-size: 10px;

        font-weight: bold;

        letter-spacing: 0.8px;

    }


    .menu-item {

        position: relative;

        width: 100%;

        min-height: 41px;

        padding: 10px 12px;

        margin-bottom: 5px;

        display: flex;

        align-items: center;

        gap: 10px;

        border-radius: 10px;

        color:
            rgba(255,255,255,0.92);

        font-size: 12px;

        font-weight: 500;

        text-decoration: none;

        cursor: pointer;

        transition:
            all 0.2s ease;

    }


    .menu-item:hover {

        background:
            rgba(255,255,255,0.12);

        color: white;

        transform:
            translateX(2px);

    }


    /* =========================================================
       MENU AKTIF
    ========================================================= */

    .menu-item.active {

        background: white;

        color: #61118f;

        font-weight: bold;

        box-shadow:
            0 7px 18px
            rgba(0,0,0,0.10);

    }


    .menu-item.active::before {

        content: "";

        position: absolute;

        left: 0;

        top: 7px;

        bottom: 7px;

        width: 3px;

        border-radius:
            0 4px 4px 0;

        background: #a855f7;

    }


    /* =========================================================
       ICON
    ========================================================= */

    .menu-icon {

        width: 22px;

        min-width: 22px;

        text-align: center;

        font-size: 14px;

        pointer-events: none;

    }


    .menu-text {

        pointer-events: none;

        white-space: nowrap;

    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .sidebar-footer {

        padding: 17px;

        border-top:
            1px solid
            rgba(255,255,255,0.10);

    }


    .login-label {

        font-size: 9px;

        color:
            rgba(255,255,255,0.60);

    }


    .login-user {

        margin-top: 4px;

        font-size: 11px;

        color: white;

        font-weight: bold;

    }


    /* =========================================================
       SCROLLBAR
    ========================================================= */

    .sidebar-menu::-webkit-scrollbar {

        width: 4px;

    }


    .sidebar-menu::-webkit-scrollbar-thumb {

        background:
            rgba(255,255,255,0.18);

        border-radius: 10px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 800px) {

        .sidebar {

            width: 220px;

        }

    }

</style>