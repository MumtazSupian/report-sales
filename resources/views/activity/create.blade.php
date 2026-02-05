<h2 style="text-align:center; font-weight:700; color:#111; margin-bottom:25px;">
    Tambah Activity Plan
</h2>

<div style="
    max-width:700px;
    margin:0 auto;
    background:#fdfdfd;
    border-radius:16px;
    box-shadow:0 4px 20px rgba(0,0,0,0.08);
    padding:30px 40px;
    font-family:'Segoe UI',sans-serif;
    color:#222;
">

<form action="{{ route('activity.store') }}" method="POST">
@csrf

<div style="display:grid; gap:18px;">

    <!-- Jenis Activity -->
    <div>
        <label style="font-weight:600;">Jenis Activity</label>
        <select name="jenis_activity" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
            <option value="Offline">Offline</option>
            <option value="Online">Online</option>
        </select>
    </div>

    <!-- Activity -->
    <div>
        <label style="font-weight:600;">Activity</label>
        <select name="activity" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
            <option value="D_MARKETING">D. MARKETING</option>
            <option value="EXHIBITION">EXHIBITION</option>
            <option value="MOVING_EXHIBITION">MOVING EXHIBITION</option>
            <option value="SHOWROOM_EVENT">SHOWROOM EVENT</option>
            <option value="GROUP_PRESENTATION">GROUP PRESENTATION</option>
            <option value="EVENT_TEST_DRIVE">EVENT TEST DRIVE</option>
            <option value="OPEN_TABLE">OPEN TABLE</option>
            <option value="CETAK_FLYER">CETAK FLYER</option>
        </select>
    </div>

    <!-- Platform -->
    <div>
        <label style="font-weight:600;">Platform / Lokasi</label>
        <input type="text" name="platform_lokasi"
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;"
            placeholder="Masukkan lokasi atau platform">
    </div>

    <!-- Jenis & Type Unit -->
    <hr style="border:none; border-top:1px dashed #bbb; margin:15px 0;">
    <h3 style="font-weight:700;">Upload Konten Display</h3>

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label style="font-weight:600;">Jenis Unit</label>
            <select id="jenis_unit" name="jenis_unit" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                <option value="Commercial">Commercial</option>
                <option value="Passenger">Passenger</option>
            </select>
        </div>

        <div style="flex:1;">
            <label style="font-weight:600;">Type Unit</label>
            <select id="type_unit" name="type_unit" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                <!-- Akan diisi otomatis lewat JavaScript -->
            </select>
        </div>
    </div>

    <!-- Waktu -->
    <hr style="border:none; border-top:1px dashed #bbb; margin:15px 0;">
    <h3 style="font-weight:700;">Waktu Pelaksanaan</h3>

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label style="font-weight:600;">Tanggal</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
        </div>

        <div style="flex:1;">
            <label style="font-weight:600;">Jam</label>
            <input type="time" name="jam" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }}"
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
        </div>
    </div>

    <!-- PIC -->
    <div>
        <label style="font-weight:600;">PIC</label>
        <input type="text" name="pic"
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;"
            placeholder="Masukkan nama PIC">
    </div>

    <!-- Jumlah Sales -->
    <div>
        <label style="font-weight:600;">Jumlah Sales / Shift</label>
        <input type="text" name="jml_sales_shift"
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;"
            placeholder="Masukkan jumlah sales per shift">
    </div>

    <!-- Target & Actual -->
    <hr style="border:none; border-top:1px dashed #bbb; margin:15px 0;">
    <h3 style="font-weight:700;">Target & Actual</h3>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(120px,1fr)); gap:10px;">
        <input type="number" name="target_p" placeholder="Target P" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
        <input type="number" name="target_hp" placeholder="Target HP" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
        <input type="number" name="target_spk" placeholder="Target SPK" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(120px,1fr)); gap:10px;">
        <input type="number" name="actual_p" placeholder="Actual P" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
        <input type="number" name="actual_hp" placeholder="Actual HP" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
        <input type="number" name="actual_spk" placeholder="Actual SPK" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
        <input type="number" name="actual_do" placeholder="Actual DO" style="padding:10px; border:1px solid #ccc; border-radius:8px;">
    </div>

    <!-- Cost -->
    <label style="font-weight:600;">Total Cost (Rp)</label>
    <input type="number" name="total_cost"
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;"
        placeholder="Masukkan total cost">

    <!-- Keterangan -->
    <label style="font-weight:600;">Keterangan</label>
    <textarea name="keterangan" rows="3"
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;"
        placeholder="Masukkan keterangan tambahan"></textarea>

    <!-- Tombol -->
    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:15px;">
        <a href="{{ route('activity.index') }}"
           style="padding:10px 20px; border-radius:8px; border:1px solid #999; color:#111; text-decoration:none;">Kembali</a>
        <button type="submit"
            style="background:#28a745; color:white; padding:10px 22px; border:none; border-radius:8px;">Simpan</button>
    </div>

</div>
</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisSelect = document.getElementById('jenis_unit');
    const typeSelect = document.getElementById('type_unit');

    const typeUnits = {
        Commercial: ['CARRY_PU','CARRY_BOX','CARRY_BV','CARRY_MOKO','CARRY_AMBULANCE','CARRY_TOWING'],
        Passenger: ['APV_MB','APV_AMBULANCE','ERTIGA','ERTIGA_HYBRID','XL7','XL7_HYBRID','S_PRESSO','IGNIS','BALENO','GRAND_VITARA','JIMNY']
    };

    function updateTypeUnit() {
        const selectedJenis = jenisSelect.value;
        const options = typeUnits[selectedJenis] || [];
        typeSelect.innerHTML = '';

        options.forEach(type => {
            const opt = document.createElement('option');
            opt.value = type;
            opt.textContent = type.replace(/_/g, ' ');
            typeSelect.appendChild(opt);
        });
    }

    updateTypeUnit();
    jenisSelect.addEventListener('change', updateTypeUnit);
});
</script>
