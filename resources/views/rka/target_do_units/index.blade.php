@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 1300px; margin: 0 auto;">
        <h2 style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:5px;">
            🚗 TARGET DO UNITS
        </h2>
        <p style="text-align:center; color: #cbd5e0; margin-bottom:20px; font-size: 14px;">Manajemen rencana tahunan penjualan unit per tipe mobil</p>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; padding: 0 10px;">
            <div style="display:flex; gap:10px; align-items:center;">
                <a href="{{ url('/rka/dashboard') }}"
                    style="padding: 8px 15px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.2); transition: 0.3s;">
                    ← Dashboard
                </a>
                <a href="{{ route('rka.target-do-units.index') }}"
                    style="padding: 8px 15px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;">
                    🔄 Refresh
                </a>
            </div>

            <a href="{{ route('rka.target-do-units.create') }}"
                style="padding: 8px 18px; background: #3182ce; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 12px; box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3); transition: 0.3s;">
                + TAMBAH DATA
            </a>
        </div>

        <div style="background:#fff; padding:15px; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.3); overflow-x:auto;">
            @php
                $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
                $grandTotals = [];
                foreach ($months as $m) { $grandTotals[$m] = $data->sum($m); }
                $grandTotalAll = $data->sum('total');
            @endphp

            <table width="100%" cellpadding="0" cellspacing="0"
                style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:11px; text-align:center; border:1px solid #bbb;">
                <thead style="background:#e3f2fd; color:#0d47a1;">
                    <tr style="border-bottom:2px solid #90caf9;">
                        <th style="border:1px solid #999; padding: 12px; text-align: left;">MOBIL TYPE</th>
                        <th style="border:1px solid #999; width: 60px;">TAHUN</th>
                        @foreach ($months as $m)
                            <th style="border:1px solid #999; width: 45px;">{{ strtoupper($m) }}</th>
                        @endforeach
                        <th style="border:1px solid #999; background:#bbdefb; width: 65px;">TOTAL</th>
                        <th style="border:1px solid #999; width: 110px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr style="background:{{ $loop->iteration % 2 == 0 ? '#f7faff' : '#ffffff' }}; border-bottom:1px solid #ccc;">
                            <td style="border:1px solid #bbb; font-weight:600; text-align:left; padding-left:12px;">{{ $row->mobil_type }}</td>
                            <td style="border:1px solid #bbb;">{{ $row->tahun }}</td>
                            @foreach ($months as $m)
                                <td style="border:1px solid #bbb;">{{ number_format($row->$m, 0, ',', '.') }}</td>
                            @endforeach
                            <td style="border:1px solid #bbb; font-weight: 800; background:#ebf5ff;">{{ number_format($row->total, 0, ',', '.') }}</td>
                            <td style="border:1px solid #bbb; padding: 6px;">
                                <div style="display: flex; gap: 4px; justify-content: center;">
                                    <a href="{{ route('rka.target-do-units.edit', $row->id) }}" 
                                       style="padding: 4px 8px; background: #3182ce; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 700; font-size: 10px;">
                                       EDIT
                                    </a>
                                    <form action="{{ route('rka.target-do-units.destroy', $row->id) }}" 
                                          method="POST" 
                                          id="delete-form-{{ $row->id }}" 
                                          style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>

                                    <button type="button" onclick="confirmDelete('{{ $row->id }}', '{{ $row->mobil_type }}')"
                                            style="padding: 4px 8px; background: #fff5f5; color: #e53e3e; border: 1px solid #fed7d7; border-radius: 4px; font-weight: 700; font-size: 10px; cursor: pointer;">
                                        HAPUS
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:#0d47a1; color:white; font-weight:bold;">
                    <tr>
                        <td colspan="2" style="border:1px solid #999; padding: 10px; text-align: center;">GRAND TOTAL</td>
                        @foreach ($months as $m)
                            <td style="border:1px solid #999;">{{ number_format($grandTotals[$m], 0, ',', '.') }}</td>
                        @endforeach
                        <td style="border:1px solid #999; background:#0d47a1;">{{ number_format($grandTotalAll, 0, ',', '.') }}</td>
                        <td style="border:1px solid #999;">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Target ' + name + '?',
                text: "Data target unit ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'YA, HAPUS',
                confirmButtonColor: '#3182ce',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#e53e3e', 
                reverseButtons: false,
                customClass: { popup: 'rounded-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection