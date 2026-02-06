@extends('layouts.app')

@section('title', 'Evaluasi Wiraniaga')

@section('content')
    <div style="padding: 20px;">
        <h2
            style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:5px;">
            📊 EVALUASI WIRANIAGA
        </h2>
        <p style="text-align:center; color: #8fb3d9; margin-bottom:20px;">Monitoring kinerja wiraniaga secara periodik</p>

        <div
            style="display:flex; justify-content:flex-end; align-items:center; gap:8px; margin:0 auto 15px auto; width:98%;">
            <a href="{{ route('evaluasi.create') }}"
                style="padding:8px 16px; background:#1e88e5; color:#fff; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 2px 5px rgba(0,0,0,0.1); transition:0.3s;"
                onmouseover="this.style.background='#1565c0'" onmouseout="this.style.background='#1e88e5'">
                + Tambah Data
            </a>
        </div>

        {{-- SweetAlert2 Library --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
            </script>
        @endif

        <div
            style="background:#fff; padding:20px; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,0.08); overflow-x:auto;">
            <table width="100%" cellpadding="8" cellspacing="0"
                style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:12px; text-align:center; border:1px solid #bbb;">
                <thead style="background:#e3f2fd; color:#0d47a1;">
                    <tr style="border-bottom:2px solid #90caf9;">
                        <th style="border:1px solid #999;">NO</th>
                        <th style="border:1px solid #999;">SALES HEAD</th>
                        <th style="border:1px solid #999;">NAMA SALES</th>
                        <th style="border:1px solid #999;">TGL MASUK</th>
                        <th style="border:1px solid #999;">TGL EVALUASI</th>
                        <th style="border:1px solid #999;">GRADING</th> {{-- Kolom Baru --}}
                        <th style="border:1px solid #999;">JAN</th>
                        <th style="border:1px solid #999;">FEB</th>
                        <th style="border:1px solid #999;">MAR</th>
                        <th style="border:1px solid #999;">APR</th>
                        <th style="border:1px solid #999;">MEI</th>
                        <th style="border:1px solid #999;">JUN</th>
                        <th style="border:1px solid #999;">TOTAL</th>
                        <th style="border:1px solid #999;">EVALUASI</th>
                        <th style="border:1px solid #999;">TGL KELUAR</th>
                        <th style="border:1px solid #999;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $d)
                        <tr
                            style="background:{{ $loop->iteration % 2 == 0 ? '#f7f9fb' : '#ffffff' }}; border-bottom:1px solid #ccc;">
                            <td style="border:1px solid #bbb;">{{ $i + 1 }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->nama_sales_head }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->nama_sales }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->tanggal_masuk }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->tanggal_evaluasi }}</td>

                            {{-- Baris Grading Baru --}}
                            <td style="border:1px solid #bbb;">
                                <span
                                    style="padding: 2px 8px; border-radius: 4px; color: #fff; font-weight: bold; font-size: 10px; background:
                                    @if ($d->grading == 'A') #2e7d32
                                    @elseif($d->grading == 'B') #1565c0
                                    @elseif($d->grading == 'C') #f9a825
                                    @else #c62828 @endif;">
                                    {{ $d->grading }}
                                </span>
                            </td>

                            <td style="border:1px solid #bbb;">{{ $d->jan }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->feb }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->mar }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->apr }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->mei }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->jun }}</td>
                            <td style="border:1px solid #bbb; font-weight: 700;">{{ $d->total }}</td>
                            <td style="border:1px solid #bbb;">{{ Str::limit($d->evaluasi, 20) }}</td>
                            <td style="border:1px solid #bbb;">{{ $d->tanggal_keluar }}</td>
                            <td style="border:1px solid #bbb; white-space:nowrap;">
                                <a href="{{ route('evaluasi.edit', $d->id) }}"
                                    style="color:#1976d2; font-weight:600; text-decoration:none; margin-right:5px;">Edit</a>

                                <form action="{{ route('evaluasi.destroy', $d->id) }}" method="POST"
                                    style="display:inline;" id="delete-form-{{ $d->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $d->id }}')"
                                        style="background:#e53935; color:white; border:none; padding:3px 7px; border-radius:4px; font-size:11px; cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:#0d47a1; color:white; font-weight:bold;">
                    <tr>
                        <td colspan="12" style="border:1px solid #999; text-align: center;">GRAND TOTAL</td>
                        <td style="border:1px solid #999;">{{ $grandTotal }}</td>
                        <td colspan="3" style="border:1px solid #999;">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Script Konfirmasi Hapus --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                background: '#ffffff',
                customClass: {
                    title: 'text-dark',
                    popup: 'rounded-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
