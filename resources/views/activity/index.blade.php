@extends('layouts.app')

@section('title', 'Marketing Activity Report')

@section('content')
<div style="padding: 20px;">
    <h2 style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:20px;">
        ACTUAL MARKETING ACTIVITY
    </h2>

    <div style="display:flex; justify-content:flex-end; align-items:center; gap:8px; margin-bottom:15px;">
        <a href="{{ route('activity.index') }}"
            style="padding: 8px 15px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.1);">
            🔄 Refresh
        </a>
        <a href="{{ route('activity.create') }}"
            style="padding:8px 16px; background:#1e88e5; color:#fff; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none;">
            + TAMBAH DATA
        </a>
    </div>

    <div style="background:#fff; padding:15px; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,0.15);">
        <table style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:10px; text-align:center; border: 1px solid #000;">
            <thead style="background:#e3f2fd; color:#0d47a1; font-weight: bold;">
                <tr style="border-bottom: 2px solid #000;">
                    <th rowspan="2" style="border: 1px solid #000; padding: 10px 2px; width: 30px;">NO</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 110px;">JENIS ACTIVITY</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 150px;">ACTIVITY</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 140px;">PLATFORM/LOKASI</th>
                    <th colspan="2" style="border: 1px solid #000;">UPLOAD KONTEN/DISPLAY</th>
                    <th colspan="2" style="border: 1px solid #000;">WAKTU PELAKSANAAN</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 90px;">PIC</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 60px;">JML SALES/PER SHIFT</th>
                    <th colspan="3" style="border: 1px solid #000;">TARGET</th>
                    <th colspan="4" style="border: 1px solid #000;">ACTUAL</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 90px;">TOTAL COST</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 80px;">COST/P</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 80px;">COST/SPK</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 130px;">KETERANGAN</th>
                    <th rowspan="2" style="border: 1px solid #000; width: 100px;">AKSI</th>
                </tr>
                <tr style="border-bottom: 2px solid #000;">
                    <th style="border: 1px solid #000; width: 70px;">Jenis Unit</th>
                    <th style="border: 1px solid #000; width: 70px;">Type Unit</th>
                    <th style="border: 1px solid #000; width: 65px;">Tanggal</th>
                    <th style="border: 1px solid #000; width: 45px;">Jam</th>
                    <th style="border: 1px solid #000; width: 30px;">P</th>
                    <th style="border: 1px solid #000; width: 30px;">HP</th>
                    <th style="border: 1px solid #000; width: 30px;">SPK</th>
                    <th style="border: 1px solid #000; width: 30px;">P</th>
                    <th style="border: 1px solid #000; width: 30px;">HP</th>
                    <th style="border: 1px solid #000; width: 30px;">SPK</th>
                    <th style="border: 1px solid #000; width: 30px;">DO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr style="background:#fff; border-bottom: 1px solid #000;">
                    <td style="border: 1px solid #000; padding: 8px 2px;">{{ $loop->iteration }}</td>
                    <td style="border: 1px solid #000;">{{ $item->jenis_activity }}</td>
                    <td style="border: 1px solid #000; text-align: left; padding: 5px;">{{ $item->activity }}</td>
                    <td style="border: 1px solid #000;">{{ $item->platform_lokasi }}</td>
                    <td style="border: 1px solid #000;">{{ $item->jenis_unit }}</td>
                    <td style="border: 1px solid #000;">{{ $item->type_unit }}</td>
                    <td style="border: 1px solid #000;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td style="border: 1px solid #000;">{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                    <td style="border: 1px solid #000;">{{ $item->pic }}</td>
                    <td style="border: 1px solid #000; font-weight: bold;">{{ $item->jml_sales_shift }}</td>
                    <td style="border: 1px solid #000;">{{ $item->target_p }}</td>
                    <td style="border: 1px solid #000;">{{ $item->target_hp }}</td>
                    <td style="border: 1px solid #000;">{{ $item->target_spk }}</td>
                    <td style="border: 1px solid #000;">{{ $item->actual_p }}</td>
                    <td style="border: 1px solid #000;">{{ $item->actual_hp }}</td>
                    <td style="border: 1px solid #000;">{{ $item->actual_spk }}</td>
                    <td style="border: 1px solid #000;">{{ $item->actual_do }}</td>
                    <td style="border: 1px solid #000;">Rp{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                    <td style="border: 1px solid #000;">Rp{{ number_format($item->cost_p, 0, ',', '.') }}</td>
                    <td style="border: 1px solid #000;">Rp{{ number_format($item->cost_spk, 0, ',', '.') }}</td>
                    <td style="border: 1px solid #000; text-align: left; padding: 5px;">{{ $item->keterangan }}</td>
                    <td style="border: 1px solid #000; white-space:nowrap; padding: 5px;">
                        <a href="{{ route('activity.edit', $item->id) }}" 
                           style="background: #3182ce; color:white; padding: 4px 10px; border-radius: 4px; font-size: 10px; text-decoration:none; font-weight:800; margin-right:2px; text-transform: uppercase;">EDIT</a>
                        
                        <form action="{{ route('activity.destroy', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete('{{ $item->id }}')"
                                style="background:#fff5f5; color:#e53e3e; border:1px solid #feb2b2; padding:3px 8px; border-radius:4px; font-size: 10px; cursor:pointer; font-weight:800; text-transform: uppercase;">
                                HAPUS
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="background:#0d47a1; color:white; font-weight:bold;">
                <tr style="border-top: 2px solid #000;">
                    <td colspan="9" style="border: 1px solid #000; padding: 10px;">GRAND TOTAL</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('jml_sales_shift') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('target_p') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('target_hp') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('target_spk') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('actual_p') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('actual_hp') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('actual_spk') }}</td>
                    <td style="border: 1px solid #000;">{{ $data->sum('actual_do') }}</td>
                    <td style="border: 1px solid #000;">Rp{{ number_format($data->sum('total_cost'), 0, ',', '.') }}</td>
                    <td style="border: 1px solid #000;">
                        @php $tp = $data->sum('actual_p'); @endphp
                        Rp{{ $tp > 0 ? number_format($data->sum('total_cost') / $tp, 0, ',', '.') : '0' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        @php $ts = $data->sum('actual_spk'); @endphp
                        Rp{{ $ts > 0 ? number_format($data->sum('total_cost') / $ts, 0, ',', '.') : '0' }}
                    </td>
                    <td style="border: 1px solid #000;">-</td>
                    <td style="border: 1px solid #000;">-</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3182ce',
            cancelButtonColor: '#e53e3e',
            confirmButtonText: 'YA, HAPUS',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection