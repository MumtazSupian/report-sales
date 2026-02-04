<h2 style="font-family: Arial; margin-bottom: 20px;">Edit Target DO by SOI</h2>

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
</style>

<div class="form-box">
    <form action="{{ route('rka.target-do-by-soi.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Source Inquiry</label>
        <select name="source_inquiry">
            @foreach([
                'Call In (dari Iklan)',
                'Canvasing',
                'Data Base',
                'Digital Hyperlocal',
                'Digital Non Hyperlocal',
                'Exhibition',
                'Media Digital',
                'Media Elektronik',
                'Mediator',
                'Referensi',
                'Referensi Customer',
                'Showroom Activity',
                'Showroom Walk-in',
                'Website Dealer'
            ] as $s)
                <option value="{{ $s }}" {{ $data->source_inquiry == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>

        <label>Tahun</label>
        <input type="number" name="tahun" value="{{ $data->tahun }}">

        <label>Target Per Bulan</label>
        @php $months = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des']; @endphp

        <div class="month-grid">
            @foreach($months as $m)
                <div>
                    <label>{{ strtoupper($m) }}</label>
                    <input type="number" name="{{ $m }}" value="{{ $data->$m }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn-save">Update Data</button>
    </form>
</div>
