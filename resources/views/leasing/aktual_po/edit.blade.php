<h2 style="font-family: Arial; margin-bottom: 20px;">
    Edit Aktual PO
</h2>

<div class="form-box">
    <form action="{{ route('leasing.aktual-po.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Leasing</label>
        <select name="leasing">
            @foreach(['Suzuki Finance','BCA Finance','KKB BCA','Mandiri Tunas Finance','KKB MANDIRI','BSI','Mandiri Utama Finance','Indomobil Finance','Adira Finance','BNI Finance','MAYBANK','Oto Multiartha Finance','NIAGA Finance','Clipan Finance','Lain - Lain'] as $l)
                <option value="{{ $l }}" {{ $data->leasing == $l ? 'selected' : '' }}>
                    {{ $l }}
                </option>
            @endforeach
        </select>

        <label>Tahun</label>
        <input type="number" name="tahun" value="{{ $data->tahun }}">

        <label>Data Per Bulan</label>
        <div class="month-grid">
            @foreach(['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'] as $m)
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
