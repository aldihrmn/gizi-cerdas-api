<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Data Pertumbuhan - Gizi Cerdas</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 850px;
            margin: 50px auto;
            padding: 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #6b21a8;
            font-size: 14px;
            font-weight: bold;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin-bottom: 8px;
            font-size: 28px;
        }

        .header p {
            color: #6b7280;
            font-size: 14px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .alert {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert ul {
            margin: 8px 0 0 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124,58,237,0.1);
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-cancel {
            text-decoration: none;
            padding: 12px 20px;
            background: #f3f4f6;
            color: #374151;
            border-radius: 9px;
            font-size: 14px;
        }

        .btn-save {
            border: none;
            padding: 12px 22px;
            border-radius: 9px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            background: linear-gradient(
                135deg,
                #5b21b6,
                #8b1de8
            );
        }

        .child-info {
            margin-top: 8px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            color: #6b7280;
            font-size: 13px;
            display: none;
        }

        @media(max-width: 600px) {

            .container {
                margin: 20px auto;
            }

            .row {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>

<div class="container">

    <a
        href="{{ url('/admin/growth') }}"
        class="back"
    >
        ← Kembali ke Data Pertumbuhan
    </a>


    <div class="header">

        <h1>Tambah Data Pertumbuhan</h1>

        <p>
            Masukkan data berat badan dan tinggi badan anak.
        </p>

    </div>


    <div class="card">


        @if ($errors->any())

            <div class="alert">

                <strong>Data belum lengkap:</strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('admin.growth.store') }}"
            method="POST"
        >

            @csrf


            <div class="form-group">

                <label>Pilih Anak</label>

                <select
                    name="child_id"
                    id="child_id"
                    required
                >

                    <option value="">
                        -- Pilih Anak --
                    </option>


                    @foreach($children as $child)

                        <option
                            value="{{ $child->id }}"
                            data-parent="{{ $child->user->name ?? '-' }}"
                            {{ old('child_id') == $child->id ? 'selected' : '' }}
                        >

                            {{ $child->name }}

                            @if($child->user)

                                - {{ $child->user->name }}

                            @endif

                        </option>

                    @endforeach


                </select>


                <div
                    class="child-info"
                    id="childInfo"
                >
                </div>

            </div>


            <div class="form-group">

                <label>Tanggal Pemeriksaan</label>

                <input
                    type="date"
                    name="record_date"
                    value="{{ old('record_date', date('Y-m-d')) }}"
                    required
                >

            </div>


            <div class="row">


                <div class="form-group">

                    <label>Berat Badan (kg)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="0.1"
                        name="weight"
                        placeholder="Contoh: 18.50"
                        value="{{ old('weight') }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Tinggi Badan (cm)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="1"
                        name="height"
                        placeholder="Contoh: 105.50"
                        value="{{ old('height') }}"
                        required
                    >

                </div>


            </div>


            <div class="actions">

                <a
                    href="{{ url('/admin/growth') }}"
                    class="btn-cancel"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="btn-save"
                >
                    Simpan Data
                </button>

            </div>


        </form>

    </div>

</div>


<script>

    const childSelect = document.getElementById('child_id');

    const childInfo = document.getElementById('childInfo');


    function updateChildInfo()
    {
        const selected =
            childSelect.options[childSelect.selectedIndex];


        if (childSelect.value)
        {
            const parent =
                selected.getAttribute('data-parent');


            childInfo.style.display = 'block';


            childInfo.innerHTML =
                '<strong>Anak:</strong> ' +
                selected.text +
                '<br>' +
                '<strong>Orang Tua:</strong> ' +
                parent;
        }
        else
        {
            childInfo.style.display = 'none';
        }
    }


    childSelect.addEventListener(
        'change',
        updateChildInfo
    );


    updateChildInfo();

</script>

</body>

</html>