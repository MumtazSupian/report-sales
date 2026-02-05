<h2 style="
    text-align:center; 
    font-weight:800; 
    color:#0d3b66; 
    letter-spacing:0.5px;
    text-transform:uppercase;
    margin-bottom:10px;
">
    ACTUAL MARKETING ACTIVITY
</h2>

<div style="
    display:flex; 
    justify-content:flex-end; 
    align-items:center; 
    gap:8px; 
    margin:0 auto 0 auto; 
    width:96%;  
    max-width:1600px; 
">

    <a href="{{ route('activity.create') }}"
        style="
            padding:6px 12px; 
            background:#1e88e5; 
            color:#fff; 
            border-radius:6px; 
            font-size:13px;
            font-weight:600; 
            text-decoration:none;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
            transition:background 0.3s;
        "
        onmouseover="this.style.background='#1565c0'"
        onmouseout="this.style.background='#1e88e5'">
        Tambah Data
    </a>

    <a href="{{ url('/activity/dashboard') }}"
        style="
            padding:6px 12px; 
            background:#6c757d; 
            color:#fff; 
            border-radius:6px; 
            font-size:13px;
            font-weight:600; 
            text-decoration:none;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
            transition:background 0.3s;
        "
        onmouseover="this.style.background='#5a6268'"
        onmouseout="this.style.background='#6c757d'">
        Kembali ke Dashboard
    </a>
</div>


<div style="
    background:#fff;
    padding:25px;
    border-radius:14px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
    overflow-x:auto;
">

