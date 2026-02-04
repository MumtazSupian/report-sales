<h2 style="text-align:center; font-weight:700; color:#111; margin-bottom:25px;">
    Edit Activity Plan
</h2>

<div style="
    max-width:750px;
    margin:0 auto;
    background:#fdfdfd;
    border-radius:16px;
    box-shadow:0 4px 20px rgba(0,0,0,0.08);
    padding:30px 40px;
    font-family:'Segoe UI',sans-serif;
    color:#222;
">

<form action="{{ route('activity.activity.update', $activity->id) }}" method="POST">
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
            <option value="D_MARKETING" {{ $activity->activity == 'D_MARKETING' ? 'selected' : '' }}>D. MARKETING</option>
            <option value="EXHIBITION" {{ $activity->activity == 'EXHIBITION' ? 'selected' : '' }}>EXHIBITION</option>
            <option value="MOVING_EXHIBITION" {{ $activity->activity == 'MOVING_EXHIBITION' ? 'selected' : '' }}>MOVING EXHIBITION</option>
            <option value="SHOWROOM_EVENT" {{ $activity->activity == 'SHOWROOM_EVENT' ? 'selected' : '' }}>SHOWROOM EVENT</option>
            <option value="GROUP_PRESENTATION" {{ $activity->activity == 'GROUP_PRESENTATION' ? 'selected' : '' }}>GROUP PRESENTATION</option>
            <option value="EVENT_TEST_DRIVE" {{ $activity->activity == 'EVENT_TEST_DRIVE' ? 'selected' : '' }}>EVENT TEST DRIVE</option>
            <option value="OPEN_TABLE" {{ $activity->activity == 'OPEN_TABLE' ? 'selected' : '' }}>OPEN TABLE</option>
            <option value="CETAK_FLYER" {{ $activity->activity == 'CETAK_FLYER' ? 'selected' : '' }}>CETAK FLYER</option>
        </select>
    </div>

    <!-- Platform -->
    <div>
        <label style="font-weight:600;">Platform / Lokasi</label>
        <input type="text" name="platform_lokasi" value="{{ $activity->platform_lokasi }}" 
            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
    </div>

    <!-- Jenis & Type Unit -->
    <hr style="border:none; border-top:1px dashed #bbb; margin:15px 0;">
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
            <select id="type_unit" name="type_unit" data-current="{{ $activity->type_unit }}" 
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                <!-- Opsi otomatis dari JS -->
            </select>
        </div>
    </div>

    <!-- Lanjut isi form kamu di bawah ini sama seperti create -->
    <!-- (tanggal, jam, pic, target, actual, cost, dsb) -->
    <!-- ... -->
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

    function updateTypeUnit(selectedType = null) {
        const selectedJenis = jenisSelect.value;
        const options = typeUnits[selectedJenis] || [];
        typeSelect.innerHTML = '';

        options.forEach(type => {
            const opt = document.createElement('option');
            opt.value = type;
            opt.textContent = type.replace(/_/g, ' ');
            if (selectedType === type) opt.selected = true;
            typeSelect.appendChild(opt);
        });
    }

    updateTypeUnit(typeSelect.getAttribute('data-current'));
    jenisSelect.addEventListener('change', () => updateTypeUnit());
});
</script>
