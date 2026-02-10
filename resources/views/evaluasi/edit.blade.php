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

                    {{-- BAGIAN GRADING OTOMATIS --}}
                    <div style="grid-column: span 2;">
                        <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">
                            GRADING PERFORMA (Otomatis)
                        </label>
                        <input type="text" id="grading_display" name="grading" readonly
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; background-color: #f1f1f1; font-weight: 800; text-align: center; text-transform: uppercase;"
                            value="{{ $row->grading }}">
                        <small style="color: #666; font-style: italic;">*Peringkat diperbarui otomatis berdasarkan rata-rata
                            penjualan Jan-Mar</small>
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
                                class="input-bulan"
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

    {{-- SCRIPT PERHITUNGAN OTOMATIS --}}
    <script>
        document.querySelectorAll('.input-bulan').forEach(input => {
            input.addEventListener('input', function() {
                updateGrading();
            });
        });
        function updateGrading() {
            // Ambil nilai unit bulanan
            let jan = parseFloat(document.querySelector('input[name="jan"]').value) || 0;
            let feb = parseFloat(document.querySelector('input[name="feb"]').value) || 0;
            let mar = parseFloat(document.querySelector('input[name="mar"]').value) || 0;
            let apr = parseFloat(document.querySelector('input[name="apr"]').value) || 0;
            let mei = parseFloat(document.querySelector('input[name="mei"]').value) || 0;
            let jun = parseFloat(document.querySelector('input[name="jun"]').value) || 0;

            let total3Bulan = jan + feb + mar;
            let total6Bulan = jan + feb + mar + apr + mei + jun;
            let rataRata3Bulan = total3Bulan / 3;
            let rataRata6Bulan = total6Bulan / 6;

            let grade = "TRAINEE";
            let status = "";
            let bgColor = "#4caf50"; // Default Trainee (Hijau)

            // LOGIKA PERINGKAT

            // 1. Cek dari yang tertinggi (PLATINUM)
            if (rataRata6Bulan >= 5 && total6Bulan >= 31) {
                grade = "PLATINUM";
                bgColor = "#1a237e";
            }
            // 2. GOLD ke PLATINUM
            else if (rataRata6Bulan >= 4 && total6Bulan >= 25) {
                grade = "GOLD";
                bgColor = "#ff9800";
                status = (rataRata6Bulan >= 5 && total6Bulan >= 31) ? "" : " -> KADAR PLATINUM";
            }
            // 3. SILVER ke GOLD
            else if (rataRata3Bulan >= 2 && total3Bulan >= 7) {
                grade = "SILVER";
                bgColor = "#9e9e9e";
                // Cek jika hampir naik ke Gold (Syarat Gold: 4 unit/bln & 25 total/6bln)
                status = " -> KADAR GOLD";
            }
            // 4. TRAINEE ke SILVER atau EVALUASI
            else {
                grade = "TRAINEE";
                bgColor = "#4caf50";
                if (rataRata3Bulan >= 1) { // 1 unit per bulan (seperti kasus 1,1,1 kamu)
                    status = " -> KADAR SILVER";
                } else if (total3Bulan < 3) {
                    status = " -> EVALUASI";
                    bgColor = "#f44336"; // Merah jika evaluasi
                }
            }

            let display = document.getElementById('grading_display');
            display.value = grade + status;
            display.style.backgroundColor = bgColor;
            display.style.color = "#ffffff";
        }
    </script>
@endsection
