@extends('layouts.app')

@section('title', 'Actual DO Salesforce')

@section('content')
    <div style="padding: 20px;">
        <h2 style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:5px;">
            👥 ACTUAL DO SALESFORCE
        </h2>
        <p style="text-align:center; color: #8fb3d9; margin-bottom:20px;">Monitoring pencapaian delivery order berdasarkan grading salesforce</p>

        <div style="display:flex; justify-content:space-between; align-items:center; gap:8px; margin:0 auto 15px auto; width:98%;">
            <div style="display:flex; gap:10px; align-items:center;">
                <a href="{{ url('/current/dashboard') }}"
                    style="padding:8px 16px; background:#6c757d; color:#fff; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 2px 5px rgba(0,0,0,0.1); transition:0.3s;"
                    onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                    ⬅ Kembali
                </a>

                <a href="{{ route('current.actual-do-salesforces.index') }}"
                    style="padding:8px 16px; background:#f8f9fa; color:#333; border: 1px solid #ddd; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none; transition:0.3s; box-shadow:0 2px 5px rgba(0,0,0,0.05);"
                    onmouseover="this.style.background='#e2e6ea'" onmouseout="this.style.background='#f8f9fa'">
                    🔄 Refresh
                </a>
            </div>

            <a href="{{ route('current.actual-do-salesforces.create') }}"
                style="padding:8px 16px; background:#1e88e5; color:#fff; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 2px 5px rgba(0,0,0,0.1); transition:0.3s;"
                onmouseover="this.style.background='#1565c0'" onmouseout="this.style.background='#1e88e5'">
                + Tambah Data
            </a>
        </div>

        {{-- SweetAlert2 Library --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: { popup: 'rounded-4' }
                });
            </script>
        @endif

        <div style="background:#fff; padding:20px; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,0.08); overflow-x:auto;">
            @php
                $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

                // Menghitung grand total per bulan untuk footer yang lebih informatif
                $grandTotals = [];
                foreach ($months as $m) {
                    $grandTotals[$m] = $data->sum($m);
                }
                $grandTotalAll = $data->sum('total');
            @endphp

            <table width="100%" cellpadding="8" cellspacing="0"
                style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:12px; text-align:center; border:1px solid #bbb;">
                <thead style="background:#e3f2fd; color:#0d47a1;">
                    <tr style="border-bottom:2px solid #90caf9;">
                        <th style="border:1px solid #999;">GRADING</th>
                        <th style="border:1px solid #999;">TAHUN</th>
                        @foreach ($months as $m)
                            <th style="border:1px solid #999;">{{ strtoupper($m) }}</th>
                        @endforeach
                        <th style="border:1px solid #999; background:#bbdefb;">TOTAL</th>
                        <th style="border:1px solid #999;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr style="background:{{ $loop->iteration % 2 == 0 ? '#f7f9fb' : '#ffffff' }}; border-bottom:1px solid #ccc;">
                            <td style="border:1px solid #bbb; font-weight:700; text-align:left; padding-left:15px;">
                                <span style="color: #0d47a1;">{{ $row->grading }}</span>
                            </td>
                            <td style="border:1px solid #bbb;">{{ $row->tahun }}</td>

                            @foreach ($months as $m)
                                <td style="border:1px solid #bbb;">{{ number_format($row->$m, 0, ',', '.') }}</td>
                            @endforeach

                            <td style="border:1px solid #bbb; font-weight: 800; background:#f0f7ff;">
                                {{ number_format($row->total, 0, ',', '.') }}
                            </td>

                            <td style="border:1px solid #bbb; white-space:nowrap;">
                                <a href="{{ route('current.actual-do-salesforces.edit', $row->id) }}"
                                    style="color:#1976d2; font-weight:600; text-decoration:none; margin-right:8px;">Edit</a>

                                <form action="{{ route('current.actual-do-salesforces.destroy', $row->id) }}"
                                    method="POST" style="display:inline;" id="delete-form-{{ $row->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $row->id }}')"
                                        style="background:#e53935; color:white; border:none; padding:4px 8px; border-radius:4px; font-size:11px; cursor:pointer; transition:0.2s;"
                                        onmouseover="this.style.background='#b71c1c'"
                                        onmouseout="this.style.background='#e53935'">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:#0d47a1; color:white; font-weight:bold;">
                    <tr>
                        <td colspan="2" style="border:1px solid #999; text-align: center; letter-spacing:1px;">GRAND TOTAL</td>
                        @foreach ($months as $m)
                            <td style="border:1px solid #999;">{{ number_format($grandTotals[$m], 0, ',', '.') }}</td>
                        @endforeach
                        <td style="border:1px solid #999; background:#1565c0;">
                            {{ number_format($grandTotalAll, 0, ',', '.') }}
                        </td>
                        <td style="border:1px solid #999;">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pencapaian salesforce ini akan dihapus permanen!",
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