<table width="100%" cellpadding="8" cellspacing="0"
    style="
        width:100%; 
        border-collapse:collapse; 
        font-family:'Segoe UI',sans-serif; 
        font-size:13px; 
        text-align:center;
        border:1px solid #bbb;
    ">

    <!-- HEADER -->
    <thead style="background:#e3f2fd; color:#0d47a1;">
        <tr style="border-bottom:2px solid #90caf9;">
            <th rowspan="2" style="border:1px solid #999;">NO</th>
            <th rowspan="2" style="border:1px solid #999;">JENIS ACTIVITY</th>
            <th rowspan="2" style="border:1px solid #999;">ACTIVITY</th>
            <th rowspan="2" style="border:1px solid #999;">PLATFORM/LOKASI</th>
            <th colspan="2" style="border:1px solid #999;">UPLOAD KONTEN DISPLAY</th>
            <th colspan="2" style="border:1px solid #999;">WAKTU PELAKSANAAN</th>
            <th rowspan="2" style="border:1px solid #999;">PIC</th>
            <th rowspan="2" style="border:1px solid #999;">JML SALES<br>PER SHIFT</th>
            <th colspan="3" style="border:1px solid #999;">TARGET</th>
            <th colspan="4" style="border:1px solid #999;">ACTUAL SD AKHIR BULAN</th>
            <th rowspan="2" style="border:1px solid #999;">TOTAL COST</th>
            <th rowspan="2" style="border:1px solid #999;">COST/P</th>
            <th rowspan="2" style="border:1px solid #999;">COST/SPK</th>
            <th rowspan="2" style="border:1px solid #999;">COST/DO</th>
            <th rowspan="2" style="border:1px solid #999;">KETERANGAN</th>
            <th rowspan="2" style="border:1px solid #999;">AKSI</th>
        </tr>

        <tr style="background:#bbdefb; border-bottom:2px solid #90caf9;">
            <th style="border:1px solid #999;">Jenis Unit</th>
            <th style="border:1px solid #999;">Type Unit</th>
            <th style="border:1px solid #999;">Tanggal</th>
            <th style="border:1px solid #999;">Jam</th>
            <th style="border:1px solid #999;">P</th>
            <th style="border:1px solid #999;">HP</th>
            <th style="border:1px solid #999;">SPK</th>
            <th style="border:1px solid #999;">P</th>
            <th style="border:1px solid #999;">HP</th>
            <th style="border:1px solid #999;">SPK</th>
            <th style="border:1px solid #999;">DO</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $item)
        <tr 
            style="
                background:{{ $loop->iteration % 2 == 0 ? '#f7f9fb' : '#ffffff' }};
                border-bottom:1px solid #ccc;
                transition:background 0.2s;
            "
            onmouseover="this.style.background='#e8f0fe'"
            onmouseout="this.style.background='{{ $loop->iteration % 2 == 0 ? '#f7f9fb' : '#ffffff' }}'">
            
            <td style="border:1px solid #bbb;">{{ $loop->iteration }}</td>
            <td style="border:1px solid #bbb;">{{ ucfirst($item->jenis_activity) }}</td>

            <td style="border:1px solid #bbb;">
                @switch($item->activity)
                    @case('D_MARKETING') D. MARKETING @break
                    @case('EXHIBITION') EXHIBITION @break
                    @case('MOVING_EXHIBITION') MOVING EXHIBITION @break
                    @case('SHOWROOM_EVENT') SHOWROOM EVENT @break
                    @case('GROUP_PRESENTATION') GROUP PRESENTATION @break
                    @case('EVENT_TEST_DRIVE') EVENT TEST DRIVE @break
                    @case('OPEN_TABLE') OPEN TABLE @break
                    @case('CETAK_FLYER') CETAK FLYER @break
                @endswitch
            </td>

            <td style="border:1px solid #bbb;">{{ $item->platform_lokasi }}</td>

            <td style="border:1px solid #bbb;">{{ ucfirst($item->jenis_unit) }}</td>
            <td style="border:1px solid #bbb;">{{ str_replace('_', ' ', $item->type_unit) }}</td>

            <td style="border:1px solid #bbb;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
            <td style="border:1px solid #bbb;">{{ \Carbon\Carbon::parse($item->jam)->format('g:i A') }}</td>

            <td style="border:1px solid #bbb;">{{ ucfirst($item->pic) }}</td>
            <td style="border:1px solid #bbb;">{{ $item->jml_sales_shift }}</td>

            <td style="border:1px solid #bbb;">{{ $item->target_p }}</td>
            <td style="border:1px solid #bbb;">{{ $item->target_hp }}</td>
            <td style="border:1px solid #bbb;">{{ $item->target_spk }}</td>

            <td style="border:1px solid #bbb;">{{ $item->actual_p }}</td>
            <td style="border:1px solid #bbb;">{{ $item->actual_hp }}</td>
            <td style="border:1px solid #bbb;">{{ $item->actual_spk }}</td>
            <td style="border:1px solid #bbb;">{{ $item->actual_do }}</td>

            <td style="border:1px solid #bbb; font-weight:600;">
                Rp {{ number_format($item->total_cost, 0, ',', '.') }}
            </td>
            <td style="border:1px solid #bbb;">
                {{ $item->cost_p > 0 ? 'Rp ' . number_format($item->cost_p, 0, ',', '.') : '-' }}
            </td>
            <td style="border:1px solid #bbb;">
                {{ $item->cost_spk > 0 ? 'Rp ' . number_format($item->cost_spk, 0, ',', '.') : '-' }}
            </td>
            <td style="border:1px solid #bbb;">
                {{ $item->cost_do > 0 ? 'Rp ' . number_format($item->cost_do, 0, ',', '.') : '-' }}
            </td>

            <td style="border:1px solid #bbb;">{{ $item->keterangan }}</td>

            <td style="border:1px solid #bbb;">
                <a href="{{ route('activity.edit', $item->id) }}" 
                    style="
                        color:#1976d2; 
                        font-weight:600; 
                        text-decoration:none;
                        margin-right:6px;
                    ">
                    Edit
                </a>

                <form action="{{ route('activity.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Yakin hapus data ini?')"
                        style="
                            background:#e53935; 
                            color:white; 
                            border:none; 
                            padding:5px 10px; 
                            border-radius:6px;
                            font-weight:600; 
                            cursor:pointer;
                            transition:background 0.3s;
                        "
                        onmouseover="this.style.background='#c62828'"
                        onmouseout="this.style.background='#e53935'">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

            @php
        // Hitung total semua kolom yang perlu dijumlahkan
        $total_target_p = $data->sum('target_p');
        $total_target_hp = $data->sum('target_hp');
        $total_target_spk = $data->sum('target_spk');

        $total_actual_p = $data->sum('actual_p');
        $total_actual_hp = $data->sum('actual_hp');
        $total_actual_spk = $data->sum('actual_spk');
        $total_actual_do = $data->sum('actual_do');

        $grand_total_cost = $data->sum('total_cost');
        $grand_cost_p = $data->sum('cost_p');
        $grand_cost_spk = $data->sum('cost_spk');
        $grand_cost_do = $data->sum('cost_do');
    @endphp

    <!-- BARIS GRAND TOTAL -->
    <tr style="background:#0d47a1; color:white; font-weight:bold;">
        <td colspan="10" style="text-align:center; border:1px solid #999;">GRAND TOTAL</td>

        <!-- TARGET -->
        <td style="border:1px solid #999;">{{ $total_target_p }}</td>
        <td style="border:1px solid #999;">{{ $total_target_hp }}</td>
        <td style="border:1px solid #999;">{{ $total_target_spk }}</td>

        <!-- ACTUAL -->
        <td style="border:1px solid #999;">{{ $total_actual_p }}</td>
        <td style="border:1px solid #999;">{{ $total_actual_hp }}</td>
        <td style="border:1px solid #999;">{{ $total_actual_spk }}</td>
        <td style="border:1px solid #999;">{{ $total_actual_do }}</td>

        <!-- COST -->
        <td style="border:1px solid #999;">
            Rp {{ number_format($grand_total_cost, 0, ',', '.') }}
        </td>
        <td style="border:1px solid #999;">
            Rp {{ number_format($grand_cost_p, 0, ',', '.') }}
        </td>
        <td style="border:1px solid #999;">
            Rp {{ number_format($grand_cost_spk, 0, ',', '.') }}
        </td>
        <td style="border:1px solid #999;">
            Rp {{ number_format($grand_cost_do, 0, ',', '.') }}
        </td>

        <!-- KETERANGAN & AKSI KOSONG -->
        <td colspan="2" style="border:1px solid #999; text-align:center;">-</td>
    </tr>

    </tbody>
</table>
</div>
