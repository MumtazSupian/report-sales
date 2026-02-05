<h2 style="font-family: Arial; margin-bottom: 20px;">
    Tambah Actual Inquary By Type
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

    input:focus, select:focus {
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
    <form action="{{ route('current.actual-inquary-by-type.store') }}" method="POST">
        @csrf

        <label>Mobil Type</label>
        <select name="mobil_type">
            <option value="NEW CARRY">NEW CARRY</option>
            <option value="APV">APV</option>
            <option value="ERTIGA">ERTIGA</option>
            <option value="XL7">XL7</option>
            <option value="SPRESO">SPRESO</option>
            <option value="BALENO">BALENO</option>
            <option value="GRAND VITARA">GRAND VITARA</option>
            <option value="JIMNY 3D">JIMNY 3D</option>
            <option value="JIMNY 5D">JIMNY 5D</option>
            <option value="FRONX">FRONX</option>
        </select>

        <label>Tahun</label>
        <input type="number" name="tahun" placeholder="Masukkan Tahun">

        <label>Target Per Bulan</label>

        <div class="month-grid">
            <div>
                <label>Jan</label>
                <input type="number" name="jan" value="0">
            </div>

            <div>
                <label>Feb</label>
                <input type="number" name="feb" value="0">
            </div>

            <div>
                <label>Mar</label>
                <input type="number" name="mar" value="0">
            </div>

            <div>
                <label>Apr</label>
                <input type="number" name="apr" value="0">
            </div>

            <div>
                <label>Mei</label>
                <input type="number" name="mei" value="0">
            </div>

            <div>
                <label>Jun</label>
                <input type="number" name="jun" value="0">
            </div>

            <div>
                <label>Jul</label>
                <input type="number" name="jul" value="0">
            </div>

            <div>
                <label>Agu</label>
                <input type="number" name="agu" value="0">
            </div>

            <div>
                <label>Sep</label>
                <input type="number" name="sep" value="0">
            </div>

            <div>
                <label>Okt</label>
                <input type="number" name="okt" value="0">
            </div>

            <div>
                <label>Nov</label>
                <input type="number" name="nov" value="0">
            </div>

            <div>
                <label>Des</label>
                <input type="number" name="des" value="0">
            </div>
        </div>

        <button type="submit" class="btn-save">
            Simpan Data
        </button>
    </form>
</div>
