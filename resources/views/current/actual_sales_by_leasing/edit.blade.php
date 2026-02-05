<h2 style="font-family: Arial; margin-bottom:20px;">Edit Actual Sales By Leasing</h2>

<div class="form-box">
    <form action="{{ route('current.actual-sales-by-leasing.update', $row->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Leasing</label>
        <select name="leasing_name">
            @foreach ($leasingOptions as $l)
                <option value="{{ $l }}" {{ $row->leasing_name == $l ? 'selected' : '' }}>{{ $l }}
                </option>
            @endforeach
        </select>

        <label>Tahun</label>
        <input type="number" name="tahun" value="{{ $row->tahun }}">

        <label>Target Per Bulan</label>
        <div class="month-grid">
            @foreach ($months as $m)
                <div>
                    <label>{{ strtoupper($m) }}</label>
                    <input type="number" name="{{ $m }}" value="{{ $row->$m }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn-save">Update Data</button>
    </form>
</div>
