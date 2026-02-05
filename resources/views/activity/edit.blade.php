<h2 style="text-align:center; font-weight:700; color:#111; margin-bottom:25px;">
    Edit Activity Plan
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

<form action="{{ route('activity.update', $activity->id) }}"
      method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div style="display:grid; gap:18px;">

    <!-- Jenis Activity -->
    <div>
        <label style="font-weight:600;">Jenis Activity</label>
        <select name="jenis_activity" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
            <option value="Offline" {{ $activity->jenis_activity == 'Offline' ? 'selected' : '' }}>Offline</option>
            <option value="Online" {{ $activity->jenis_activity == 'Online' ? 'selected' : '' }}>Online</option>
        </select>
    </div>

    <!-- Activity -->
    <div>
        <label style="font-weight:600;">Activity</label>
        <select name="activity" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
            @foreach ([
                'D_MARKETING','EXHIBITION','MOVING_EXHIBITION','SHOWROOM_EVENT',
                'GROUP_PRESENTATION','EVENT_TEST_DRIVE','OPEN_TABLE','CETAK_FLYER'
            ] as $act)
                <option value="{{ $act }}" {{ $activity->activity == $act ? 'selected' : '' }}>
                    {{ str_replace('_',' ', $act) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Platform -->
    <div>
        <label style="font-weight:600;">Platform / Lokasi</label>
        <input type="text" name="platform_lokasi"
            value="{{ $activity->platform_lokasi }}"
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
    </div>

    <!-- Upload Konten Display -->
    <hr style="border:none; border-top:1px dashed #bbb;">
    <h3 style="font-weight:700;">Upload Konten Display</h3>

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label style="font-weight:600;">Jenis Unit</label>
            <select id="jenis_unit" name="jenis_unit" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                <option value="Commercial" {{ $activity->jenis_unit == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                <option value="Passenger" {{ $activity->jenis_unit == 'Passenger' ? 'selected' : '' }}>Passenger</option>
            </select>
        </div>

        <div style="flex:1;">
            <label style="font-weight:600;">Type Unit</label>
            <select id="type_unit" name="type_unit"
                data-current="{{ $activity->type_unit }}"
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
            </select>
        </div>
    </div>

    <!-- Waktu -->
    <hr style="border:none; border-top:1px dashed #bbb;">
    <h3 style="font-weight:700;">Waktu Pelaksanaan</h3>

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label style="font-weight:600;">Tanggal</label>
            <input type="date" name="tanggal"
                value="{{ $activity->tanggal }}"
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
        </div>

        <div style="flex:1;">
            <label style="font-weight:600;">Jam</label>
            <input type="time" name="jam"
                value="{{ $activity->jam }}"
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
        </div>
    </div>

    <!-- PIC -->
    <div>
        <label style="font-weight:600;">PIC</label>
        <input type="text" name="pic" value="{{ $activity->pic }}"
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
    </div>

    <!-- Jumlah Sales -->
    <div>
        <label style="font-weight:600;">Jumlah Sales / Shift</label>
        <input type="text" name="jml_sales_shift"
            value="{{ $activity->jml_sales_shift }}"
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
    </div>

    <!-- Target & Actual -->
    <hr style="border:none; border-top:1px dashed #bbb;">
    <h3 style="font-weight:700;">Target & Actual</h3>

    <div style="display:grid; grid-template-columns: repeat(auto-fit,minmax(120px,1fr)); gap:10px;">
        <input type="number" name="target_p" value="{{ $activity->target_p }}" placeholder="Target P">
        <input type="number" name="target_hp" value="{{ $activity->target_hp }}" placeholder="Target HP">
        <input type="number" name="target_spk" value="{{ $activity->target_spk }}" placeholder="Target SPK">
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fit,minmax(120px,1fr)); gap:10px;">
        <input type="number" name="actual_p" value="{{ $activity->actual_p }}" placeholder="Actual P">
        <input type="number" name="actual_hp" value="{{ $activity->actual_hp }}" placeholder="Actual HP">
        <input type="number" name="actual_spk" value="{{ $activity->actual_spk }}" placeholder="Actual SPK">
        <input type="number" name="actual_do" value="{{ $activity->actual_do }}" placeholder="Actual DO">
    </div>

    <!-- Cost -->
    <label style="font-weight:600;">Total Cost (Rp)</label>
    <input type="number" name="total_cost" value="{{ $activity->total_cost }}"
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">

    <!-- Keterangan -->
    <label style="font-weight:600;">Keterangan</label>
    <textarea name="keterangan" rows="3"
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">{{ $activity->keterangan }}</textarea>

    <!-- Tombol -->
    <div style="display:flex; justify-content:space-between; margin-top:15px;">
        <a href="{{ route('activity.index') }}"
            style="padding:10px 20px; border-radius:8px; border:1px solid #999; color:#111; text-decoration:none;">
            Kembali
        </a>
        <button type="submit"
            style="background:#111; color:white; padding:10px 22px; border:none; border-radius:8px;">
            Update Activity
        </button>
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

    function updateTypeUnit(selected = null) {
        const options = typeUnits[jenisSelect.value] || [];
        typeSelect.innerHTML = '';
        options.forEach(type => {
            const opt = document.createElement('option');
            opt.value = type;
            opt.textContent = type.replace(/_/g,' ');
            if (selected === type) opt.selected = true;
            typeSelect.appendChild(opt);
        });
    }

    updateTypeUnit(typeSelect.dataset.current);
    jenisSelect.addEventListener('change', () => updateTypeUnit());
});
</script>
