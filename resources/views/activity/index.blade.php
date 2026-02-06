@extends('layouts.app')

@section('title', 'Marketing Activity Report')

@section('content')
<div style="padding: 20px;">
    <h2 style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:20px;">
        ACTUAL MARKETING ACTIVITY
    </h2>

    <div style="display:flex; justify-content:flex-end; align-items:center; gap:8px; margin:0 auto 15px auto; width:98%;">
        <a href="{{ route('activity.create') }}"
            style="padding:8px 16px; background:#1e88e5; color:#fff; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 2px 5px rgba(0,0,0,0.1); transition:0.3s;"
            onmouseover="this.style.background='#1565c0'" onmouseout="this.style.background='#1e88e5'">
            + Tambah Data
        </a>
    </div>

    <div style="background:#fff; padding:20px; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,0.08); overflow-x:auto;">
        <table width="100%" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:12px; text-align:center; border:1px solid #bbb;">
            <thead style="background:#e3f2fd; color:#0d47a1;">
                <tr style="border-bottom:2px solid #90caf9;">
                    <th rowspan="2" style="border:1px solid #999;">NO</th>
                    <th rowspan="2" style="border:1px solid #999;">JENIS ACTIVITY</th>
                    <th rowspan="2" style="border:1px solid #999;">ACTIVITY</th>
                    <th rowspan="2" style="border:1px solid #999;">PLATFORM/LOKASI</th>
                    <th colspan="2" style="border:1px solid #999;">UPLOAD KONTEN DISPLAY</th>
                    <th colspan="2" style="border:1px solid #999;">WAKTU PELAKSANAAN</th>
                    <th rowspan="2" style="border:1px solid #999;">PIC</th>
                    <th rowspan="2" style="border:1px solid #999;">JML SALES</th>
                    <th colspan="3" style="border:1px solid #999;">TARGET</th>
                    <th colspan="4" style="border:1px solid #999;">ACTUAL SD AKHIR BULAN</th>
                    <th rowspan="2" style="border:1px solid #999;">TOTAL COST</th>
                    <th rowspan="2" style="border:1px solid #999;">COST/P</th>
                    <th rowspan="2" style="border:1px solid #999;">COST/SPK</th>
                    <th rowspan="2" style="border:1px solid #999;">COST/DO</th>
                    <th rowspan="2" style="border:1px solid #999;">AKSI</th>
                </tr>
                <tr style="background:#bbdefb;">
                    <th style="border:1px solid #999;">Jenis</th>
                    <th style="border:1px solid #999;">Type</th>
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
                <tr style="background:{{ $loop->iteration % 2 == 0 ? '#f7f9fb' : '#ffffff' }}; border-bottom:1px solid #ccc;">
                    <td style="border:1px solid #bbb;">{{ $loop->iteration }}</td>
                    <td style="border:1px solid #bbb;">{{ ucfirst($item->jenis_activity) }}</td>
                    <td style="border:1px solid #bbb;">{{ str_replace('_', ' ', $item->activity) }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->platform_lokasi }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->jenis_unit }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->type_unit }}</td>
                    <td style="border:1px solid #bbb;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/y') }}</td>
                    <td style="border:1px solid #bbb;">{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->pic }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->jml_sales_shift }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->target_p }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->target_hp }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->target_spk }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->actual_p }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->actual_hp }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->actual_spk }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->actual_do }}</td>
                    <td style="border:1px solid #bbb; font-weight:600;">Rp {{ number_format($item->total_cost, 0, ',', '.') }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->cost_p > 0 ? 'Rp '.number_format($item->cost_p, 0, ',', '.') : '-' }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->cost_spk > 0 ? 'Rp '.number_format($item->cost_spk, 0, ',', '.') : '-' }}</td>
                    <td style="border:1px solid #bbb;">{{ $item->cost_do > 0 ? 'Rp '.number_format($item->cost_do, 0, ',', '.') : '-' }}</td>
                    <td style="border:1px solid #bbb; white-space:nowrap;">
                        <a href="{{ route('activity.edit', $item->id) }}" style="color:#1976d2; font-weight:600; text-decoration:none; margin-right:5px;">Edit</a>
                        <form action="{{ route('activity.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus?')" style="background:#e53935; color:white; border:none; padding:3px 7px; border-radius:4px; font-size:11px; cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="background:#0d47a1; color:white; font-weight:bold;">
                <tr>
                    <td colspan="10" style="border:1px solid #999;">GRAND TOTAL</td>
                    <td style="border:1px solid #999;">{{ $data->sum('target_p') }}</td>
                    <td style="border:1px solid #999;">{{ $data->sum('target_hp') }}</td>
                    <td style="border:1px solid #999;">{{ $data->sum('target_spk') }}</td>
                    <td style="border:1px solid #999;">{{ $data->sum('actual_p') }}</td>
                    <td style="border:1px solid #999;">{{ $data->sum('actual_hp') }}</td>
                    <td style="border:1px solid #999;">{{ $data->sum('actual_spk') }}</td>
                    <td style="border:1px solid #999;">{{ $data->sum('actual_do') }}</td>
                    <td style="border:1px solid #999;">Rp {{ number_format($data->sum('total_cost'), 0, ',', '.') }}</td>
                    <td colspan="4" style="border:1px solid #999;">-</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection