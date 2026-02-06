@extends('layouts.app')

@section('title', 'Evaluasi Wiraniaga')

@section('content')
<div class="main-content">
    <div class="mb-4">
        <h2 style="color: white; font-weight: 800;">📊 EVALUASI WIRANIAGA</h2>
        <p style="color: #8fb3d9;">Monitoring kinerja wiraniaga secara periodik</p>
    </div>

    <div class="activity-page"> 
        <div class="action-bar d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 text-white">Data Evaluasi</h4>
            <a href="{{ route('evaluasi.create') }}" class="btn">
                ➕ Tambah Data
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sales Head</th>
                        <th>Nama Sales</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Evaluasi</th>
                        <th>Grading</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>Mei</th>
                        <th>Jun</th>
                        <th>Total</th>
                        <th>Evaluasi</th>
                        <th>Tgl Keluar</th>
                        <th style="min-width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $d->nama_sales_head }}</td>
                            <td>{{ $d->nama_sales }}</td>
                            <td>{{ $d->tanggal_masuk }}</td>
                            <td>{{ $d->tanggal_evaluasi }}</td>
                            <td>
                                <span class="badge 
                                    @if($d->grading == 'A') bg-success 
                                    @elseif($d->grading == 'B') bg-primary 
                                    @elseif($d->grading == 'C') bg-warning text-dark 
                                    @else bg-danger @endif">
                                    {{ $d->grading }}
                                </span>
                            </td>
                            <td>{{ $d->jan }}</td>
                            <td>{{ $d->feb }}</td>
                            <td>{{ $d->mar }}</td>
                            <td>{{ $d->apr }}</td>
                            <td>{{ $d->mei }}</td>
                            <td>{{ $d->jun }}</td>
                            <td class="fw-bold text-info">{{ $d->total }}</td>
                            <td>{{ Str::limit($d->evaluasi, 20) }}</td>
                            <td>{{ $d->tanggal_keluar }}</td>
                            <td>
                                <div class="aksi">
                                    <a href="{{ route('evaluasi.edit', $d->id) }}" class="btn edit" style="padding: 5px 10px;">
                                        ✏️
                                    </a>
                                    <form action="{{ route('evaluasi.destroy', $d->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus data ini?')" class="btn delete" style="padding: 5px 10px;">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background: rgba(0, 102, 204, 0.2);">
                        <td colspan="12" class="text-end fw-bold">GRAND TOTAL</td>
                        <td class="fw-bold text-warning">{{ $grandTotal }}</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection