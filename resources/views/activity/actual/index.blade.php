@extends('layouts.app')
@section('title', 'Marketing Activity Actual')
@section('content')
    <div style="padding: 20px;">
        <h2 style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:20px;">
            ACTIVITY ACTUAL
        </h2>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; padding: 0 10px;">
            <div style="display:flex; gap:10px; align-items:center;">
                <a href="{{ url('/activity/dashboard') }}"
                    style="padding: 8px 15px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.2); transition: 0.3s;">
                    ← Dashboard
                </a>
                <a href="{{ route('activity.actual.index') }}"
                    style="padding: 8px 15px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;">
                    🔄 Refresh
                </a>
                <a href="{{ route('activity.actual.excel') }}"
                    style="padding: 8px 15px; background: #276749; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid #2f855a; transition: 0.3s; margin-left: 5px;">
                    📊 Excel
                </a>
                <a href="{{ route('activity.actual.pdf') }}"
                    style="padding: 8px 15px; background: #e53e3e; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; margin-left: 5px;">
                    📄 PDF
                </a>
            </div>

            <a href="{{ route('activity.actual.create') }}"
                style="padding: 8px 18px; background: #3182ce; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 12px; box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3); transition: 0.3s;">
                + TAMBAH DATA
            </a>
        </div>

        <div style="background:#fff; padding:15px; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,0.15);">
            <table style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:9px; text-align:center; border:1px solid #000;">
                <thead style="background:#e3f2fd; color:#0d47a1; font-weight: bold;">
                    <tr style="border-bottom: 2px solid #000;">
                        <th rowspan="2" style="border: 1px solid #000;">NO</th>
                        <th rowspan="2" style="border: 1px solid #000;">CABANG</th>
                        <th rowspan="2" style="border: 1px solid #000;">JENIS<br>ACTIVITY</th>
                        <th rowspan="2" style="border: 1px solid #000;">ACTIVITY</th>
                        <th rowspan="2" style="border: 1px solid #000;">PLATFORM/LOKASI</th>
                        <th colspan="2" style="border: 1px solid #000;">UPLOAD KONTEN/DISPLAY</th>
                        <th colspan="2" style="border: 1px solid #000;">WAKTU PELAKSANAAN</th>
                        <th rowspan="2" style="border: 1px solid #000;">PIC</th>
                        <th rowspan="2" style="border: 1px solid #000;">JML SALES<br>PER SHIFT</th>
                        <th colspan="3" style="border: 1px solid #000;">TARGET</th>
                        <th colspan="4" style="border: 1px solid #000;">ACTUAL</th>
                        <th rowspan="2" style="border: 1px solid #000;">TOTAL COST</th>
                        <th rowspan="2" style="border: 1px solid #000;">COST/P</th>
                        <th rowspan="2" style="border: 1px solid #000;">COST/SPK</th>
                        <th rowspan="2" style="border: 1px solid #000;">COST/DO</th>
                        <th rowspan="2" style="border: 1px solid #000;">KETERANGAN</th>
                        <th rowspan="2" style="border: 1px solid #000;">AKSI</th>
                    </tr>
                    <tr style="border-bottom: 2px solid #000;">
                        <th style="border: 1px solid #000;">Jenis Unit</th>
                        <th style="border: 1px solid #000;">Type Unit</th>
                        <th style="border: 1px solid #000;">Tanggal</th>
                        <th style="border: 1px solid #000;">Jam</th>
                        <th style="border: 1px solid #000;">P</th>
                        <th style="border: 1px solid #000;">HP</th>
                        <th style="border: 1px solid #000;">SPK</th>
                        <th style="border: 1px solid #000;">P</th>
                        <th style="border: 1px solid #000;">HP</th>
                        <th style="border: 1px solid #000;">SPK</th>
                        <th style="border: 1px solid #000;">DO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr style="background:#fff; border-bottom: 1px solid #000;">
                            <td style="border: 1px solid #000; padding: 5px 2px;">{{ $loop->iteration }}</td>
                            <td style="border: 1px solid #000;">{{ $item->cabang }}</td>
                            <td style="border: 1px solid #000;">{{ $item->jenis_activity }}</td>
                            <td style="border: 1px solid #000; text-align: left; padding: 2px;">{{ $item->activity }}</td>
                            <td style="border: 1px solid #000;">{{ $item->platform_lokasi }}</td>
                            <td style="border: 1px solid #000;">{{ $item->jenis_unit }}</td>
                            <td style="border: 1px solid #000;">{{ $item->type_unit }}</td>
                            <td style="border: 1px solid #000;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/y') }}</td>
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
                            <td style="border: 1px solid #000;">Rp{{ number_format($item->cost_do, 0, ',', '.') }}</td>
                            <td style="border: 1px solid #000; text-align: left; padding: 2px;">{{ $item->keterangan }}</td>
                            <td style="border: 1px solid #000; padding: 5px;">
                                <a href="{{ route('activity.actual.edit', $item->id) }}" style="background: #3182ce; color:white; padding: 2px 5px; border-radius: 4px; font-size: 10px; text-decoration:none; font-weight:700; margin-right:2px; text-transform: uppercase;">EDIT</a>
                                <form action="{{ route('activity.actual.destroy', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $item->id }}')" style="background:#fff5f5; color:#e53e3e; border:1px solid #feb2b2; padding: 2px 5px; border-radius:4px; font-size: 10px; cursor:pointer; font-weight:700; text-transform: uppercase;">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:#0d47a1; color:white; font-weight:bold;">
                    <tr style="border-top: 2px solid #000;">
                        <td colspan="10" style="border: 1px solid #000; padding: 5px;">GRAND TOTAL</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('jml_sales_shift') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('target_p') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('target_hp') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('target_spk') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('actual_p') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('actual_hp') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('actual_spk') }}</td>
                        <td style="border: 1px solid #000;">{{ $data->sum('actual_do') }}</td>
                        <td style="border: 1px solid #000;">Rp{{ number_format($data->sum('total_cost'), 0, ',', '.') }}</td>
                        <td style="border: 1px solid #000;">Rp{{ $data->sum('actual_p') > 0 ? number_format($data->sum('total_cost') / $data->sum('actual_p'), 0, ',', '.') : '0' }}</td>
                        <td style="border: 1px solid #000;">Rp{{ $data->sum('actual_spk') > 0 ? number_format($data->sum('total_cost') / $data->sum('actual_spk'), 0, ',', '.') : '0' }}</td>
                        <td style="border: 1px solid #000;">Rp{{ $data->sum('actual_do') > 0 ? number_format($data->sum('total_cost') / $data->sum('actual_do'), 0, ',', '.') : '0' }}</td>
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
