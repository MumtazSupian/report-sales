@extends('layouts.app')

@section('title', 'Edit Evaluasi Wiraniaga')

@section('content')
    <div style="padding: 40px 20px; min-height: 100vh;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:#fff; letter-spacing:1px; text-transform:uppercase; margin-bottom:5px;">
                ✏️ EDIT DATA EVALUASI
            </h2>
            <p style="color: #8fb3d9;">Perbarui informasi kinerja untuk <strong>{{ $row->nama_sales }}</strong></p>
        </div>

        <div
            style="background:#fff; max-width: 900px; margin: 0 auto; padding:30px; border-radius:14px; box-shadow:0 10px 30px rgba(0,0,0,0.2);">

            <form method="POST" action="{{ route('evaluasi.update', $row->id) }}">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">SALES
                            HEAD</label>
                        <input type="text" name="nama_sales_head" required value="{{ $row->nama_sales_head }}"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;"
                            placeholder="Nama Sales Head...">
                    </div>

                    <div>
                        <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">NAMA
                            SALES</label>
                        <input type="text" name="nama_sales" required value="{{ $row->nama_sales }}"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;"
                            placeholder="Nama Sales...">
                    </div>

                    <div>
                        <label
                            style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">TANGGAL
                            MASUK</label>
                        <input type="date" name="tanggal_masuk" required value="{{ $row->tanggal_masuk }}"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;">
                    </div>

                    <div>
                        <label
                            style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">TANGGAL
                            EVALUASI</label>
                        <input type="date" name="tanggal_evaluasi" required value="{{ $row->tanggal_evaluasi }}"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;">
                    </div>

                    {{-- BAGIAN GRADING BARU --}}
                    <div style="grid-column: span 2;">
                        <label
                            style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">GRADING
                            PERFORMA</label>
                        <select name="grading" required
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none; background-color: #f9f9f9; font-weight: 600;">
                            <option value="A" {{ $row->grading == 'A' ? 'selected' : '' }} style="color: #2e7d32;">
                                Grade A (Excellent)</option>
                            <option value="B" {{ $row->grading == 'B' ? 'selected' : '' }} style="color: #1565c0;">
                                Grade B (Good)</option>
                            <option value="C" {{ $row->grading == 'C' ? 'selected' : '' }} style="color: #f9a825;">
                                Grade C (Fair)</option>
                            <option value="D" {{ $row->grading == 'D' ? 'selected' : '' }} style="color: #c62828;">
                                Grade D (Poor)</option>
                        </select>
                    </div>
                </div>

                <hr style="border:0; border-top:1px solid #eee; margin:30px 0;">

                <h3
                    style="font-size:15px; font-weight:800; color:#0d47a1; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                    📊 PERBARUI NILAI BULANAN
                </h3>

                <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px; margin-bottom: 30px;">
                    @foreach (['jan', 'feb', 'mar', 'apr', 'mei', 'jun'] as $m)
                        <div style="text-align: center;">
                            <label
                                style="display:block; font-weight:700; color:#555; margin-bottom:5px; font-size:11px;">{{ strtoupper($m) }}</label>
                            <input type="number" name="{{ $m }}" value="{{ $row->$m }}" min="0"
                                style="width:100%; padding:8px; border:1px solid #ddd; border-radius:6px; text-align:center; font-weight:600; color:#0d47a1;">
                        </div>
                    @endforeach
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">HASIL
                        EVALUASI</label>
                    <textarea name="evaluasi" rows="3" placeholder="Tulis catatan evaluasi..."
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none; resize: none;">{{ $row->evaluasi }}</textarea>
                </div>

                <div style="margin-bottom: 35px; width: 50%;">
                    <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">TANGGAL
                        KELUAR</label>
                    <input type="date" name="tanggal_keluar" value="{{ $row->tanggal_keluar }}"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;">
                </div>

                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 20px;">
                    <a href="{{ route('evaluasi.index') }}"
                        style="text-decoration:none; color:#666; font-weight:600; font-size:14px;">
                        ← Batal
                    </a>

                    <button type="submit"
                        style="background:#fb8c00; color:#fff; border:none; padding:12px 35px; border-radius:8px; font-weight:700; cursor:pointer; font-size:14px; transition:0.3s; box-shadow:0 4px 10px rgba(251,140,0,0.3);"
                        onmouseover="this.style.background='#ef6c00'" onmouseout="this.style.background='#fb8c00'">
                        💾 SIMPAN PERUBAHAN
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
