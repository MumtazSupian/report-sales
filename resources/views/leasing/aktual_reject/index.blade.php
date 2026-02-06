@extends('layouts.app')

@section('title', 'Aktual Reject')

@section('content')
    {{-- Container Utama dipersempit ke max-width 1200px agar tidak terlalu lebar --}}
    <div style="padding: 20px; max-width: 1250px; margin: 0 auto;">
        
        <h2 style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:5px;">
            📉 AKTUAL REJECT
        </h2>
        <p style="text-align:center; color: #8fb3d9; margin-bottom:20px; font-size: 14px;">Monitoring data aktual penolakan (reject) aplikasi berdasarkan leasing</p>

        {{-- Baris Tombol Atas --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <div style="display:flex; gap:10px; align-items:center;">
                <a href="{{ url('/leasing/dashboard') }}"
                    style="padding: 8px 16px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.2); transition: 0.3s;">
                    ← Dashboard
                </a>

                <a href="{{ route('leasing.aktual-reject.index') }}"
                    style="padding: 8px 16px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 12px; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;">
                    🔄 Refresh
                </a>
            </div>

            <a href="{{ route('leasing.aktual-reject.create') }}"
                style="padding: 8px 16px; background: #3182ce; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 12px; box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3); transition: 0.3s;">
                + TAMBAH DATA
            </a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <div style="background:#fff; padding:15px; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,0.15); overflow-x:auto;">
            @php
                $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
                $grandTotals = [];
                foreach ($months as $m) { $grandTotals[$m] = $data->sum($m); }
                $grandTotalAll = $data->sum('total');
            @endphp

            {{-- Tabel paman tetap dengan border-1px --}}
            <table width="100%" cellpadding="6" cellspacing="0"
                style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:11px; text-align:center; border:1px solid #bbb;">
                <thead style="background:#fce4ec; color:#880e4f;">
                    <tr style="border-bottom:2px solid #f48fb1;">
                        <th style="border:1px solid #999; padding: 10px;">LEASING NAME</th>
                        <th style="border:1px solid #999;">TAHUN</th>
                        @foreach ($months as $m)
                            <th style="border:1px solid #999; width: 50px;">{{ strtoupper($m) }}</th>
                        @endforeach
                        <th style="border:1px solid #999; background:#f8bbd0; width: 70px;">TOTAL</th>
                        <th style="border:1px solid #999; width: 120px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr style="background:{{ $loop->iteration % 2 == 0 ? '#fff9fb' : '#ffffff' }}; border-bottom:1px solid #ccc;">
                            <td style="border:1px solid #bbb; font-weight:600; text-align:left; padding-left:10px;">{{ $row->leasing }}</td>
                            <td style="border:1px solid #bbb;">{{ $row->tahun }}</td>
                            @foreach ($months as $m)
                                <td style="border:1px solid #bbb;">{{ number_format($row->$m, 0, ',', '.') }}</td>
                            @endforeach
                            <td style="border:1px solid #bbb; font-weight: 800; background:#fff0f3;">{{ number_format($row->total, 0, ',', '.') }}</td>
                            
                            <td style="border:1px solid #bbb; white-space:nowrap; padding: 5px;">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="{{ route('leasing.aktual-reject.edit', $row->id) }}" 
                                       style="padding: 4px 8px; background: #3182ce; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 700; font-size: 10px;">
                                       EDIT
                                    </a>
                                    <form action="{{ route('leasing.aktual-reject.destroy', $row->id) }}" method="POST" id="delete-form-{{ $row->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $row->id }}', '{{ $row->leasing }}')"
                                                style="padding: 4px 10px; background: #fff5f5; color: #e53e3e; border: 1px solid #fed7d7; border-radius: 4px; font-weight: 700; font-size: 10px; cursor: pointer;">
                                            HAPUS
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:#c2185b; color:white; font-weight:bold;">
                    <tr>
                        <td colspan="2" style="border:1px solid #999; padding: 10px;">GRAND TOTAL</td>
                        @foreach ($months as $m)
                            <td style="border:1px solid #999;">{{ number_format($grandTotals[$m], 0, ',', '.') }}</td>
                        @endforeach
                        <td style="border:1px solid #999; background:#ad1457;">{{ number_format($grandTotalAll, 0, ',', '.') }}</td>
                        <td style="border:1px solid #999;">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus data ' + name + '?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: { popup: 'rounded-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection