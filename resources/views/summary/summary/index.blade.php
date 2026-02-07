@extends('layouts.app')

@section('title', 'Summary Improvement')

@section('content')
    <div style="padding: 20px;">
        <h2
            style="text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:5px;">
            📊 SUMMARY IMPROVEMENT
        </h2>
        <p style="text-align:center; color: #8fb3d9; margin-bottom:20px;">
            Kelola data operasional, rencana perbaikan, dan evaluasi pelaksanaan
        </p>

        <div
            style="display:flex; justify-content:space-between; align-items:center; gap:8px; margin:0 auto 15px auto; width:98%;">
            <div style="display:flex; gap:10px; align-items:center;">
                <a href="{{ url('/summary/dashboard') }}"
                    style="padding:8px 16px; background:#6c757d; color:#fff; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 2px 5px rgba(0,0,0,0.1); transition:0.3s;"
                    onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                    ⬅ Kembali
                </a>
            </div>

            <a href="{{ route('summary.summary.create') }}"
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
                style="width:100%; border-collapse:collapse; font-family:'Segoe UI',sans-serif; font-size:13px; text-align:center; border:1px solid #bbb;">
                <thead style="background:#e3f2fd; color:#0d47a1;">
                    <tr style="border-bottom:2px solid #90caf9;">
                        <th style="border:1px solid #999; width: 20%;">OPERASIONAL</th>
                        <th style="border:1px solid #999;">PLAN PELAKSANAAN</th>
                        <th style="border:1px solid #999;">AKTUAL PELAKSANAAN</th>
                        <th style="border:1px solid #999; width: 10%;">DO / DON'T</th>
                        <th style="border:1px solid #999; width: 12%;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($summaries as $s)
                        <tr
                            style="background:{{ $loop->iteration % 2 == 0 ? '#f7f9fb' : '#ffffff' }}; border-bottom:1px solid #ccc;">
                            <td style="border:1px solid #bbb; font-weight:600; text-align:left; padding-left:15px;">
                                {{ $s->operasional }}
                            </td>
                            <td style="border:1px solid #bbb; text-align:left;">{{ $s->plan_perbaikan }}</td>
                            <td style="border:1px solid #bbb; text-align:left;">{{ $s->aktual_perbaikan }}</td>
                            <td style="border:1px solid #bbb;">
                                @if ($s->do_dont == 'V')
                                    <span
                                        style="background:#198754; color:white; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:bold;">✔
                                        DO</span>
                                @elseif ($s->do_dont == 'X')
                                    <span
                                        style="background:#dc3545; color:white; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:bold;">✖
                                        DON'T</span>
                                @else
                                    <span style="color:#999;">-</span>
                                @endif
                            </td>
                            <td style="border:1px solid #bbb; white-space:nowrap;">
                                <a href="{{ route('summary.summary.edit', $s->id) }}"
                                    style="color:#1976d2; font-weight:600; text-decoration:none; margin-right:8px; font-size:12px;">Edit</a>

                                <form action="{{ route('summary.summary.destroy', $s->id) }}" method="POST"
                                    style="display:inline;" id="delete-form-{{ $s->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $s->id }}')"
                                        style="background:#e53935; color:white; border:none; padding:4px 12px; border-radius:4px; font-size:11px; cursor:pointer; transition:0.2s;"
                                        onmouseover="this.style.background='#b71c1c'"
                                        onmouseout="this.style.background='#e53935'">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="border:1px solid #bbb; padding:30px; color:#999; font-style:italic;">
                                Data belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
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
                customClass: {
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
