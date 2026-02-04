<h2 style="font-family: Arial; margin-bottom: 20px;">
    Edit Target DO Unit
</h2>

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

    input, select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
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
    <form action="{{ route('rka.target-do-units.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Mobil Type</label>
        <select name="mobil_type">
            @foreach(['NEW CARRY','APV','ERTIGA','XL7','SPRESO','BALENO','GRAND VITARA','JIMNY 3D','JIMNY 5D','FRONX'] as $type)
                <option value="{{ $type }}" {{ $data->mobil_type == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>

        <label>Tahun</label>
        <input type="number" name="tahun" value="{{ $data->tahun }}">

        <label>Target Per Bulan</label>

        @php
            $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];
        @endphp

        <div class="month-grid">
            @foreach($months as $m)
                <div>
                    <label>{{ strtoupper($m) }}</label>
                    <input type="number" name="{{ $m }}" value="{{ $data->$m }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn-save">
            Update Data
        </button>
    </form>
</div>
