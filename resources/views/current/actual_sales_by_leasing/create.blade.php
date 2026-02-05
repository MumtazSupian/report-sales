<h2 style="font-family: Arial; margin-bottom:20px;">Tambah Actual Sales By Leasing</h2>

<style>
    .form-box {
        width: 600px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: white;
        font-family: Arial, sans-serif;
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
        font-size: 14px;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: black;
    }

    .month-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 15px;
    }

    .btn-save {
        margin-top: 20px;
        padding: 10px 15px;
        background: black;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-save:hover {
        background: #333;
    }
</style>

<div class="form-box">
    <form action="{{ route('current.actual-sales-by-leasing.store') }}" method="POST">
        @csrf

        <label>Leasing</label>
        <select name="leasing_name">
            @foreach ($leasingOptions as $l)
                <option value="{{ $l }}">{{ $l }}</option>
            @endforeach
        </select>

        <label>Tahun</label>
        <input type="number" name="tahun" value="{{ date('Y') }}">

        <label>Target Per Bulan</label>
        @php $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des']; @endphp
        <div class="month-grid">
            @foreach ($months as $m)
                <div>
                    <label>{{ strtoupper($m) }}</label>
                    <input type="number" name="{{ $m }}" value="0">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn-save">Simpan Data</button>
    </form>
</div>
